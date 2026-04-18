<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
                $user = User::create([
                    'name' => $fbUser->name,
                    'user_name' => $fbUser->name,
                    'email' => '',
                    'facebook_id' => $fbUser->id,
                    'password' => bcrypt('123456dummy')
                ]);
            }

            Auth::login($user);

            return redirect()->route('feedback');
        } catch (\Exception $e) {
            return redirect()->route('feedback')->with('error', 'Login failed');
        }
    }
}
