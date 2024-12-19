<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('category','tags')->latest()->paginate(10);
        return response()->json([
            'success' => true,
            'posts' => $posts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => ['required', 'string', 'max:255', 'unique:posts,title'], 
            'category_id' => ['required', 'exists:categories,id'], 
            'content' => ['required', 'string'], 
            'tag_ids' => ['required', 'array', 'min:1', 'exists:tags,id'],
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $error = $validator->errors()->first(); 
            return response()->json([
                'success' => false,
                'message' => $error
            ]);
        }

        $post = new Post();
        $post->title = $request->title;
        $post->category_id = $request->category_id;
        $post->slug = Str::slug($request->title); 
        $post->content = $request->content;
        $post->save();

        $post->tags()->attach($request->tag_ids);

        return response()->json([
            'success' => true,
            'message' => 'Post created successfully!',
            'post' => $post
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);
        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found'
            ]);
        }
        try {
            $post->delete();
            return response()->json([
                'success' => true,
                'message' => 'Post deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => "Failed to delete the post"
            ]);
        }
    }
}
