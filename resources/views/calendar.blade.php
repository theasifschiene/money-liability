<!DOCTYPE html>
<html>
<head>

<title>Money Calendar</title>

<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

<style>

*{
box-sizing:border-box;
margin:0;
padding:0;
font-family:'Segoe UI',sans-serif;
}

/* ANIMATED BACKGROUND */

body{
background: linear-gradient(-45deg,#141E30,#243B55,#3a2f6f,#1c1c3c);
background-size:400% 400%;
animation:gradientBG 12s ease infinite;
color:#fff;
padding:25px;
}

@keyframes gradientBG{
0%{background-position:0% 50%;}
50%{background-position:100% 50%;}
100%{background-position:0% 50%;}
}

/* NAVBAR */

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

.brand{
font-size:20px;
font-weight:700;
}

/* LAYOUT */

.container{
display:grid;
grid-template-columns:220px 1fr 240px;
gap:25px;
}

/* PANELS */

.panel{
background:rgba(255,255,255,0.08);
backdrop-filter:blur(12px);
padding:20px;
border-radius:14px;
box-shadow:0 10px 25px rgba(0,0,0,.25);
}

/* CALENDAR */

#calendar{
background:#fff;
color:#000;
padding:15px;
border-radius:12px;
}

/* LEGEND */

.legend-item{
display:flex;
align-items:center;
margin:10px 0;
font-size:14px;
}

.legend-dot{
width:10px;
height:10px;
border-radius:50%;
margin-right:8px;
}

/* CORRECT COLORS */

