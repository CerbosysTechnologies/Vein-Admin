<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    public  function getForgotPassword(){
        return view("admin.auth.forgotpassword");
    }
}
