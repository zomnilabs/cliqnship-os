<?php
namespace App\Http\Controllers\Api\Customers;

use App\Http\Controllers\Api\AbstractAPIController;
use App\Models\Booking;
use App\Traits\ApiResponse;
use App\Transformers\Customers\BookingsTransformer;
use Illuminate\Http\Request;

class BookingsController extends AbstractAPIController {
    use ApiResponse;

    public function all(Request $request, $userId)
    {
        // Check user
        if ($request->user()->id !== (int)$userId) {
            return $this->responseUnauthorized();
        }

        // Get filters
        $filters = $this->getFilters($request, Booking::$filterables);

        // Create query
        $model = Booking::where('id', $userId)->getQuery();
        $paginator = $this->filter($model, $filters);

        // Transform Result
        $result = $this->transformCollection($paginator, new BookingsTransformer);

        // Return response
        return $this->responseOk($result->toArray());
    }


}