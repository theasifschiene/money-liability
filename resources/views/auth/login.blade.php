@extends('layouts.auth')

@section('content')

<h2 class="form-title">Sign In</h2>

@if(session('error'))
<div class="alert-error">
{{ session('error') }}
</div>
@endif


<form method="POST" action="/login">

@csrf

<div class="form-group">

<label>Email Address</label>

<input 
type="email"
name="email"
class="form-control"
placeholder="Enter your email"
required>

</div>

<div class="form-group">

<label>Password</label>

<input
type="password"
name="password"
class="form-control"
placeholder="Enter password"
required>

</div>

<button type="submit" class="btn-primary">
Sign In
</button>

</form>


<form method="POST" action="/login-otp" style="margin-top:15px;">

@csrf

<input type="hidden" name="email" id="otp_email">

<button type="submit" class="btn-secondary">
Login With OTP
</button>

</form>


<div class="auth-footer">

<a href="/signup">Create Account</a>

</div>


<script>

document.querySelector("form").addEventListener("submit",function(){

document.getElementById("otp_email").value =
document.querySelector("input[name=email]").value;

});

</script>

@endsection