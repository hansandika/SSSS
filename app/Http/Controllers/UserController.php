<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function dashboard()
    {
        $user = auth()->user();
        return view('users.dashboard', compact('user'));
    }

    public function settings()
    {
        $user = auth()->user();
        $genders = ['male', 'female', 'non-binary'];
        return view('users.settings', compact('user', 'genders'));
    }

    public function update(UserRequest $request)
    {
        $validated = $request->validated();
        $validated['date_of_birth'] = date('Y-m-d', strtotime($validated['date_of_birth']));
        $user = auth()->user();

        if ($request->file('avatar')) {
            if ($user->avatar) {
                Storage::delete('public/profile-image/' . $user->avatar);
            }
            $file = $request->file('avatar');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('storage/profile-image/'), $filename);
            $validated['avatar'] = $filename;
        }

        $user->update($validated);
        return redirect()->route('dashboard')->with('success', 'Profile updated successfully');
    }
}
