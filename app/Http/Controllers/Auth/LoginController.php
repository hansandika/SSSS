<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $attr = $request->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);

        if (Auth::attempt(['email' => $attr['email'], 'password' => $attr['password']], $request->remember)) {
            return redirect('/')->with('success', 'Login Successfully');
        }

        return redirect('/login')->with('error', 'Invalid Credential');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Logout Successfully');;
    }

    public function providerLogin($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function providerCallback($provider)
    {
        try {
            $socialiteUser = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            return redirect('/login');
        }

        if (explode("@", $socialiteUser->email)[1] !== 'shibaura-it.ac.jp') {
            return redirect()->to('/')->with('error', 'You must use Shibaura Institute of Technology email address');
        }

        $user = User::where([
            'provider' => $provider,
            'provider_id' => $socialiteUser->getId()
        ])->first();

        if (!$user) {
            $validator = Validator::make(
                ['email' => $socialiteUser->getEmail()],
                ['email' => 'unique:users,email'],
                ['email.unique' => 'The email has already been taken.']
            );

            if ($validator->fails()) {
                return redirect('/login')->withErrors($validator);
            }

            $user = User::create([
                'name' => $socialiteUser->getName(),
                'email' => $socialiteUser->getEmail(),
                'provider' => $provider,
                'provider_id' => $socialiteUser->getId(),
            ]);
        }
        Auth::login($user);
        return redirect('/');
    }
}
