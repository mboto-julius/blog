<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;


class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::latest()->paginate(10);
        return response()->json([
            'success' => true,
            'tags' => $tags
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => ['required', 'unique:tags', 'max:255'],
        ];

        $validator = Validator::make($request->all(), $rules);
        $error = $validator->errors()->first();
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $error
            ]);
        }

        $tag = new Tag();
        $tag->name = $request->name;
        $tag->slug = Str::slug($request->name); 
        $tag->save();

        return response()->json([
            'success' => true,
            'message' => 'Tag created successfully',
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
        $tag = Tag::find($id);
        if(!$tag) {
            return response()->json([
                'success' => false,
                'message' => 'Tag not found'
            ]);
        }

        $rules = [
            'name' => ['required', 'unique:tags,name,' . $id],
        ];

        $validator = Validator::make($request->all(), $rules);
        $error = $validator->errors()->first();
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $error
            ]);
        }

        $tag->name = $request->name;
        $tag->slug = Str::slug($request->name); 
        $tag->save();

        return response()->json([
            'success' => true,
            'message' => 'Tag updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tag = Tag::find($id);
        if (!$tag) {
            return response()->json([
                'success' => false,
                'message' => 'Tag not found'
            ]);
        }
        try {
            $tag->delete();
            return response()->json([
                'success' => true,
                'message' => 'Tag deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => "Deletion unsuccessful due to data dependency"
            ]);
        }
    }

    /**
     * Get a listing of the resource.
     */
    public function getTagList(){
        $tags = Tag::all();
        return response()->json([
            'success' => true,
            'tags' => $tags
        ]);
    }
}
