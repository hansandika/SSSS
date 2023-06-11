<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\Post;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class PostForm extends Component
{

    public string $url;
    public string $title;
    public string $action;
    public string $method;
    public Post $post;

    public function __construct(string $url, string $title, string $action, string $method, Post $post = null)
    {
        $this->url = $url;
        $this->title = $title;
        $this->action = $action;
        $this->method = $method;
        $this->post = $post;
    }

    public function render(): View|Closure|string
    {
        return view('components.post-form', [
            'url' => $this->url,
            'title' => $this->title,
            'action' => $this->action,
            'method' => $this->method,
            'post' => $this->post,
        ]);
    }
}
