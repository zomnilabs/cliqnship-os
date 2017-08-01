<?php
namespace App\Transformers\Customers;

use App\Models\Shipment;
use App\Transformers\Transformerable;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class ShipmentTransformer extends TransformerAbstract implements Transformerable
{
    /**
     * Transform user object
     *
     * @param Shipment $shipment
     * @return array
     */
    public function transform($shipment)
    {
        $shipment = Shipment::find($shipment->id);

        return [
            'id'            => (int) $shipment->id,
            'user_id'       => (int) $shipment->user_id,
            'tracking_number'   => $shipment->trackingNumbers()->mainTrackingNumber()->tracking_number,
            'image'         => $shipment->image ? "https://files.cliqnship.com/{$shipment->image}" : null,
            'source'        => [
                'id'    => $shipment->source->id,
                'name'  => $shipment->source->name
            ],
            'from'          => [
                'id'                => $shipment->senderAddress->id,
                'user_id'           => $shipment->senderAddress->user_id,
                'identifier'        => $shipment->senderAddress->identifier,
                'type'              => $shipment->senderAddress->type,
                'first_name'        => $shipment->senderAddress->first_name,
                'last_name'         => $shipment->senderAddress->last_name,
                'middle_name'       => $shipment->senderAddress->middle_name,
                'contact_number'    => $shipment->senderAddress->contact_number,
                'email'             => $shipment->senderAddress->email,
                'address_line_1'    => $shipment->senderAddress->address_line_1,
                'address_line_2'    => $shipment->senderAddress->address_line_2,
                'barangay'          => $shipment->senderAddress->barangay,
                'city'              => $shipment->senderAddress->city,
                'province'          => $shipment->senderAddress->province,
                'zip_code'          => $shipment->senderAddress->zip_code,
                'country'           => $shipment->senderAddress->country,
                'address_type'      => $shipment->senderAddress->address_type,
                'landmarks'         => $shipment->senderAddress->landmarks,
                'primary'           => $shipment->senderAddress->primary
            ],
            'to'            => [
                'id'                => $shipment->address->id,
                'user_id'           => $shipment->address->user_id,
                'identifier'        => $shipment->address->identifier,
                'type'              => $shipment->address->type,
                'first_name'        => $shipment->address->first_name,
                'last_name'         => $shipment->address->last_name,
                'middle_name'       => $shipment->address->middle_name,
                'contact_number'    => $shipment->address->contact_number,
                'email'             => $shipment->address->email,
                'address_line_1'    => $shipment->address->address_line_1,
                'address_line_2'    => $shipment->address->address_line_2,
                'barangay'          => $shipment->address->barangay,
                'city'              => $shipment->address->city,
                'province'          => $shipment->address->province,
                'zip_code'          => $shipment->address->zip_code,
                'country'           => $shipment->address->country,
                'address_type'      => $shipment->address->address_type,
                'landmarks'         => $shipment->address->landmarks,
                'primary'           => $shipment->address->primary
            ],
            'number_of_items'   => $shipment->number_of_items,
            'service_type'      => $shipment->service_type,
//            'is_international'  => $shipment->is_international,
            'collect_and_deposit'           => (bool) $shipment->collect_and_deposit,
            'insurance_declared_value'      => (bool) $shipment->insurance_declared_value,
            'insurance_amount'              => (double) $shipment->insurance_amount,
            'cod'   => $shipment->cod,
            'charge_to'                     => $shipment->charge_to,
            'pay_thru'                      => $shipment->pay_thru,
            'package_type'                  => $shipment->package_type,
            'length'            => $shipment->length,
            'width'             => $shipment->width,
            'height'            => $shipment->height,
            'weight'            => $shipment->weight,
            'remarks'           => $this->transformRemarks($shipment->remarks),
            'return_history'    => $this->transformHistories($shipment->returnLogs),
            'events'            => $this->transformEvents($shipment->events),
            'status'            => $shipment->status,
            'links'   => [
                [
                    'rel' => 'self',
                    'uri' => url('/api/v1/customers/'.$shipment->user_id.'/shipments/'.$shipment->id),
                ],
                [
                    'rel' => 'owner',
                    'uri' => url('/api/v1/customers/'.$shipment->user_id),
                ],
                [
                    'rel' => 'from',
                    'uri' => url('/api/v1/customers/'.$shipment->user_id.'/addressbooks/'.$shipment->senderAddress->id),
                ],
                [
                    'rel' => 'to',
                    'uri' => url('/api/v1/customers/'.$shipment->user_id.'/addressbooks/'.$shipment->address->id),
                ],
                [
                    'rel' => 'tracking',
                    'uri' => url('/api/v1/tracking/'.$shipment->trackingNumbers()->mainTrackingNumber()->tracking_number),
                ]
            ]
        ];
    }

    /**
     * Transform Events
     *
     * @param $events
     * @return array
     */
    private function transformEvents($events)
    {
        $result = [];
        foreach ($events as $event) {
            $result[] = [
                'event_source'  => $event['event_source'],
                'event'         => $event['event'],
                'value'         => $event['value'],
                'remarks'       => $event['remarks'],
                'created_at'    => $event['created_at']->toDateTimeString()
            ];
        }

        return $result;
    }

    /**
     * Transform Histories
     * @param $histories
     * @return array
     */
    private function transformHistories($histories)
    {
        $result = [];
        foreach ($histories as $history) {
            $result[] = [
                'reason'        => $history['reason'],
                'created_at'    => $history['created_at']->toDateTimeString()
            ];
        }

        return $result;
    }

    /**
     * Transform Remarks
     *
     * @param $remarks
     * @return array
     */
    private function transformRemarks($remarks)
    {
        $result = [];
        foreach ($remarks as $remark) {
            $result[] = [
                'remarks'       => $remark['remarks'],
                'created_at'    => $remark['created_at']->toDateTimeString()
            ];
        }

        return $result;
    }
}