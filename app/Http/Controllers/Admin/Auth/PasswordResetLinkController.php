<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordEmail;
use App\Models\Admin;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.auth.forgotpassword');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);
        // We will send the password reset link to this user.
                $email = $request->input('email');
                $status = Password::broker('admins')->sendResetLink(['email' => $email]);

    
        // Check if the password reset link was sent successfully
        if ($status === Password::RESET_LINK_SENT) {
            // Retrieve the user based on the email
            $user = Admin::where('email', $request->email)->first();
    
            // Generate the password reset link
            $token = Password::broker('admins')->createToken($user);
    
            // Generate the password reset link using the ResetPassword notification
            $resetLink = url(config('app.url').route('admin.password.reset', [
                'token' => $token,
                'email' => $user->email,
            ], false));
            
            // Send password reset email using mail template
            $viewPath = 'admin.auth.emails.reset_password';
            Mail::to($request->email)->send(new ResetPasswordEmail($resetLink, $viewPath));
        }
    
        // Redirect back with status or errors
        return $status == Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status)]);
    }
}
