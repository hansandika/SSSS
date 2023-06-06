<?php

namespace App\View\Components;

use App\Models\Post;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PostShowCard extends Component
{
    public Post $post;
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function render(): View|Closure|string
    {
        return view('components.post-show-card', [
            'post' => $this->post,
        ]);
    }
}
