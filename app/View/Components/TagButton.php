<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TagButton extends Component
{
    public string $tag;
    public function __construct(string $tag)
    {
        $this->tag = $tag;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tag-button', [
            'tag' => $this->tag,
        ]);
    }
}
