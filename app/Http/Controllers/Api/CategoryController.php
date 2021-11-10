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
        if($request->hasFile('image')){
            $image = $request->file('image');
            $input['image'] = time().'.'.$image->getClientOriginalExtension();
            
            $destinationPath = public_path('/uploads/category');
            $image->move($destinationPath, $input['image']);
            $request->image = $input['image'];
        }
        $category = Category::create($request->validated());
        return response()->json($category);
    }

    public function show(Category $category)
    {
        return $category;
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $data = $request->all();
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            
            $destinationPath = public_path('/uploads/category');
            $image->move($destinationPath, $imageName);
            $data['image'] = $imageName;
            if($category->image && file_exists(public_path('/uploads/category/' . $category->image))) {
                unlink(public_path('/uploads/category/' . $category->image));
            }
        }
        $category->update($data);
        return $category;
    }

    public function destroy(Category $category)
    {
        if($category->image && file_exists(public_path('/uploads/category/' . $category->image))) {
            unlink(public_path('/uploads/category/' . $category->image));
        }        
        $category->delete();
        return response()->noContent();
    }
}
