<?php

namespace App\Http\Controllers;

use App\Contracts\Product as ProductContract;
use App\Http\Requests\{Create\Product as CreateProductRequest, Edit\Product as EditProductRequest};

/**
 * Class ProductController.
 *
 * @package App\Http\Controllers
 */
class ProductController extends Controller
{
    /**
     * Store a newly created product in storage.
     *
     * @param CreateProductRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateProductRequest $request)
    {
        /* @var $product ProductContract */
        $product = ProductContract::create($request->sanitize());
        $collect = collect($product->toArray());

        if ($categoriesIds = $request->get('categories_ids')) {
            $product->categories()->attach($categoriesIds);
            $collect->put('categories', $categoriesIds);
        }

        return (response()->json(['data' => $collect], 201));
    }

    /**
     * Update the specified product in storage.
     *
     * @param EditProductRequest $request
     * @param ProductContract    $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(EditProductRequest $request, ProductContract $product)
    {
        $product->update($request->sanitize());
        $collect = collect($product->toArray());

        if ($categoriesIds = $request->get('categories_ids')) {
            $product->categories()->detach();
            $product->categories()->attach($categoriesIds);
            $collect->put('categories', $categoriesIds);
        }

        return (response()->json(['data' => $collect], 200));
    }

    /**
     * Remove the specified product from storage.
     *
     * @param ProductContract $product
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(ProductContract $product)
    {
        $product->delete();
        return (response()->json(null, 204));
    }
}
