<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class TrendingPost extends Component
{
    public Collection $posts;

    public function __construct(Collection $posts)
    {
        $this->posts = $posts;
    }

    public function render(): View|Closure|string
    {
        return view('components.trending-post', [
            'posts' => $this->posts,
        ]);
    }
}
