<!DOCTYPE html>
<html>
<head>

<title>About - Money Liability</title>

<style>

.developer-container{
display:flex;
align-items:center;
justify-content:space-between;
gap:40px;
flex-wrap:wrap;
}

.dev-details{
flex:1;
font-size:16px;
line-height:30px;
}

.dev-image{
flex:1;
text-align:right;
}

.dev-image img{
width:260px;
border-radius:15px;
box-shadow:0 10px 25px rgba(0,0,0,0.2);
transition:0.3s;
}

.dev-image img:hover{
transform:scale(1.05);
}

body{
font-family:Arial;
margin:0;
padding:0;
background:linear-gradient(135deg,#4facfe,#00f2fe);
min-height:100vh;
}


.container{
width:90%;
max-width:1100px;
margin:auto;
padding:40px;
}


.title{
text-align:center;
color:white;
font-size:40px;
font-weight:bold;
margin-bottom:40px;
}


.card{
background:white;
border-radius:12px;
padding:30px;
margin-bottom:30px;
box-shadow:0 10px 25px rgba(0,0,0,0.1);
}


.section-title{
font-size:26px;
margin-bottom:20px;
font-weight:bold;
color:#333;
}


.dev-box{
display:flex;
align-items:center;
justify-content:space-between;
flex-wrap:wrap;
}


.dev-details{
line-height:30px;
font-size:16px;
}


.link{
color:#007bff;
text-decoration:none;
font-weight:bold;
}


.link:hover{
text-decoration:underline;
}


.list{
margin-left:20px;
line-height:28px;
}


.footer{
text-align:center;
color:white;
margin-top:40px;
font-size:14px;
}

.navbar{
display:flex;
justify-content:space-between;
align-items:center;
background:rgba(255,255,255,0.08);
backdrop-filter:blur(10px);
padding:15px 25px;
border-radius:12px;
margin-bottom:25px;
}

.nav-left{
display:flex;
gap:25px;
font-weight:600;
}

.nav-left a{
text-decoration:none;
color:#fff;
opacity:.85;
}

.nav-left a:hover{
opacity:1;
}


</style>

</head>


<body>

<div class="nav-left">
<a href="/calendar">Calendar</a>
<a href="/transactions">Transactions</a>
<a href="/profile">Profile</a>
<a href="/about">About</a>
<a href="/logout">Logout</a>
</div>

<div class="container">

<div class="title">
About Money Liability Application
</div>


<!-- Developer Section -->
<div class="card">

<div class="section-title">
Developer
</div>

<div class="developer-container">

<div class="dev-details">

<p><b>Name:</b> Asif Juman PK</p>

<p>
<b>Portfolio:</b>
<a class="link" href="https://asif-juman.vercel.app/" target="_blank">
https://asif-juman.vercel.app/
</a>
</p>

<p><b>Contact:</b> +91 7561092156</p>

<p>
<b>Email:</b>
<a class="link" href="mailto:asifjuman56@gmail.com">
asifjuman56@gmail.com
</a>
</p>

</div>


<div class="dev-image">

<img src="/images/asif.jpg" alt="Asif Juman">

</div>

</div>

</div>

<!-- Application Section -->

<div class="card">

<div class="section-title">
About Application
</div>


<h3>Purpose</h3>

<p>
Money Liability is a personal financial tracking application designed to help users manage money they give to others and money they expect to receive. It simplifies tracking financial liabilities and ensures users never forget payments.
</p>


<h3>Features</h3>

<ul class="list">

<li>📅 Calendar based money tracking</li>

<li>💰 Track money given and returns</li>

<li>✅ Mark payments as paid</li>

<li>⚠️ Overdue payment highlighting</li>

<li>📊 Monthly financial summary</li>

<li>🔔 Reminder notifications</li>

<li>👤 User authentication system</li>

<li>📧 Email verification and password recovery</li>

<li>📋 Transaction management table</li>

</ul>


<h3>Tools & Technologies</h3>

<ul class="list">

<li>Backend: Laravel (PHP)</li>

<li>Frontend: Blade + HTML + CSS + JavaScript</li>

<li>Database: MySQL</li>

<li>Email Service: Gmail SMTP</li>

<li>Framework: Laravel 12</li>

<li>Version Control: Git</li>

</ul>


<h3>What This Application Can Do</h3>

<p>
This application allows users to manage financial obligations efficiently by tracking who owes them money and whom they owe money. It helps organize financial records, monitor due dates, receive reminders, and maintain a clear overview of monthly financial activity.
</p>

</div>


<div class="footer">
© 2026 Money Liability Application
</div>

</div>

</body>

</html>