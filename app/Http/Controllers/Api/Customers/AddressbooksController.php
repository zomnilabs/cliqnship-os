<?php
namespace App\Http\Controllers\Api\Customers;

use App\Http\Controllers\Api\AbstractAPIController;
use App\Models\UserAddressbook;
use App\Traits\ApiResponse;
use App\Transformers\Customers\AddressbookTransformer;
use Illuminate\Http\Request;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;

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
        if (! $request->user()->id === $userId) {
            return $this->responseUnauthorized();
        }

        // Get filters
        $filters = $this->getFilters($request, UserAddressbook::$filterables);

        // Create query
        $model = UserAddressbook::query();
        $paginator = $this->filter($model, $filters);

        // Transform Result
        $addresses = $paginator->getCollection();
        $resource = new Collection($addresses, new AddressbookTransformer);
        $resource->setPaginator(new IlluminatePaginatorAdapter($paginator));
        $result = $this->fractal->createData($resource);

        // Return response
        return $this->responseOk($result);
    }
}