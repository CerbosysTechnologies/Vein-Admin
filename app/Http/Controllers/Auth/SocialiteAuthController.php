<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SocialiteAuthController extends Controller
{
    public function redirectToGoogle()
    {
        dd('hii');
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();
        
        $user = User::where('email', $googleUser->email)->first();

        if (!$user) {
            // User doesn't exist, create a new one
            $user = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                // You may need to handle other user data here
            ]);
        }

        Auth::login($user, true);

        return redirect()->intended('/dashboard');
    }
}
