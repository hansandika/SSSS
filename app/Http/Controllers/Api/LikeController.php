<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        if (Auth::guard('api')->check()) {
            return response()->json(['authenticated' => true, 'user' => $user]);
        }

        return response()->json(['authenticated' => false, 'user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if (Auth::guard('api')->check()) {
            return response()->json(['authenticated' => true, 'user' => $user]);
        }

        return response()->json(['authenticated' => auth('api')->check(), 'user' => $user]);


        $comment = Comment::find($request->comment_id);
        if (!$comment) {
            return response()->json([
                'message' => 'Comment not found'
            ])->setStatusCode(404);
        }

        if (!$request->like_type) {
            return response()->json([
                'message' => 'Like Type is required'
            ]);
        }

        return response()->json([
            'message' => 'Test donag',
        ]);
        $likeType = (int)$request->like_type;
        $user_id = auth('api')->user()->id;
        return response()->json([
            'message' => 'Test donag',
            'user' => $user_id
        ]);



        if ($likeType !== 0 && $likeType !== 1) {
            return response()->json([
                'message' => 'Invalid type'
            ])->setStatusCode(400);
        }

        if ($likeType === 0) {
            if ($comment->dislikeBy($user_id)) {
                $comment->likes()->where('user_id', $user_id)->delete();
                return response()->json([
                    'message' => 'Dislike deleted'
                ])->setStatusCode(200);
            }

            $comment->likes()->create([
                'user_id' => $user_id,
                'type' => 0
            ]);

            return response()->json([
                'message' => 'Dislike created'
            ])->setStatusCode(201);
        } else if ($likeType === 1) {
            return response()->json([
                'message' => 'Test donag',
                'user_id' => $user_id
            ]);
            if ($comment->likeBy($user_id)) {
                $comment->likes()->where('user_id', $user_id)->delete();
                return response()->json([
                    'message' => 'Like deleted'
                ])->setStatusCode(200);
            }

            $comment->likes()->create([
                'user_id' => $user_id,
                'type' => 1
            ]);

            return response()->json([
                'message' => 'Like created'
            ])->setStatusCode(201);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
