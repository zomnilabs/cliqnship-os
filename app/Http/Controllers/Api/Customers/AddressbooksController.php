<?php
namespace App\Http\Controllers\Api\Customers;

use App\Http\Controllers\Api\AbstractAPIController;
use App\Http\Requests\API\CreateAddressbookRequest;
use App\Models\UserAddressbook;
use App\Traits\ApiResponse;
use App\Transformers\Customers\AddressbookTransformer;
use Illuminate\Http\Request;

class AddressbooksController extends AbstractAPIController {
    use ApiResponse;

    /**
     * Get all customers addressbook
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
        $filters = $this->getFilters($request, UserAddressbook::$filterables);

        // Create query
        $model = UserAddressbook::where('user_id', $userId)->getQuery();
        $paginator = $this->filter($model, $filters);

        // Transform Result
        $result = $this->transformCollection($paginator, new AddressbookTransformer);

        // Return response
        return $this->responseOk($result->toArray());
    }

    /**
     * Get a specific addressbook
     *
     * @param Request $request
     * @param $userId
     * @param $addressbookId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $userId, $addressbookId)
    {
        // Check user
        if ($request->user()->id !== (int) $userId) {
            return $this->responseUnauthorized();
        }

        // Create query
        $address = UserAddressbook::where('user_id', $userId)
            ->where('id', $addressbookId)
            ->first();

        if (! $address) {
            return $this->responseNotFound();
        }

        // Transform Result
        $result = $this->transformItem($address, new AddressbookTransformer);

        // Return response
        return $this->responseOk($result->toArray());
    }

    /**
     * Create a new addressbook
     *
     * @param CreateAddressbookRequest $request
     * @param $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateAddressbookRequest $request, $userId)
    {
        // Check user
        if ($request->user()->id !== (int) $userId) {
            return $this->responseUnauthorized();
        }

        $input = $request->all();

        $input['user_id'] = $userId;

        if ($input['primary'] && $input['type'] === 'booking') {
            $input['primary'] = 0;
        }

        $address = UserAddressbook::create($input);

        if (! $address) {
            return $this->responseBadRequest(['something went wrong when creating a new addressbook']);
        }

        // Check if newly added address is a primary address
        if ($address->primary && $address->type === 'shipment') {
            // Update other primary
            UserAddressbook::where('user_id', $userId)
                ->where('primary', 1)
                ->where('id', '!=', $address->id)
                ->update(['primary' => 0]);
        }

        // Transform Result
        $result = $this->transformItem($address, new AddressbookTransformer);

        // Return response
        return $this->responseCreated($result->toArray());
    }

    /**
     * Update addressbook
     *
     * @param Request $request
     * @param $userId
     * @param $addressbookId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $userId, $addressbookId)
    {
        // Check user
        if ($request->user()->id !== (int) $userId) {
            return $this->responseUnauthorized();
        }

        $input = $request->all();

        // check address first
        $address = UserAddressbook::where('user_id', $userId)
            ->where('id', $addressbookId)->first();

        if (! $address) {
            return $this->responseNotFound(['addressbook not found']);
        }

        if ($input['primary']
            && $input['type'] === 'booking'
            && $address->type === 'booking') {

            $input['primary'] = 0;
        }

        $address = UserAddressbook::where('user_id', $userId)
            ->where('id', $addressbookId)
            ->update($input);

        if (! $address) {
            return $this->responseBadRequest(['something went wrong when updating an addressbook']);
        }

        $address = UserAddressbook::find($addressbookId);
        // Check if newly updated address is a primary address
        if ($address->primary && $address->type === 'shipment') {
            // Update other primary
            UserAddressbook::where('user_id', $userId)
                ->where('primary', 1)
                ->where('id', '!=', $address->id)
                ->update(['primary' => 0]);
        }

        // Transform Result
        $result = $this->transformItem($address, new AddressbookTransformer);

        // Return response
        return $this->responseCreated($result->toArray());
    }
}