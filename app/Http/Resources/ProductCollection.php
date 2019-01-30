<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class ProductCollection.
 *
 * @package App\Http\Resources
 */
class ProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return ([
            'data'  => $this->collection->map->only(['id', 'name'])->toArray($request),
            'links' => ['categories_path' => action('CategoryController@index')]
        ]);
    }
}
