<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Resources\Website\CategoryResourse;
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
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return response([
            'category' => new CategoryResourse($category),
        ]);
    }
}
