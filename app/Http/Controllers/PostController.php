<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create()
    {
    }

    public function store()
    {
    }

    public function show(string $slug)
    {
        $post = Post::where('slug', $slug)->with('category', 'likes', 'comments')->firstOrFail();
        return view('posts.show', compact('post'));
    }

    public function edit()
    {
    }

    public function update()
    {
    }
}
