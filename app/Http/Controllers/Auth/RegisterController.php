<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $attr = $request->validate([
            'email' => ['required', 'email:rfc,dns', 'unique:users,email'],
            'date_of_birth' => ['required', 'before:today'],
            'password' => ['required', 'min:7', 'max:30', 'alpha_num'],
            'confirm-password' => ['required', 'same:password'],
            'gender' => ['required', 'in:male,female,non-binary'],
            'agreement' => ['required']
        ]);

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
