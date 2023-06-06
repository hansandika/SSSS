<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TermsAndConditionsController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('terms-and-condition');
    }
}
