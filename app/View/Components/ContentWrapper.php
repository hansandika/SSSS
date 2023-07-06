<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ContentWrapper extends Component
{
    public string $title;
    public string $link;

    public function __construct(string $title, string $link)
    {
        $this->title = $title;
        $this->link = $link;
    }

    public function render(): View|Closure|string
    {
        return view('components.content-wrapper', [
            'title' => $this->title,
            'link' => $this->link,
        ]);
    }
}
