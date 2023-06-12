<?php

namespace App\Http\Controllers;

use App\Helper\Util;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    public function create()
    {
        return view('posts.create');
    }


    public function store(PostRequest $request)
    {
        $validated = $request->validated();
        $isContentSafe = Util::validateSafeContent($validated['content']);
        $category = Util::getCategoryByPostContent($validated['content']);
        if (!$isContentSafe) {
            return redirect()->back()->withErrors(['content' => 'Your comment contains inappropriate language. Please moderate your language.']);
        }

        $category_id = Category::where('name', $category)->first()->id;

        $slug = Str::slug($validated['title']);
        $validated['slug'] = $slug;
        $validated['user_id'] = auth()->user()->id;
        $validated['category_id'] = $category_id;

        $post = Post::create($validated);

        return redirect()->route('posts.show', $post->slug);
    }

    public function show(Request $request, string $slug)
    {
        $post = Post::where('slug', $slug)->with('category', 'likes', 'comments')->firstOrFail();

        $popularPosts = Post::with("likes")->get()->sortByDesc(function ($post) {
            return $post->likes->count();
        })->take(5);

        return view('posts.show', compact('post', 'popularPosts'));
    }

    public function edit(string $slug)
    {
        $post = Post::where('slug', $slug)->with('category', 'likes', 'comments')->firstOrFail();
        $this->authorize('update', $post);

        return view('posts.edit', compact('post'));
    }

    public function update(PostRequest $request, string $slug)
    {
        $post = Post::where('slug', $slug)->with('category', 'likes', 'comments')->firstOrFail();
        $this->authorize('update', $post);

        $validated = $request->validated();
        $category = $this->getCategoryByPostContent($validated['content']);
        $category_id = Category::where('name', $category)->first()->id;

        $validated['category_id'] = $category_id;

        $post->update($validated);

        return redirect()->route('posts.show', $post->slug);
    }

    public function destroy(string $slug)
    {
        $post = Post::where('slug', $slug)->with('category', 'likes', 'comments')->firstOrFail();

        $this->authorize('delete', $post);

        $post->likes()->delete();
        $post->comments()->delete();

        $post->delete();

        return redirect()->route('home');
    }
}
