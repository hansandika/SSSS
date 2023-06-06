<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Navbar extends Component
{
    public $navItems;
    public $navItemsNotAuth;
    public $navItemsAuth;

    public function __construct()
    {
        $this->navItems = [
            ['name' => 'Home', 'url' => '/', 'icon' => 'uil uil-estate'],
            ['name' => 'FAQ', 'url' => '/faq', 'icon' => 'uil uil-question-circle'],
            ['name' => 'About Us', 'url' => '/about', 'icon' => 'uil uil-info-circle'],
        ];

        $this->navItemsNotAuth = [
            ['name' => 'Login', 'url' => '/login', 'icon' => 'uil uil-signin'],
            ['name' => 'Register', 'url' => '/register', 'icon' => 'uil uil-user-plus'],
        ];

        $this->navItemsAuth = [
            ['name' => 'Dashboard', 'url' => '/dashboard', 'icon' => 'uil uil-apps'],
            ['name' => 'Logout', 'url' => '/logout', 'icon' => 'uil uil-signout'],
        ];
    }

    public function render(): View|Closure|string
    {
        return view('layouts.navbar', [
            'navItems' => $this->navItems,
            'navItemsNotAuth' => $this->navItemsNotAuth,
            'navItemsAuth' => $this->navItemsAuth,
        ]);
    }
}
