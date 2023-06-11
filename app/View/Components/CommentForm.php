<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CommentForm extends Component
{
    public string $postSlug;
    public string $parentId;

    public function __construct(string $postSlug, string $parentId = '')
    {
        $this->postSlug = $postSlug;
        $this->parentId = $parentId;
    }

    public function render(): View|Closure|string
    {
        return view('components.comment-form', [
            'postSlug' => $this->postSlug,
            'parentId' => $this->parentId,
        ]);
    }
}
