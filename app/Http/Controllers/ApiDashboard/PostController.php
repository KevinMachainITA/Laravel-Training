<?php

namespace App\Http\Controllers\ApiDashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $currentPage = $request->input('page', 1);

        $posts = Post::paginate(3);

        return response()->json([
            'data' => $posts->items(),
            'current_page' => $posts->currentPage(),
            'last_page' => $posts->lastPage(),
            'next_page' => $posts->hasMorePages() ? $posts->currentPage() + 1 : null,
            'prev_page' => $posts->onFirstPage() ? null : $posts->currentPage() - 1,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $validatedData = $request->only([
            'title',
            'slug',
            'description',
            'content',
            'category_id',
            'posted'
        ]);
    
        Post::create($validatedData);
    
        return response()->json(['message' => 'Post created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);

        if(!$post){
            return response()->json(['Error'=> 'Post not found'], 404);    
        }

        $post->category;

        return response()->json(['post'=>$post], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $validatedData = $request->only([
            'title',
            'slug',
            'description',
            'content',
            'category_id',
            'posted'
        ]);

        $postUpdated = Post::find($id);
        
        if(!$postUpdated){
            return response()->json(['error'=>'Post to update falied'], 400);
        } else {
            $postUpdated->update($validatedData);
            return response()->json(['Post updated'=>$postUpdated], 200);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $postDeleted = Post::find($id);

            if (!$postDeleted) {
                return response()->json(['error' => 'Post not found'], 404);
            }

            $postDeleted->delete();

            return response()->json(['message' => 'Post deleted successfully', 'post' => $postDeleted], 200);
        } catch (\Throwable $th) {
            return response()->json(['error'=>$th->getMessage()], 400);
        }
    }
}
