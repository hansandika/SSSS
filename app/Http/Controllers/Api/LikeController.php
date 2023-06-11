<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class LikeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function createLike(int $likeType, int $user_id): Like
    {
        $like = new Like();
        $like->user_id = $user_id;
        $like->type = $likeType;
        return $like;
    }

    public function updateCommentLike(Request $request)
    {
        if ($request->comment_id === null) {
            return response()->json([
                'message' => 'Comment ID is required'
            ])->setStatusCode(400);
        }

        if ($request->like_type === null) {
            return response()->json([
                'message' => 'Like Type is required'
            ])->setStatusCode(400);
        }

        $comment = Comment::find($request->comment_id);
        if (!$comment) {
            return response()->json([
                'message' => 'Comment not found'
            ])->setStatusCode(404);
        }

        $likeType = (int)$request->like_type;
        $user = Auth::user();
        $user_id = $user->id;

        if ($likeType !== 0 && $likeType !== 1) {
            return response()->json([
                'message' => 'Invalid type'
            ])->setStatusCode(400);
        }

        if ($likeType === 0) {
            if ($comment->dislikedBy($user)) {
                $comment->likes()->where('user_id', $user_id)->where('type', $likeType)->delete();
                return response()->json([
                    'message' => 'Comment dislike deleted'
                ])->setStatusCode(200);
            }

            $like = $this->createLike($likeType, $user_id);
            $comment->likes()->save($like);

            return response()->json([
                'message' => 'Comment dislike created'
            ])->setStatusCode(201);
        } else if ($likeType === 1) {
            if ($comment->likedBy($user)) {
                $comment->likes()->where('user_id', $user_id)->where('type', $likeType)->delete();
                return response()->json([
                    'message' => 'Comment like deleted'
                ])->setStatusCode(200);
            }

            $like = $this->createLike($likeType, $user_id);

            $comment->likes()->save($like);

            return response()->json([
                'message' => 'Comment like created'
            ])->setStatusCode(201);
        }
    }

    public function updatePostLike(Request $request)
    {
        return response()->json([
            'message' => 'Not Implemented'
        ]);


        if ($request->post_slug === null || $request->post_slug === "") {
            return response()->json([
                'message' => 'Post slug is required'
            ])->setStatusCode(400);
        }

        if ($request->like_type === null) {
            return response()->json([
                'message' => 'Like Type is required'
            ])->setStatusCode(400);
        }



        $likeType = (int)$request->like_type;
        $user = Auth::user();
        $user_id = $user->id;

        if ($likeType !== 0 && $likeType !== 1) {
            return response()->json([
                'message' => 'Invalid type'
            ])->setStatusCode(400);
        }

        $post = Post::where('slug', $request->post_slug)->first();
        if (!$post) {
            return response()->json([
                'message' => 'Post not found'
            ])->setStatusCode(404);
        }

        if ($likeType === 0) {
            if ($post->dislikedBy($user)) {
                $post->likes()->where('user_id', $user_id)->where('type', $likeType)->delete();
                return response()->json([
                    'message' => 'Post dislike deleted'
                ])->setStatusCode(200);
            }

            $like = $this->createLike($likeType, $user_id);
            $post->likes()->save($like);

            return response()->json([
                'message' => 'Post dislike created'
            ])->setStatusCode(201);
        } else if ($likeType === 1) {
            if ($post->likedBy($user)) {
                $post->likes()->where('user_id', $user_id)->where('type', $likeType)->delete();
                return response()->json([
                    'message' => 'Post like deleted'
                ])->setStatusCode(200);
            }

            $like = $this->createLike($likeType, $user_id);

            $post->likes()->save($like);

            return response()->json([
                'message' => 'Post like created'
            ])->setStatusCode(201);
        }
    }
}
