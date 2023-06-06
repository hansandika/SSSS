<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
    }

    public function show(string $slug)
    {
        $post = Post::where('slug', $slug)->with('category', 'likes', 'comments')->firstOrFail();
        return view('posts.show', compact('post'));
    }

    public function edit(string $slug)
    {
        $post = Post::where('slug', $slug)->with('category', 'likes', 'comments')->firstOrFail();
        return view('posts.edit', compact('post'));
    }

    public function update()
    {
    }
}
