<!DOCTYPE html>
<html>
<head>

<title>Statistics</title>

<style>

body{
font-family:Arial;
padding:20px;
background:#f5f7fb;
}

.navbar{
margin-bottom:20px;
}

.navbar a{
margin-right:20px;
font-weight:bold;
text-decoration:none;
color:#333;
}

.statistics{
display:grid;
grid-template-columns:repeat(4,1fr);
gap:20px;
}

.card{
background:white;
padding:20px;
border-radius:10px;
box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

.card h3{
margin-bottom:10px;
}

hr{
margin:10px 0;
}

</style>

</head>

<body>

<div class="navbar">

<a href="/calendar">📅 Calendar</a>
<a href="/transactions">📊 Transactions</a>
<a href="/statistics">📈 Statistics</a>

</div>

<h2>Statistics</h2>


<div class="statistics">

<div class="card">

<h3>Today</h3>

Return: ₹{{ $todayReturn }} <br>
Give: ₹{{ $todayGive }}

<hr>

Spend: ₹{{ $todaySpend }} <br>
Collect: ₹{{ $todayCollect }}

</div>


<div class="card">

<h3>This Week</h3>

Return: ₹{{ $weekReturn }} <br>
Give: ₹{{ $weekGive }}

<hr>

Spend: ₹{{ $weekSpend }} <br>
Collect: ₹{{ $weekCollect }}

</div>


<div class="card">

<h3>This Month</h3>

Return: ₹{{ $monthReturn }} <br>
Give: ₹{{ $monthGive }}

<hr>

Spend: ₹{{ $monthSpend }} <br>
Collect: ₹{{ $monthCollect }}

</div>


<div class="card">

<h3>This Year</h3>

Return: ₹{{ $yearReturn }} <br>
Give: ₹{{ $yearGive }}

<hr>

Spend: ₹{{ $yearSpend }} <br>
Collect: ₹{{ $yearCollect }}

</div>

</div>

</body>
</html>