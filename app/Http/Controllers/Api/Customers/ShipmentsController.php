<?php
namespace App\Http\Controllers\Api\Customers;

use App\Http\Controllers\Api\AbstractAPIController;
use App\Http\Requests\API\CreateBookingRequest;
use App\Http\Requests\API\CreateShipmentRequest;
use App\Models\Shipment;
use App\Models\ShipmentEvent;
use App\Models\ShipmentTrackingNumber;
use App\Models\UserAddressbook;
use App\Traits\ApiResponse;
use App\Transformers\Customers\ShipmentTransformer;
use App\Models\WaybillNumber;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShipmentsController extends AbstractAPIController {
    use ApiResponse;

    /**
     * Get all the shipments of a customer
     *
     * @param Request $request
     * @param $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function all(Request $request, $userId)
    {
        // Check user
        if ($request->user()->id !== (int)$userId) {
            return $this->responseUnauthorized();
        }

        // Get filters
        $filters = $this->getFilters($request, Shipment::$filterables);

        // Create query
        $model = Shipment::where('user_id', $userId)->getQuery();
        $paginator = $this->filter($model, $filters);

        // Transform Result
        $result = $this->transformCollection($paginator, new ShipmentTransformer);

        // Return response
        return $this->responseOk($result->toArray());
    }

    /**
     * Get a specific shipment of a customer
     *
     * @param Request $request
     * @param $userId
     * @param $shipmentId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $userId, $shipmentId)
    {
        // Check user
        if ($request->user()->id !== (int)$userId) {
            return $this->responseUnauthorized();
        }

        // Create query
        $booking = Shipment::where('user_id', $userId)
            ->where('id', $shipmentId)
            ->first();

        if (! $booking) {
            return $this->responseNotFound();
        }

        // Transform Result
        $result = $this->transformItem($booking, new ShipmentTransformer);

        // Return response
        return $this->responseOk($result->toArray());
    }

    /**
     * Create a new booking for the customer
     *
     * @param CreateBookingRequest $request
     * @param $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateShipmentRequest $request, $userId)
    {
        // Check user
        if ($request->user()->id !== (int) $userId) {
            return $this->responseUnauthorized();
        }

        $input = $request->all();

        $input['user_id'] = $userId;

        $result = \DB::transaction(function() use ($input, $request, $userId) {
            try {
                // check from address
                if (isset($input['from']) && is_array($input['from'])) {
                    if (isset($input['from']['id'])) {
                        $address = UserAddressbook::where('id', $input['from']['id'])
                            ->where('user_id', $userId)
                            ->where('type', 'booking')->first();

                        if (! $address) {
                            throw new \Exception('Invalid from address');
                        }

                        $input['from'] = $address->id;
                    } else {
                        $addressData = $input['from'];
                        $addressData['user_id'] = $userId;
                        $addressData['type'] = 'booking';

                        if (isset($addressData['primary']) && $addressData['primary'] && $addressData['type'] === 'booking') {
                            $addressData['primary'] = 0;
                        }

                        $address = UserAddressbook::create($addressData);

                        // Check if newly added address is a primary address
                        if ($address->primary && $address->type === 'shipment') {
                            // Update other primary
                            UserAddressbook::where('user_id', $userId)
                                ->where('primary', 1)
                                ->where('id', '!=', $address->id)
                                ->update(['primary' => 0]);
                        }

                        $input['from'] = $address->id;
                    }
                }

                // check to address
                if (isset($input['to']) && is_array($input['to'])) {
                    if (isset($input['to']['id'])) {
                        $address = UserAddressbook::where('id', $input['to']['id'])
                            ->where('user_id', $userId)
                            ->where('type', 'shipment')->first();

                        if (! $address) {
                            throw new \Exception('Invalid to address');
                        }

                        $input['to'] = $address->id;
                    } else {
                        $addressData = $input['to'];
                        $addressData['user_id'] = $userId;
                        $addressData['type'] = 'booking';

                        if (isset($addressData['primary']) && $addressData['primary'] && $addressData['type'] === 'booking') {
                            $addressData['primary'] = 0;
                        }

                        $address = UserAddressbook::create($addressData);

                        // Check if newly added address is a primary address
                        if ($address->primary && $address->type === 'shipment') {
                            // Update other primary
                            UserAddressbook::where('user_id', $userId)
                                ->where('primary', 1)
                                ->where('id', '!=', $address->id)
                                ->update(['primary' => 0]);
                        }

                        $input['to'] = $address->id;
                    }
                }

                // Image Upload
                $image = null;
                if ($request->hasFile('image')) {
                    if (getenv('APP_ENV') === 'production') {
                        $image =  $request->file('image')->store('prod/bookings', 's3');
                    } else {
                        $image =  $request->file('image')->store('dev/bookings', 's3');
                    }
                }

                $shipmentData = [
                    'user_id'           => $input['user_id'],
                    'from'              => $input['from'],
                    'to'                => $input['to'],
                    'source_id'         => 3,
                    'item_description'  => isset($input['item_description']) ? $input['item_description'] : '',
                    'number_of_items'   => isset($input['number_of_items']) ? $input['number_of_items'] : 0,
                    'service_type'      => isset($input['service_type']) ? $input['service_type'] : 'metro_manila',
//                'is_international'      => isset($input['is_international']) ? $input['is_international'] : '',
                    'collect_and_deposit'   => isset($input['collect_and_deposit']) ? $input['collect_and_deposit'] : 0,
                    'insurance_declared_value'   => isset($input['insurance_declared_value']) ? $input['insurance_declared_value'] : 0,
                    'insurance_amount'           => isset($input['insurance_amount']) ? $input['insurance_amount'] : 0,
                    'status'            => 'pending',
                    'charge_to'         => isset($input['charge_to']) ? $input['charge_to'] : 'sender',
                    'pay_thru'          => isset($input['pay_thru']) ? $input['pay_thru'] : 'cash',
                    'package_type'      => isset($input['package_type']) ? $input['package_type'] : 'own-packaging',
                    'length'            => isset($input['length']) ? $input['length'] : 0,
                    'width'             => isset($input['width']) ? $input['width'] : 0,
                    'height'            => isset($input['height']) ? $input['height'] : 0,
                    'weight'            => isset($input['weight']) ? $input['weight'] : 0,
                    'image'             => $image
                ];

                $shipment = Shipment::create($shipmentData);

                if ($shipment->collect_and_deposit) {
                    $cod = [
                        'collect_and_deposit_amount'    => isset($input['collect_and_deposit_amount']) ? $input['collect_and_deposit_amount'] : 0,
                        'account_name'                  => isset($input['account_name']) ? $input['account_name'] : '',
                        'account_number'                => isset($input['account_number']) ? $input['account_number'] : '',
                        'bank'                          => isset($input['bank']) ? $input['bank'] : '',
                        'status'                        => 'pending',
                        'cod_fee'                       => 0
                    ];

                    $shipment->cod()->create($cod);
                }

                // Create Tracking Number
                ShipmentTrackingNumber::create([
                    'tracking_number'   => $this->createTrackingNumber(),
                    'shipment_id'       => $shipment->id
                ]);

                // Record Event
                ShipmentEvent::create([
                    'shipment_id'   => $shipment->id,
                    'event_source'  => 'customer',
                    'event'         => 'status_change',
                    'value'         => 'pending',
                    'remarks'       => 'shipment created',
                    'user_id'       => $input['user_id']
                ]);

                // Transform Result
                $result = $this->transformItem($shipment, new ShipmentTransformer);

                return [
                    'status'    => 'success',
                    'data'      => $result->toArray()
                ];
            } catch (\Exception $e) {
                return [
                    'status'    => 'failed',
                    'message'   => $e->getMessage()
                ];
            }
        });

        if ($result['status'] === 'failed') {
            return $this->responseBadRequest([$result['message']]);
        }

        // Return response
        return $this->responseCreated($result['data']);
    }

    /**
     * Tracking Shipment
     *
     * @param Request $request
     * @param $trackingNumber
     * @return \Illuminate\Http\JsonResponse
     */
    public function tracking(Request $request, $trackingNumber)
    {
        $tracking = ShipmentTrackingNumber::where('tracking_number', $trackingNumber)
            ->where('provider', 'cliqnship')
            ->first();

        if (! $tracking) {
            return $this->responseNotFound();
        }

        $events = ShipmentEvent::where('shipment_id', $tracking->shipment_id)
            ->where('event_source', '<>', 'customer')
            ->where('event', 'status_change')
            ->get();

        $result = [];
        foreach ($events as $event) {
            $result['data'][] = [
                'tracking_number'   => $trackingNumber,
                'event'             => $event['event'],
                'value'             => $event['value'],
                'date'              => $event['created_at']->toDateTimeString()
            ];
        }

        return $this->responseOk($result);
    }

    /**
     * Create Shipment Tracking Number
     *
     * @return string
     */
    private function createTrackingNumber()
    {
        $tracking = 5000000000;
        $current = WaybillNumber::orderBy('id', 'DESC')->first();

        if (! $current) {
            $tracking = WaybillNumber::create(['current' => $tracking]);

            return $tracking->current;
        }

        $tracking = (int) $current['current'] + 1;

        $tracking = WaybillNumber::create(['current' => $tracking]);

        return $tracking->current;
    }

}