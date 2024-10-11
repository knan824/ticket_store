<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryStoreRequest;
use App\Http\Requests\Admin\CategoryUpdateRequest;
use App\Http\Resources\Admin\CategoryResourse;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate();

        return CategoryResourse::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {
        $category = $request->storeCategory();

        return response([
            'message' =>  'category stored successfully',
            'category' => new CategoryResourse($category),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return response([
            'category' => new CategoryResourse($category),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $category = $request->updateCategory();

        return response([
            'message' => 'category updated successfully',
            'category' => new CategoryResourse($category),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response([
            'message' => 'category removed successfully',
        ]);
    }
}
