<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $attr = $request;

        if (explode("@", $attr['email'])[1] !== 'shibaura-it.ac.jp') {
            return redirect()->to('/')->with('error', 'You must use Shibaura Institute of Technology email address');
        }

        $attr['date_of_birth'] = date('Y-m-d', strtotime($attr['dob']));
        $attr['name'] = substr($request->email, 0, strpos($request->email, '@'));
        $attr['password'] = bcrypt($attr['password']);

        User::create($attr);

        return redirect('/login')->with('success', 'Register Successfully');
    }
}
