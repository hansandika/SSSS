<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use Illuminate\Http\Request;

class FAQController extends Controller
{

    public function __invoke(Request $request)
    {
        $listFaq = FAQ::get();
        return view('faq', compact("listFaq"));
    }
}
