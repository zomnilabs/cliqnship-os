<?php

namespace App\Http\Controllers\Api;

use App\Transformers\Transformerable;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

abstract class AbstractAPIController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $fractal;

    public function __construct(Manager $fractal)
    {
        $this->fractal = $fractal;
    }

    /**
     * Get all filter data from request
     *
     * @param $request
     * @param $filterables
     * @return mixed
     */
    protected function getFilters($request, $filterables)
    {
        $filters = $request->all();
        $filters = array_keys($filters);
        $filters = array_intersect($filterables, $filters);

        return $request->only($filters);
    }

    /**
     * Filter query
     *
     * @param $query
     * @param $filters
     * @return mixed
     */
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

    /**
     * Transform a collection
     *
     * @param $collection
     * @param Transformerable $transformer
     * @return \League\Fractal\Scope
     */
    protected function transformCollection($collection, Transformerable $transformer)
    {
        $data = $collection->getCollection();
        $resource = new Collection($data, $transformer);
        $resource->setPaginator(new IlluminatePaginatorAdapter($collection));

        return $this->fractal->createData($resource);
    }

    /**
     * Transform an item
     *
     * @param $item
     * @param Transformerable $transformer
     * @return \League\Fractal\Scope
     */
    protected function transformItem($item, Transformerable $transformer)
    {
        $resource = new Item($item, $transformer);

        return $this->fractal->createData($resource);
    }
}
