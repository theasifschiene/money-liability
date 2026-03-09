@extends('layouts.auth')

@section('content')

<h2 class="form-title">Reset Password</h2>

<form method="POST">

@csrf

<div class="form-group">

<label>OTP Code</label>

<input
type="text"
name="otp"
class="form-control"
placeholder="Enter reset code"
required>

</div>

<div class="form-group">

<label>New Password</label>

<input
type="password"
name="password"
class="form-control"
placeholder="Enter new password"
required>

</div>

<button type="submit" class="btn-primary">
Reset Password
</button>

</form>

@endsection