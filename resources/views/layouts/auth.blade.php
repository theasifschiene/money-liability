<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Money-Liability</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{
height:100vh;
display:flex;
flex-direction:column;
align-items:center;
justify-content:center;

background: linear-gradient(-45deg,#ff512f,#dd2476,#ff7e5f,#feb47b);
background-size:400% 400%;
animation:gradientBG 10s ease infinite;
}

@keyframes gradientBG{
0%{background-position:0% 50%;}
50%{background-position:100% 50%;}
100%{background-position:0% 50%;}
}

.app-title{

font-size:42px;
font-weight:700;
margin-bottom:25px;

background: linear-gradient(90deg,#fff,#ffd700,#fff,#ff00cc,#fff);
background-size:300%;

-webkit-background-clip:text;
-webkit-text-fill-color:transparent;

animation:textShine 6s linear infinite;
}

@keyframes textShine{
0%{background-position:0%}
100%{background-position:300%}
}

.auth-card{

width:420px;
padding:40px;

border-radius:16px;

background:rgba(255,255,255,0.18);
backdrop-filter:blur(15px);

box-shadow:0 15px 40px rgba(0,0,0,0.3);

animation:fadeIn .8s ease;
}

@keyframes fadeIn{

from{
opacity:0;
transform:translateY(20px);
}

to{
opacity:1;
transform:translateY(0);
}

}

.form-title{

text-align:center;
font-size:26px;
font-weight:600;
margin-bottom:25px;
color:#111;
}

.form-group{
margin-bottom:18px;
}

label{
font-size:14px;
display:block;
margin-bottom:6px;
font-weight:500;
}

.form-control{

width:100%;
padding:12px 14px;

border:none;
outline:none;

border-radius:8px;

background:#f1f1f1;

font-size:14px;

transition:.3s;

}

.form-control:focus{
background:white;
box-shadow:0 0 6px rgba(0,0,0,0.2);
}

.btn-primary{

width:100%;
padding:12px;

border:none;
border-radius:8px;

background:linear-gradient(45deg,#ff512f,#dd2476);

color:white;

font-weight:600;

font-size:15px;

cursor:pointer;

margin-top:10px;

transition:.3s;

}

.btn-primary:hover{

transform:translateY(-2px);
box-shadow:0 8px 20px rgba(0,0,0,.3);

}

.auth-footer{

text-align:center;
margin-top:18px;

}

.auth-footer a{

display:block;
color:#111;
font-size:14px;
margin-top:6px;
text-decoration:none;
font-weight:500;

}

.auth-footer a:hover{
text-decoration:underline;
}

</style>

</head>

<body>

<div class="app-title">
Money-Liability
</div>

<div class="auth-card">

@yield('content')

</div>

</body>

</html>