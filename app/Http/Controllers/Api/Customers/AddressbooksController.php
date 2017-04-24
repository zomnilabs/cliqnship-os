<?php
namespace App\Http\Controllers\Api\Customers;

use App\Http\Controllers\Api\AbstractAPIController;
use App\Models\UserAddressbook;
use App\Traits\ApiResponse;
use App\Transformers\Customers\AddressbookTransformer;
use Illuminate\Http\Request;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

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
        $addresses = $paginator->getCollection();
        $resource = new Collection($addresses, new AddressbookTransformer);
        $resource->setPaginator(new IlluminatePaginatorAdapter($paginator));
        $result = $this->fractal->createData($resource);

        // Return response
        return $this->responseOk($result->toArray());
    }

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
        $resource = new Item($address, new AddressbookTransformer);
        $result = $this->fractal->createData($resource);

        return $this->responseOk($result->toArray());
    }

    public function store($userId)
    {

    }
}