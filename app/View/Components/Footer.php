<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Footer extends Component
{
    public $footerItems;

    public function __construct()
    {
        $this->footerItems = [
            ['name' => 'FAQ', 'url' => '/faq', 'icon' => 'uil uil-question-circle'],
            ['name' => 'About Us', 'url' => '/about', 'icon' => 'uil uil-info-circle'],
            ['name' => 'Terms & Conditions', 'url' => '/terms-and-condition', 'icon' => 'uil uil-file-alt']
        ];
    }

    public function render(): View|Closure|string
    {
        return view('layouts.footer', [
            'footerItems' => $this->footerItems,
        ]);
    }
}
