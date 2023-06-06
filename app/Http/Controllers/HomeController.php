<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        $categories = Category::orderBy('created_at', 'desc')->get();
        $posts = Post::latest();
        if ($request->has('category')) {
            $category = Category::where('name', $request->category)->first();
            if (!$category) {
                return redirect()->route('home')->with("error", "Category not found");
            }
            $posts = $posts->where('category_id', $category->id);
        }
        if ($request->has('search')) {
            $posts = $posts->where('title', 'like', '%' . $request->search . '%');
        }

        $posts = $posts->with('user')->with('category')->paginate(4);
        return view('index', compact('posts', 'categories'));
    }
}
