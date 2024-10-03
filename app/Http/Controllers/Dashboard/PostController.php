<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::get();
        return view('Dashboard.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return view('Dashboard.post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validated();

        Post::create([
            'title' => $validatedData['title'],
            'slug' => $validatedData['slug'],
            'description' => $validatedData['description'],
            'content' => $validatedData['content'],
            'category_id' => $validatedData['category_id'],
            'posted' => $validatedData['posted'],
        ]);

        // Redirect to index
        return redirect()->route('post.index')->with('success', 'Post created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::get();
        return view('dashboard.post.edit', compact('categories','post'));  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Post $post)
    {
        $validatedData = $request->validated();

        if(isset($validatedData['image'])){
            $validatedData['image'] = $filename = time().'.'.$validatedData['image']->extension();
            $request->image->move(public_path('uploads\posts'),$filename);
        }

        $post->update($validatedData);

        return redirect()->route('post.index')->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        try {
            $post->delete();
            return redirect()->route('post.index')->with('success', 'Post deleted successfully!');
        } catch (Error $e) {
            return redirect()->route('post.index')->with('failed', 'Post not deleted successfully!');
        }
    }
}
