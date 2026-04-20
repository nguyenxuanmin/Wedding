<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class FacebookController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback()
    {
        try {
            $fbUser = Socialite::driver('facebook')->user();
            $user = User::where('facebook_id', $fbUser->id)->first();
            if (!$user) {
                $user = new User();
                $user->name = $fbUser->name;
                $user->user_name = $fbUser->name;
                $user->email = $fbUser->email ?? $fbUser->id . '@facebook.com';
                $user->facebook_id = $fbUser->id;
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
