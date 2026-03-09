<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoneyController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;




Route::get('/', function () {
    return redirect('/calendar');
});


Route::get('/calendar',[MoneyController::class,'calendar'])->middleware('auth');
Route::get('/transactions',[MoneyController::class,'transactions']);

Route::post('/add-transaction',[MoneyController::class,'addTransaction']);

Route::put('/update-transaction/{id}',[MoneyController::class,'updateTransaction']);

Route::delete('/delete-transaction/{id}',[MoneyController::class,'deleteTransaction']);

Route::put('/complete-transaction/{id}',[MoneyController::class,'completeTransaction']);

Route::get('/statistics',[MoneyController::class,'statistics'])->middleware('auth');

Route::get('/reminders',[MoneyController::class,'reminders'])->middleware('auth');

Route::get('/signup',[AuthController::class,'showSignup']);
Route::post('/signup',[AuthController::class,'signup']);

Route::get('/verify/{id}',[AuthController::class,'showVerify']);
Route::post('/verify/{id}',[AuthController::class,'verify']);

Route::get('/login',[AuthController::class,'showLogin'])->name('login');Route::post('/login',[AuthController::class,'login']);

Route::post('/login-otp',[AuthController::class,'sendLoginOtp']);

Route::get('/login-verify/{id}',[AuthController::class,'loginVerifyPage']);

Route::post('/login-verify/{id}',[AuthController::class,'verifyLoginOtp']);

Route::get('/logout',[AuthController::class,'logout']);

Route::get('/forgot',[AuthController::class,'forgot']);

Route::post('/forgot',[AuthController::class,'sendReset']);

Route::get('/reset/{id}',[AuthController::class,'resetPage']);
Route::post('/reset/{id}',[AuthController::class,'resetPassword']);

// ABOUT PAGE ROUTE
Route::get('/about', function () {
    return view('about');
})->middleware('auth');


Route::middleware('auth')->group(function(){

Route::get('/profile',[ProfileController::class,'profile']);

Route::post('/profile/update-email',[ProfileController::class,'updateEmail']);

Route::post('/profile/send-password-otp',[ProfileController::class,'sendPasswordOtp']);

Route::post('/profile/verify-password-otp',[ProfileController::class,'verifyPasswordOtp']);

Route::post('/profile/change-password',[ProfileController::class,'changePassword']);

});

Route::post('/profile/toggle-notifications',[ProfileController::class,'toggleNotifications']);