<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $user = User::where('google_id', $googleUser->getId())->first();
            if (!$user) {
                $user = new User();
                $user->name = $googleUser->getName();
                $user->user_name = $googleUser->getName();
                $user->email = $googleUser->getEmail();
                $user->google_id = $googleUser->getId();
                $user->password = Hash::make('123456');
                $user->save();
            }
            Auth::logout();
            Auth::login($user, true);
            session()->regenerate();
            return redirect()->route('feedback');
        } catch (\Exception $e) {
            return redirect()->route('feedback')->with('error', 'Login failed');
        }
    }
}
