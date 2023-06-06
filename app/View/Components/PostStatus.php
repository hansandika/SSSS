<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PostStatus extends Component
{
    public bool $isLiked;
    public bool $isDisliked;
    public int $likesCount;
    public int $dislikesCount;
    public int $commentsCount;

    public function __construct(bool $isLiked = false, bool $isDisliked = false, int $likesCount, int $dislikesCount, int $commentsCount)
    {
        $this->isLiked = $isLiked;
        $this->isDisliked = $isDisliked;
        $this->likesCount = $likesCount;
        $this->dislikesCount = $dislikesCount;
        $this->commentsCount = $commentsCount;
    }

    public function render(): View|Closure|string
    {
        return view('components.post-status', [
            'isLiked' => $this->isLiked,
            'isDisliked' => $this->isDisliked,
            'likesCount' => $this->likesCount,
            'dislikesCount' => $this->dislikesCount,
            'commentsCount' => $this->commentsCount,
        ]);
    }
}
