<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Str;

class FaqItem extends Component
{
    public string $question;
    public string $answer;
    public string $heading;
    public string $body;

    public function __construct(string $question, string $answer, string $idx)
    {
        $this->question = $question;
        $this->answer = $answer;
        $this->heading = 'heading' . Str::slug($question) . '-' . $idx;
        $this->body = 'body' . Str::slug($question) . '-' . $idx . '-body';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.faq-item', [
            'question' => $this->question,
            'answer' => $this->answer,
            'heading' => $this->heading,
            'body' => $this->body,
        ]);
    }
}
