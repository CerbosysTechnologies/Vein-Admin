<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    public function showResetForm(Request $request)
    {
        return view('admin.auth.resetpassword'); 
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8', // Assuming you require a minimum of 8 characters for the new password
        ]);

        // Attempt to reset the password for the admin user
        $status = Password::broker('admins')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                // Set the new password for the user
                $user->password = Hash::make($password);
                $user->save();

                // Dispatch event after password is successfully reset
                event(new PasswordReset($user));
            }
        );

        // Check if the password was successfully reset
        if ($status == Password::PASSWORD_RESET) {
            // Password successfully reset, log in the user if needed
            // For admin users, you may or may not want to log them in automatically after resetting the password

            // Redirect the user to the admin dashboard or login page with success message
            return redirect()->route('admin.dashboard')->with('status', 'Your password has been reset successfully.');
        } else {
            // Password reset failed, redirect back to the password reset form with error message
            return redirect()->back()->withInput($request->only('email'))->withErrors(['email' => trans($status)]);
        }
    }
}
