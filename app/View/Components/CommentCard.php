<?php

namespace App\View\Components;

use App\Models\Comment;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CommentCard extends Component
{
    public Comment $comment;
    public string $parentId;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
        $this->parentId = $comment->parent_id ? $comment->parent_id : $comment->id;
    }

    public function render(): View|Closure|string
    {
        return view('components.comment-card', [
            'comment' => $this->comment,
            'parentId' => $this->parentId,
        ]);
    }
}
