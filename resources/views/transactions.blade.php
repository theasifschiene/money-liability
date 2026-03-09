<!DOCTYPE html>
<html>
<head>

<title>Transactions</title>

<style>

body{
font-family:Arial;
padding:20px;
background:#f5f7fb;
}

table{
width:100%;
border-collapse:collapse;
background:white;
margin-bottom:30px;
}

th,td{
border:1px solid #ddd;
padding:10px;
text-align:center;
}

th{
background:#f2f2f2;
}

.month-row{
background:#222;
color:white;
font-weight:bold;
text-align:left;
}

.paid{
background:#d7e9ff;
}

.overdue{
background:#ffd9d2;
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

button{
padding:5px 10px;
border:none;
border-radius:4px;
cursor:pointer;
}

button:hover{
opacity:0.8;
}

</style>

</head>

<body>


<div class="navbar">

<a href="/calendar">Calendar</a>
<a href="/transactions">Transactions</a>
<a href="/profile">Profile</a>
<a href="/about">About</a>
<a href="/logout">Logout</a>

</div>


<h2>Transactions</h2>


@php

$all = collect();

/* merge returns */
foreach($returns as $r){
$all->push([
'type' => 'Return',
'person' => $r->person,
'amount' => $r->amount,
'reason' => $r->reason,
'created' => $r->created_at,
'updated' => $r->updated_at,
'status' => $r->status,
'id' => 'return_'.$r->id
]);
}

/* merge gives */
foreach($gives as $g){
$all->push([
'type' => 'Give',
'person' => $g->person,
'amount' => $g->amount,
'reason' => $g->reason,
'created' => $g->created_at,
'updated' => $g->updated_at,
'status' => $g->status,
'id' => 'give_'.$g->id
]);
}

/* sort newest first */
$all = $all->sortByDesc('created');

/* group by month */
$grouped = $all->groupBy(function($item){
return \Carbon\Carbon::parse($item['created'])->format('F Y');
});

@endphp



@foreach($grouped as $month => $transactions)

<table>

<tr class="month-row">
<td colspan="8">📅 {{ $month }}</td>
</tr>

<tr>
<th>Type</th>
<th>Person</th>
<th>Amount</th>
<th>Reason</th>
<th>Created Date</th>
<th>Last Update</th>
<th>Status</th>
<th>Action</th>
</tr>


@foreach($transactions as $t)

<tr class="{{ $t['status'] ? 'paid' : '' }}">

<td>{{ $t['type'] }}</td>

<td>{{ $t['person'] }}</td>

<td>₹{{ $t['amount'] }}</td>

<td>{{ $t['reason'] }}</td>

<td>{{ $t['created']->format('Y-m-d H:i') }}</td>

<td>{{ $t['updated']->format('Y-m-d H:i') }}</td>

<td>

@if($t['status'])
Paid
@else
Pending
@endif

</td>

<td>

<button onclick="markPaid('{{ $t['id'] }}')">
Mark Paid
</button>

<button onclick="deleteTx('{{ $t['id'] }}')">
Delete
</button>

</td>

</tr>

@endforeach

</table>

@endforeach



<script>

function markPaid(id){

fetch("/complete-transaction/"+id,{

method:"PUT",

headers:{
"X-CSRF-TOKEN":"{{ csrf_token() }}"
}

}).then(()=>location.reload())

}


function deleteTx(id){

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