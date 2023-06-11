<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $listMembers = [
            ['name' => 'Hans', 'image' => 'hans.jpg', 'role' => 'Founder'],
            ['name' => 'Edo', 'image' => 'edo.jpg', 'role' => 'Founder'],
            ['name' => 'Dary', 'image' => 'dary.jpg', 'role' => 'Founder'],
            ['name' => 'Yu', 'image' => 'yu.jpg', 'role' => 'Founder'],
            ['name' => 'Okabe', 'image' => 'edo.jpg', 'role' => 'Founder'],
        ];
        return view('about', ['listMembers' => $listMembers]);
    }
}
