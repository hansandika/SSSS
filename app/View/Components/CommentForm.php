<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CommentForm extends Component
{
    public string $postSlug;
    public function __construct(string $postSlug)
    {
        $this->postSlug = $postSlug;
    }

    public function render(): View|Closure|string
    {
        return view('components.comment-form', [
            'postSlug' => $this->postSlug,
        ]);
    }
}
