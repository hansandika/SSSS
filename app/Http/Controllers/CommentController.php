<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(CommentRequest $request)
    {
        $user = Auth::user();
        $post = Post::where('slug', $request->post_slug)->first();
        if (!$post) {
            return redirect()->back()->withErrors(['post_slug' => 'Post not found']);
        }

        $comment = new Comment();
        $comment->content = $request->content;
        $comment->user_id = Auth::id();
        $comment->post_id = $post->id;
        if ($request->parent_id) {
            $comment->parent_id = $request->parent_id;
        }
        $comment->save();
        return redirect()->back();
    }
}
