@extends('layouts.auth')

@section('content')

<h2 class="form-title">Enter Login Code</h2>

@if(session('error'))
<div class="alert-error">
{{ session('error') }}
</div>
@endif

<form method="POST">

@csrf

<div class="form-group">

<label>Enter OTP</label>

<input
type="text"
name="otp"
class="form-control"
placeholder="4 digit code"
required>

</div>

<button type="submit" class="btn-primary">
Verify
</button>

</form>

@endsection