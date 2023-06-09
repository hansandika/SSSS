<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Helper\RenewTokenSession;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only(['logout']);
    }

    public function index()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            RenewTokenSession::refreshToken($request);

            $user = Auth::user();
            if ($user->isAdmin($user)) {
                return redirect()->route('admin.index');
            }

            return redirect('/')->with('success', 'Login Successfully');
        }
        return redirect('/login')->with('error', 'Invalid Credential');
    }

    public function logout(Request $request)
    {
        Session()->flush();

        $request->user()->forceFill([
            'api_token' => null,
        ])->save();

        Auth::logout();
        return redirect('/')->with('success', 'Logout Successfully');
    }

    public function providerLogin($provider)
    {
        return Socialite::driver($provider)->with(["prompt" => "select_account"])->redirect();
    }

    public function providerCallback($provider, Request $request)
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
            'email' => $socialiteUser->getEmail(),
        ])->first();

        if (!$user) {
            $user = User::Create([
                'email' => $socialiteUser->getEmail(),
                'provider' => $provider,
                'provider_id' => $socialiteUser->getId(),
            ]);
        }

        if ($user && $user->provider !== $provider) {
            return redirect()->to('/')->with('error', 'You have already registered with another provider');
        }

        if ($user && !$user->provider_id) {
            $user->update([
                'provider' => $provider,
                'provider_id' => $socialiteUser->getId(),
            ]);
        }

        Auth::login($user);
        RenewTokenSession::refreshToken($request);

        return redirect('/')->with('success', 'Login Successfully');
    }
}
