@extends('layouts.auth')


@section('content')

<div class="navbar">


<h2 class="form-title">Profile</h2>



@if(session('success'))
<div style="background:#2ecc71;color:white;padding:10px;border-radius:6px;margin-bottom:15px;text-align:center;">
{{ session('success') }}
</div>
@endif

@if(session('error'))
<div style="background:#e74c3c;color:white;padding:10px;border-radius:6px;margin-bottom:15px;text-align:center;">
{{ session('error') }}
</div>
@endif


<!-- EMAIL UPDATE -->

{{-- <h3 style="margin-top:10px;margin-bottom:10px;">User Details</h3> --}}

<form method="POST" action="/profile/update-email">

@csrf

<div class="form-group">

<label>Email Address</label>

<input 
type="email"
name="email"
value="{{ $user->email }}"
class="form-control"
placeholder="Enter new email"
required>

</div>

<button type="submit" class="btn-primary">
Update Email
</button>

</form>


<hr style="margin:25px 0;">



<!-- CHANGE PASSWORD -->

<h3 style="margin-bottom:10px;">Change Password</h3>

<form method="POST" action="/profile/send-password-otp">

@csrf

<button type="submit" class="btn-primary">
Send Verification Code
</button>

</form>


@if(session('otp_sent'))

<form method="POST" action="/profile/verify-password-otp" style="margin-top:15px;">

@csrf

<div class="form-group">

<label>Verification Code</label>

<input
type="text"
name="otp"
class="form-control"
placeholder="Enter verification code">

</div>

<button type="submit" class="btn-primary">
Verify Code
</button>

</form>

@endif



@if(session('password_verified'))

<form method="POST" action="/profile/change-password" style="margin-top:15px;">

@csrf

<div class="form-group">

<label>New Password</label>

<input
type="password"
name="password"
class="form-control"
placeholder="Enter new password">

</div>

<div class="form-group">

<label>Confirm Password</label>

<input
type="password"
name="confirm_password"
class="form-control"
placeholder="Confirm password">

</div>

<button type="submit" class="btn-primary">
Save Password
</button>

</form>

@endif



<hr style="margin:25px 0;">



<!-- NOTIFICATIONS -->

<h3 style="margin-bottom:10px;">Notifications</h3>

<form method="POST" action="/profile/toggle-notifications">

@csrf

<label style="display:flex;align-items:center;gap:10px;font-weight:500;">

<input
type="checkbox"
name="enabled"
value="1"

{{ $user->notifications_enabled ? 'checked' : '' }}

onchange="this.form.submit()">

Enable Notifications

</label>

</form>



<hr style="margin:25px 0;">



<!-- QUICK LINKS -->

<h3 style="margin-bottom:10px;">Directions</h3>

<div class="auth-footer">

<div class="navbar">

<a href="/calendar">Calendar</a>
<a href="/transactions">Transactions</a>
<a href="/profile">Profile</a>
<a href="/about">About</a>
<a href="/logout">Logout</a>

</div>

</div>


@endsection