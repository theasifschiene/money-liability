@extends('layouts.auth')

@section('content')

<div class="title">Verify Email</div>

@if(session('error'))
<div class="error-box">
{{ session('error') }}
</div>
@endif

<form method="POST" action="/verify/{{ $id }}">

@csrf

<div class="input-group">
<label>Verification Code</label>
<input type="text" name="otp" placeholder="Enter the 4 digit code" required>
</div>

<button type="submit">Verify Account</button>

</form>@extends('layouts.auth')

@section('content')

<h2 class="form-title">Verify Email</h2>

<form method="POST" action="/verify/{{ $id }}">

@csrf

<div class="form-group">

<label>Verification Code</label>

<input
type="text"
name="otp"
class="form-control"
placeholder="Enter 4 digit code"
required>

</div>

<button type="submit" class="btn-primary">
Verify Account
</button>

</form>

@endsection

@endsection