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
            ['name' => 'About', 'url' => '/about', 'icon' => 'uil uil-info-circle'],
        ];

        $this->navItemsNotAuth = [
            ['name' => 'Login', 'url' => '/login', 'icon' => 'uil uil-signin'],
            ['name' => 'Register', 'url' => '/register', 'icon' => 'uil uil-user-plus'],
        ];

        $this->navItemsAuth = [
            ['name' => 'Dashboard', 'url' => '/dashboard', 'icon' => 'uil uil-apps', 'desktopName' => 'My Profile', 'description' => 'View Profile'],
            ['name' => 'Settings', 'url' => '/settings', 'icon' => 'uil uil-cog', 'desktopName' => 'User Settings', 'description' => 'Account settings and more'],
            ['name' => 'Logout', 'url' => '/logout', 'icon' => 'uil uil-signout', 'desktopName' => 'Logout Account', 'description' => 'Logout from your account'],
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
