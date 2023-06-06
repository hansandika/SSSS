<?php

namespace App\View\Components;

use App\Models\Post;
use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PostCard extends Component
{
    public User $user;
    public Post $post;

    public function __construct(Post $post, User $user)
    {
        $this->post = $post;
        $this->user = $user;
    }

    public function render(): View|Closure|string
    {
        return view('components.post-card', [
            'post' => $this->post,
            'user' => $this->user,
        ]);
    }
}
