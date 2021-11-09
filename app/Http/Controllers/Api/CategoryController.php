<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        return response()->json(Category::all());
    }

    public function store(CategoryRequest $request)
    {
        // $image = $request->file('image');
        // $input['image'] = time().'.'.$image->getClientOriginalExtension();
        
        // $destinationPath = public_path('/uploads/category');
        // $image->move($destinationPath, $input['image']);
        // $request->image = $destinationPath;
        $category = Category::create($request->validated());
        return response()->json($category);
    }

    public function show(Category $category)
    {
        return $category;
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $image = $request->file('image');
        $input['image'] = time().'.'.$image->getClientOriginalExtension();
        
        $destinationPath = public_path('/uploads/category');
        $image->move($destinationPath, $input['image']);
        $request->image = $destinationPath;

        $category->update($request->validated());
        return $category;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->noContent();
    }
}
