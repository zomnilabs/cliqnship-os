<?php
namespace App\Http\Controllers\Api\Customers;

use App\Http\Controllers\Api\AbstractAPIController;
use App\Http\Requests\API\CreateBookingRequest;
use App\Http\Requests\API\CreateShipmentRequest;
use App\Models\Shipment;
use App\Models\ShipmentTrackingNumber;
use App\Models\UserAddressbook;
use App\Traits\ApiResponse;
use App\Transformers\Customers\ShipmentTransformer;
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

        $result = null;

        // check from address
        if (isset($input['from']) && is_array($input['from'])) {
            if (isset($input['from']['id'])) {
                $address = UserAddressbook::find($input['from']['id']);

                if (! $address) {
                    return $this->responseBadRequest(['invalid selected address']);
                }

                $input['from'] = $address->id;
            } else {
                $addressData = $input['address'];
                $addressData['user_id'] = $userId;
                $addressData['type'] = 'booking';

                if ($addressData['primary'] && $addressData['type'] === 'booking') {
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
                $address = UserAddressbook::find($input['to']['id']);

                if (! $address) {
                    return $this->responseBadRequest(['invalid selected address']);
                }

                $input['to'] = $address->id;
            } else {
                $addressData = $input['address'];
                $addressData['user_id'] = $userId;
                $addressData['type'] = 'booking';

                if ($addressData['primary'] && $addressData['type'] === 'booking') {
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

        \DB::transaction(function() use ($input, &$result) {
            $shipmentData = [
                'user_id'           => $input['user_id'],
                'from'              => $input['from'],
                'to'                => $input['to'],
                'source_id'         => 3,
                'item_description'  => isset($input['item_description']) ? $input['item_description'] : '',
                'number_of_items'   => isset($input['number_of_items']) ? $input['number_of_items'] : 0,
                'service_type'      => $input['service_type'],
//                'is_international'      => isset($input['is_international']) ? $input['is_international'] : '',
                'collect_and_deposit'   => isset($input['collect_and_deposit']) ? $input['collect_and_deposit'] : 0,
                'insurance_declared_value'   => isset($input['insurance_declared_value']) ? $input['insurance_declared_value'] : 0,
                'insurance_amount'           => isset($input['insurance_amount']) ? $input['insurance_amount'] : 0,
                'collect_and_deposit_amount'    => isset($input['collect_and_deposit_amount']) ? $input['collect_and_deposit_amount'] : 0,
                'account_name'      => isset($input['account_name']) ? $input['account_name'] : '',
                'account_number'    => isset($input['account_number']) ? $input['account_number'] : '',
                'bank'              => isset($input['bank']) ? $input['bank'] : '',
                'status'            => 'pending',
                'charge_to'         => isset($input['charge_to']) ? $input['charge_to'] : 'sender',
                'pay_thru'          => isset($input['pay_thru']) ? $input['pay_thru'] : 'cash',
                'package_type'      => isset($input['package_type']) ? $input['package_type'] : 'small',
                'length'      => isset($input['length']) ? $input['length'] : 0,
                'width'      => isset($input['width']) ? $input['width'] : 0,
                'height'      => isset($input['height']) ? $input['height'] : 0,
                'weight'      => isset($input['weight']) ? $input['weight'] : 0,
            ];

            $result = Shipment::create($shipmentData);

            // Create Tracking Number
            ShipmentTrackingNumber::create([
                'tracking_number'   => $this->createTrackingNumber(),
                'shipment_id'       => $result->id
            ]);
        });

        // Transform Result
        $result = $this->transformItem($result, new ShipmentTransformer);

        // Return response
        return $this->responseCreated($result->toArray());
    }

    // Create unique tracking number
    private function createTrackingNumber()
    {
        $trackingNumber = uniqid();
        $check = ShipmentTrackingNumber::where('tracking_number', $trackingNumber)
            ->first();

        if ($check) {
            $this->createTrackingNumber();
        }

        return $trackingNumber;
    }

}