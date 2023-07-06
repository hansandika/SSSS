<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SideNavbarAdmin extends Component
{
    public $navItems;
    public function __construct()
    {
        $this->navItems = [
            [
                'name' => 'Dashboard',
                'url' => '/admin',
                'icon' => 'uil uil-apps',
            ],
            [
                'name' => 'Users',
                'url' => '/admin/users',
                'icon' => 'uil uil-user',
            ],
            [
                'name' => 'Posts',
                'url' => '/admin/posts',
                'icon' => 'uil uil-newspaper',
            ],
            [
                'name' => 'Categories',
                'url' => '/admin/categories',
                'icon' => 'uil uil-folder',
            ],
            [
                'name' => 'Comments',
                'url' => '/admin/comments',
                'icon' => 'uil uil-comment',
            ]
        ];
    }

    public function render(): View|Closure|string
    {
        return view('layouts.admin.side-navbar-admin', [
            'navItems' => $this->navItems,
        ]);
    }
}
