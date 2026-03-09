@extends('layouts.auth')

@section('content')

<h2 class="form-title">Forgot Password</h2>

<form method="POST" action="/forgot">

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

<button type="submit" class="btn-primary">
Send Reset Code
</button>

<div class="auth-footer">

<a href="/login">Back to Sign In</a>

</div>

</form>

@endsection