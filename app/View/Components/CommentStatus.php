<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CommentStatus extends Component
{
    public bool $isLiked;
    public bool $isDisliked;
    public int $likesCount;
    public int $dislikesCount;
    public string $parentId;
    public string $postSlug;

    public function __construct(bool $isLiked = false, bool $isDisliked = false, int $likesCount, int $dislikesCount, string $parentId = '', string $postSlug = '')
    {
        $this->isLiked = $isLiked;
        $this->isDisliked = $isDisliked;
        $this->likesCount = $likesCount;
        $this->dislikesCount = $dislikesCount;
        $this->parentId = $parentId;
        $this->postSlug = $postSlug;
    }

    public function render(): View|Closure|string
    {
        return view('components.comment-status', [
            'isLiked' => $this->isLiked,
            'isDisliked' => $this->isDisliked,
            'likesCount' => $this->likesCount,
            'dislikesCount' => $this->dislikesCount,
            'parentId' => $this->parentId,
            'postSlug' => $this->postSlug,
        ]);
    }
}
