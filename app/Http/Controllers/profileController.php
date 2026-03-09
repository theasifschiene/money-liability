<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{

public function profile()
{
    $user = Auth::user();
    return view('profile',compact('user'));
}



public function updateEmail(Request $request)
{
    $request->validate([
        'email'=>'required|email'
    ]);

    $user = Auth::user();
    $user->email = $request->email;
    $user->save();

    return back()->with('success','Email updated');
}



public function sendPasswordOtp()
{
    $user = Auth::user();

    $otp = rand(1000,9999);

    $user->otp = $otp;
    $user->save();

    try {

        Mail::raw("Your password change code is: $otp", function($msg) use ($user){
            $msg->to($user->email)
            ->subject("Password Change Verification");
        });

    } catch (\Exception $e) {

        return back()->with('error','Unexpected Error! Please try later.');

    }

    return back()->with('otp_sent',true);
}



public function verifyPasswordOtp(Request $request)
{
    $user = Auth::user();

    if($user->otp == $request->otp){

        session(['password_verified'=>true]);

        return back();
    }

    return back()->with('error','Wrong Code');
}



public function changePassword(Request $request)
{
    if(!session('password_verified')){
        return back()->with('error','Verify code first');
    }

    $request->validate([
        'password'=>'required|min:6|same:confirm_password'
    ]);

    $user = Auth::user();

    $user->password = Hash::make($request->password);
    $user->otp = null;
    $user->save();

    session()->forget('password_verified');

    return back()->with('success','Password changed');
}



public function toggleNotifications(Request $request)
{
    $user = Auth::user();

    $user->notifications_enabled = $request->enabled ? true : false;

    $user->save();

    return back();
}

}