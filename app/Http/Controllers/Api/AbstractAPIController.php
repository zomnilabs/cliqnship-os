<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use League\Fractal\Manager;

abstract class AbstractAPIController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $fractal;

    public function __construct(Manager $fractal)
    {
        $this->fractal = $fractal;
    }

    protected function getFilters($request, $filterables)
    {
        $filters = $request->all();
        $filters = array_keys($filters);
        $filters = array_intersect($filterables, $filters);

        return $request->only($filters);
    }

    protected function filter($query, $filters)
    {
        if (! count($filters)) {
            return $query->paginate(10);
        }

        foreach ($filters as $key => $filter) {
            $query->where($key, $filter);
        }

        return $query->paginate(10);
    }
}
