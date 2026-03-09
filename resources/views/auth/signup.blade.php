@extends('layouts.auth')

@section('content')

<h2 class="form-title">Sign Up</h2>

@if(session('error'))
<div class="alert-error">
{{ session('error') }}
</div>
@endif

@if ($errors->any())
<div class="alert-error">
{{ $errors->first() }}
</div>
@endif


<form method="POST" action="/signup">

@csrf

<div class="form-group">

<label>Email Address</label>

<input
type="email"
name="email"
class="form-control"
placeholder="example@email.com"
required>

</div>


<div class="form-group">

<label>Password</label>

<input
type="password"
name="password"
class="form-control"
placeholder="Minimum 6 characters"
required>

</div>


<button type="submit" class="btn-primary">
Create Account
</button>


<div class="auth-footer">

<a href="/login">
Already have an account? Sign In
</a>

</div>

</form>



<style>

.alert-error{

background:#ffdddd;
padding:10px;
border-radius:6px;
margin-bottom:15px;
color:#b30000;

animation:fadeout 5s forwards;

}

@keyframes fadeout{

0%{opacity:1;}
80%{opacity:1;}
100%{opacity:0;}

}

</style>

@endsection