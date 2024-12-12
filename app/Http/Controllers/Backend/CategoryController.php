<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return response()->json([
            'success' => true,
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => ['required', 'unique:categories', 'max:255'],
        ];

        $validator = Validator::make($request->all(), $rules);
        $error = $validator->errors()->first();
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $error
            ]);
        }

        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name); 
        $category->save();

        return response()->json([
            'success' => true,
            'message' => 'Category created successfully',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);
        if(!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found'
            ]);
        }

        $rules = [
            'name' => ['required', 'unique:categories,name,' . $id],
        ];

        $validator = Validator::make($request->all(), $rules);
        $error = $validator->errors()->first();
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $error
            ]);
        }

        $category->name = $request->name;
        $category->slug = Str::slug($request->name); 
        $category->save();

        return response()->json([
            'success' => true,
            'message' => 'Category updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found'
            ]);
        }
        try {
            $category->delete();
            return response()->json([
                'success' => true,
                'message' => 'Category deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => "Deletion unsuccessful due to data dependency"
            ]);
        }
    }
}
