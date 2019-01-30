<?php

namespace App\Http\Controllers;

use App\Contracts\Category as CategoryContract;
use App\Http\Requests\{Create\Category as CreateCategoryRequest, Edit\Category as EditCategoryRequest};
use App\Http\Resources\{CategoryCollection, ProductCollection};

/**
 * Class CategoryController.
 *
 * @package App\Http\Controllers
 */
class CategoryController extends Controller
{
    /**
     * Display a listing of all categories.
     *
     * @return CategoryCollection
     */
    public function index()
    {
        return (CategoryCollection::make(CategoryContract::query()->paginate()));
    }

    /**
     * Display a listing of all products in category.
     *
     * @param $category CategoryContract
     * @return ProductCollection
     */
    public function show(CategoryContract $category)
    {
        return (ProductCollection::make($category->products()->paginate()));
    }

    /**
     * Store a newly created category in storage.
     *
     * @param CreateCategoryRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateCategoryRequest $request)
    {
        $category = CategoryContract::create($request->sanitize());
        return (response()->json(['data' => $category], 201));
    }

    /**
     * Update the specified category in storage.
     *
     * @param EditCategoryRequest $request
     * @param CategoryContract    $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(EditCategoryRequest $request, CategoryContract $category)
    {
        $category->update($request->sanitize());
        return (response()->json(['data' => $category], 200));
    }

    /**
     * Remove the specified category from storage.
     *
     * @param CategoryContract $category
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(CategoryContract $category)
    {
        $category->delete();
        return response()->json(null, 204);
    }
}
