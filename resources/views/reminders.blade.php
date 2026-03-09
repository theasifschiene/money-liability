<!DOCTYPE html>
<html>

<head>

<title>Reminders</title>

<style>

body{
font-family:Arial;
background:#f5f7fb;
padding:20px;
}

.navbar{
margin-bottom:20px;
}

.navbar a{
margin-right:20px;
text-decoration:none;
font-weight:bold;
color:#333;
}

.reminder{
background:white;
margin-bottom:10px;
border-radius:8px;
box-shadow:0 3px 8px rgba(0,0,0,0.1);
cursor:pointer;
}

.reminder-header{
padding:15px;
font-size:16px;
font-weight:bold;
}

.reminder-details{
display:none;
padding:15px;
border-top:1px solid #eee;
font-size:14px;
color:#555;
}

</style>

</head>

<body>


<div class="navbar">

<a href="/calendar">📅 Calendar</a>
<a href="/transactions">📊 Transactions</a>
<a href="/statistics">📈 Statistics</a>
<a href="/reminders">🔔 Reminders</a>

</div>


<h2>Reminders</h2>


@if($reminders->count()==0)

<p>No upcoming reminders.</p>

@endif



@foreach($reminders as $index=>$r)

<div class="reminder" onclick="toggleDetails({{ $index }})">

<div class="reminder-header">

@if($r['type']=="return")

{{ $r['person'] }} have to return ₹{{ $r['amount'] }} tomorrow

@else

You have to give ₹{{ $r['amount'] }} to {{ $r['person'] }} tomorrow

@endif

</div>


<div class="reminder-details" id="details{{ $index }}">

<b>Reason:</b> {{ $r['reason'] }} <br>

<b>Transaction Created:</b> {{ $r['created'] }} <br>

<b>Expected Date:</b> {{ $r['expected'] }}

</div>

</div>

@endforeach



<script>

function toggleDetails(id){

var box = document.getElementById("details"+id);

if(box.style.display === "block"){

box.style.display = "none";

}else{

box.style.display = "block";

}

}

</script>


</body>

</html>