.return{background:#28a745;}   /* green */
.give{background:#dc3545;}     /* red */
.paid{background:#007bff;}     /* blue */
.overdue{background:#fd7e14;}  /* orange */

/* MODAL */

.modal{
display:none;
position:fixed;
top:0;
left:0;
width:100%;
height:100%;
background:rgba(0,0,0,.6);
z-index:9999;
}

.modal-content{
background:#fff;
width:420px;
padding:25px;
border-radius:10px;
position:absolute;
top:50%;
left:50%;
transform:translate(-50%,-50%);
color:#000;
}

.modal-content input,
.modal-content select{
width:100%;
padding:10px;
margin-bottom:10px;
border:1px solid #ddd;
border-radius:6px;
}

.modal-buttons{
display:flex;
gap:10px;
}

button{
padding:8px 15px;
border:none;
border-radius:6px;
cursor:pointer;
background:#2c2c54;
color:#fff;
}

button:hover{
opacity:.9;
}

</style>

</head>

<body>

<div class="navbar">

<div class="brand">Money-Liability</div>

<div class="nav-left">
<a href="/calendar">Calendar</a>
<a href="/transactions">Transactions</a>
<a href="/statistics">Statistics</a>
<a href="/profile">Profile</a>
<a href="/reminders">Reminders</a>
<a href="/about">About</a>
<a href="/logout">Logout</a>
</div>

</div>

<h2 style="margin-bottom:20px;">Money Calendar</h2>

<div class="container">

<!-- LEGEND -->

<div class="panel">

<h3>Legend</h3>

<div class="legend-item">
<div class="legend-dot return"></div> Return Expected
</div>

<div class="legend-item">
<div class="legend-dot give"></div> Give Expected
</div>

<div class="legend-item">
<div class="legend-dot paid"></div> Paid
</div>

<div class="legend-item">
<div class="legend-dot overdue"></div> Overdue
</div>

</div>

<!-- CALENDAR -->

<div class="panel">
<div id="calendar"></div>
</div>

<!-- SUMMARY -->

<div class="panel">

<h3>This Month</h3>

<p>Total Return: ₹{{ $totalReturnMonth }}</p>
<p>Total Give: ₹{{ $totalGiveMonth }}</p>

<hr style="margin:10px 0">

<p>Paid Returns: ₹{{ $paidReturns }}</p>
<p>Paid Gives: ₹{{ $paidGives }}</p>

</div>

</div>

<!-- MODAL -->

<div class="modal" id="eventModal">

<div class="modal-content">

<h3 id="modalTitle">Add Transaction</h3>

<input type="hidden" id="date">
<input type="hidden" id="edit_id">

<label>Type</label>
<select id="type">
<option value="give">Give</option>
<option value="return">Return</option>
</select>

<label>Person</label>
<input type="text" id="person">

<label>Amount</label>
<input type="number" id="amount">

<label>Reason</label>
<input type="text" id="reason">

<div class="modal-buttons">

<button id="saveBtn">Save</button>
<button onclick="closeModal()">Cancel</button>
<button id="completeBtn" style="display:none">Mark Paid</button>
<button id="deleteBtn" style="display:none">Delete</button>

</div>

</div>

</div>

<script>

let calendar;

document.addEventListener('DOMContentLoaded',function(){

calendar=new FullCalendar.Calendar(document.getElementById('calendar'),{

initialView:'dayGridMonth',

events:[

@foreach($returns as $r)

{
id:"return_{{ $r->id }}",
title:"Return {{ $r->person }} ₹{{ $r->amount }}",
start:"{{ $r->expected_return_date }}",

color:
@if($r->status)
"#007bff"   // Paid → Blue
@elseif(strtotime($r->expected_return_date) < strtotime(date('Y-m-d')))
"#fd7e14"   // Overdue → Orange
@else
"#28a745"   // Expected Return → Green
@endif

},

@endforeach

@foreach($gives as $g)

{
id:"give_{{ $g->id }}",
title:"Give {{ $g->person }} ₹{{ $g->amount }}",
start:"{{ $g->expected_give_date }}",

color:
@if($g->status)
"#007bff"   // Paid → Blue
@elseif(strtotime($g->expected_give_date) < strtotime(date('Y-m-d')))
"#fd7e14"   // Overdue → Orange
@else
"#dc3545"   // Expected Give → Red
@endif

},

@endforeach

],

dateClick:function(info){

openModal()

document.getElementById("modalTitle").innerText="Add Transaction"

document.getElementById("date").value=info.dateStr

document.getElementById("edit_id").value=""

hideEditButtons()

},

eventClick:function(info){

openModal()

document.getElementById("modalTitle").innerText="Edit Transaction"

document.getElementById("edit_id").value=info.event.id

showEditButtons()

}

})

calendar.render()

})

function openModal(){
document.getElementById("eventModal").style.display="block"
}

function closeModal(){
document.getElementById("eventModal").style.display="none"
}

function hideEditButtons(){
document.getElementById("completeBtn").style.display="none"
document.getElementById("deleteBtn").style.display="none"
}

function showEditButtons(){
document.getElementById("completeBtn").style.display="inline-block"
document.getElementById("deleteBtn").style.display="inline-block"
}

/* SAVE */

document.getElementById("saveBtn").onclick=function(){

let edit_id=document.getElementById("edit_id").value

let url="/add-transaction"
let method="POST"

if(edit_id!=""){
url="/update-transaction/"+edit_id
method="PUT"
}

fetch(url,{
method:method,
headers:{
"Content-Type":"application/json",
"X-CSRF-TOKEN":"{{ csrf_token() }}"
},
body:JSON.stringify({
person:document.getElementById("person").value,
amount:document.getElementById("amount").value,
reason:document.getElementById("reason").value,
type:document.getElementById("type").value,
date:document.getElementById("date").value
})
}).then(()=>location.reload())

}

/* MARK PAID */

document.getElementById("completeBtn").onclick=function(){

let id=document.getElementById("edit_id").value

fetch("/complete-transaction/"+id,{
method:"PUT",
headers:{
"X-CSRF-TOKEN":"{{ csrf_token() }}"
}
}).then(()=>location.reload())

}

/* DELETE */

document.getElementById("deleteBtn").onclick=function(){

let id=document.getElementById("edit_id").value

fetch("/delete-transaction/"+id,{
method:"DELETE",
headers:{
"X-CSRF-TOKEN":"{{ csrf_token() }}"
}
}).then(()=>location.reload())

}

</script>

</body>
</html>