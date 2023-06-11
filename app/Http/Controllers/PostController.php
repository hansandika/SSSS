<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;


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

    public function getCategoryByPostContent(string $text): string
    {
        $categories = Category::orderBy('created_at', 'desc')->select('name')->get();
        $listCategoryNames = [];
        foreach ($categories as $category) {
            $listCategoryNames[] = $category->name;
        }
        $stringAllCategories = implode(", ", $listCategoryNames);

        $constraint = "We have a list of categories for forum: " . $stringAllCategories;

        $prompt = "This is a forum classification task. Forum posts could fall into categories like $stringAllCategories. Please analyze the following forum post and assign it to one of the known forum categories. If you can't find a fitting category, assign it as 'other'. The category name should be one of the known forum categories or 'other'. Here is the post content: '$text'. For the response, please return one word JSON object only with the following format: {\"category\": \"category_name\"}.";

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('global.OPENAI_API_KEY'),
            'Content-Type' => 'application/json',
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => $constraint,
                ],
                [
                    'role' => 'user',
                    'content' => $text
                ],
                [
                    'role' => 'assistant',
                    'content' => $prompt
                ]
            ],
            'temperature' => 0.4,
            'max_tokens' => 60,
        ]);

        $responseContent = $response->json()['choices'][0]['message']['content'];
        if (!Str::contains($responseContent, $listCategoryNames)) {
            return 'other';
        }

        $category = json_decode($responseContent)->category;
        if (!$category) {
            return 'other';
        }

        return $category;
    }

    public function validateSavedContent(string $content)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('global.OPENAI_API_KEY'),
            'Content-Type' => 'application/json',
        ])->post('https://api.openai.com/v1/moderations', [
            'input' => $content,
        ]);
        return !$response->json()['results'][0]['flagged'];
    }

    public function store(PostRequest $request)
    {
        $validated = $request->validated();
        $isContentSaved = $this->validateSavedContent($validated['content']);
        $category = $this->getCategoryByPostContent($validated['content']);
        if (!$isContentSaved) {
            return redirect()->back()->withErrors(['content' => 'Content is not saved']);
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
