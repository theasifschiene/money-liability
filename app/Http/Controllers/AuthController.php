<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{

/* =========================
   SIGNUP PAGE
========================= */

public function showSignup()
{
    return view('auth.signup');
}


/* =========================
   SIGNUP (NO OTP)
========================= */

public function signup(Request $request)
{

    $request->validate([
        'email' => 'required|email:rfc,dns',
        'password' => 'required|min:6'
    ]);

    $existing = User::where('email', $request->email)->first();

    if ($existing) {
        return redirect('/login')
        ->with('error', 'This email already exists. Please login.');
    }

    $user = User::create([
        'name' => 'User',
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'verified' => true
    ]);

    Auth::login($user);

    return redirect('/calendar');
}


/* =========================
   LOGIN PAGE
========================= */

public function showLogin()
{
    return view('auth.login');
}


/* =========================
   LOGIN WITH PASSWORD
========================= */

public function login(Request $request)
{

    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if (Auth::attempt($request->only('email','password'))) {

        return redirect('/calendar');
    }

    return back()->with('error','Invalid email or password');
}


/* =========================
   SEND LOGIN OTP
========================= */

public function sendLoginOtp(Request $request)
{

    $request->validate([
        'email' => 'required|email'
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return back()->with('error','Email not found');
    }

    $otp = rand(1000,9999);

    $user->otp = $otp;
    $user->save();

    try {

        Mail::raw("Your Money Liability login code is: ".$otp, function($msg) use ($user){

            $msg->to($user->email)
            ->subject("Login Verification Code");

        });

    } catch (\Exception $e) {

        return back()->with('error','Unable to send email');

    }

    return redirect('/login-verify/'.$user->id);
}


/* =========================
   OTP VERIFY PAGE
========================= */

public function loginVerifyPage($id)
{
    return view('auth.login_verify', compact('id'));
}


/* =========================
   VERIFY LOGIN OTP
========================= */

public function verifyLoginOtp(Request $request, $id)
{

    $request->validate([
        'otp' => 'required'
    ]);

    $user = User::find($id);

    if (!$user) {
        return back()->with('error','User not found');
    }

    if ($user->otp == $request->otp) {

        $user->otp = null;
        $user->save();

        Auth::login($user);

        return redirect('/calendar');
    }

    return back()->with('error','Invalid verification code');
}


/* =========================
   LOGOUT
========================= */

public function logout()
{
    Auth::logout();
    return redirect('/login');
}

}