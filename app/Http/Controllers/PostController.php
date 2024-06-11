<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\CreatePostRequest;
use App\Http\Actions\CreatePostAction;
use App\Http\Actions\EditPostAction;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Post::query();

        if ($request->has('name')) {
            $query->whereHas('user', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->input('name') . '%');
            });
        }

        if ($request->has('created_at')) {
            $query->whereDate('created_at', $request->input('created_at'));
        }

        $posts = $query->paginate(5);

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePostRequest $request)
    {
        CreatePostAction::execute($request);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('posts.edit', ['post' => Post::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreatePostRequest $request, string $id)
    {
        EditPostAction::execute(Post::findOrFail($id), $request);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }
}
