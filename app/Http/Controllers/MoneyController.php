<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Give;
use App\Models\ReturnMoney;

class MoneyController extends Controller
{

/* =========================
   CALENDAR PAGE
========================= */

public function calendar()
{

$userId = Auth::id();

$returns = ReturnMoney::where('user_id',$userId)->get();
$gives = Give::where('user_id',$userId)->get();

$totalReturnMonth = ReturnMoney::where('user_id',$userId)
->whereMonth('expected_return_date',date('m'))
->sum('amount');

$totalGiveMonth = Give::where('user_id',$userId)
->whereMonth('expected_give_date',date('m'))
->sum('amount');

$paidReturns = ReturnMoney::where('user_id',$userId)
->where('status',true)
->sum('amount');

$paidGives = Give::where('user_id',$userId)
->where('status',true)
->sum('amount');

return view('calendar',[
'returns'=>$returns,
'gives'=>$gives,
'totalReturnMonth'=>$totalReturnMonth,
'totalGiveMonth'=>$totalGiveMonth,
'paidReturns'=>$paidReturns,
'paidGives'=>$paidGives
]);

}



/* =========================
   TRANSACTIONS PAGE
========================= */

public function transactions()
{

$userId = Auth::id();

$returns = ReturnMoney::where('user_id',$userId)->get();
$gives = Give::where('user_id',$userId)->get();

return view('transactions',[
'returns'=>$returns,
'gives'=>$gives
]);

}



/* =========================
   ADD TRANSACTION
========================= */

public function addTransaction(Request $request)
{

$userId = Auth::id();

if($request->type == "give"){

Give::create([
'user_id'=>$userId,
'person'=>$request->person,
'reason'=>$request->reason,
'date'=>$request->date,
'expected_give_date'=>$request->date,
'amount'=>$request->amount,
'status'=>false
]);

}else{

ReturnMoney::create([
'user_id'=>$userId,
'person'=>$request->person,
'reason'=>$request->reason,
'date'=>$request->date,
'expected_return_date'=>$request->date,
'amount'=>$request->amount,
'status'=>false
]);

}

return back();

}



/* =========================
   UPDATE TRANSACTION
========================= */

public function updateTransaction(Request $request,$id)
{

$userId = Auth::id();

$parts = explode("_",$id);

$type = $parts[0];
$id = $parts[1];

if($type == "give"){

$give = Give::where('user_id',$userId)->findOrFail($id);

$give->update([
'person'=>$request->person,
'reason'=>$request->reason,
'amount'=>$request->amount
]);

}else{

$return = ReturnMoney::where('user_id',$userId)->findOrFail($id);

$return->update([
'person'=>$request->person,
'reason'=>$request->reason,
'amount'=>$request->amount
]);

}

return back();

}



/* =========================
   MARK PAID
========================= */

public function completeTransaction($id)
{

$userId = Auth::id();

$parts = explode("_",$id);

$type = $parts[0];
$id = $parts[1];

if($type == "give"){

$give = Give::where('user_id',$userId)->findOrFail($id);

$give->status = true;
$give->save();

}else{

$return = ReturnMoney::where('user_id',$userId)->findOrFail($id);

$return->status = true;
$return->save();

}

return back();

}



/* =========================
   DELETE TRANSACTION
========================= */

public function deleteTransaction($id)
{

$userId = Auth::id();

$parts = explode("_",$id);

$type = $parts[0];
$id = $parts[1];

if($type == "give"){

$give = Give::where('user_id',$userId)->findOrFail($id);
$give->delete();

}else{

$return = ReturnMoney::where('user_id',$userId)->findOrFail($id);
$return->delete();

}

return back();

}



/* =========================
   STATISTICS PAGE
========================= */

public function statistics()
{

$userId = Auth::id();

$today = now()->startOfDay();
$week = now()->startOfWeek();
$month = now()->startOfMonth();
$year = now()->startOfYear();

/* TODAY */

$todayReturn = ReturnMoney::where('user_id',$userId)
->whereDate('created_at',$today)
->sum('amount');

$todayGive = Give::where('user_id',$userId)
->whereDate('created_at',$today)
->sum('amount');

$todaySpend = Give::where('user_id',$userId)
->where('status',true)
->whereDate('updated_at',$today)
->sum('amount');

$todayCollect = ReturnMoney::where('user_id',$userId)
->where('status',true)
->whereDate('updated_at',$today)
->sum('amount');


/* WEEK */

$weekReturn = ReturnMoney::where('user_id',$userId)
->where('created_at','>=',$week)
->sum('amount');

$weekGive = Give::where('user_id',$userId)
->where('created_at','>=',$week)
->sum('amount');

$weekSpend = Give::where('user_id',$userId)
->where('status',true)
->where('updated_at','>=',$week)
->sum('amount');

$weekCollect = ReturnMoney::where('user_id',$userId)
->where('status',true)
->where('updated_at','>=',$week)
->sum('amount');


/* MONTH */

$monthReturn = ReturnMoney::where('user_id',$userId)
->where('created_at','>=',$month)
->sum('amount');

$monthGive = Give::where('user_id',$userId)
->where('created_at','>=',$month)
->sum('amount');

$monthSpend = Give::where('user_id',$userId)
->where('status',true)
->where('updated_at','>=',$month)
->sum('amount');

$monthCollect = ReturnMoney::where('user_id',$userId)
->where('status',true)
->where('updated_at','>=',$month)
->sum('amount');


/* YEAR */

$yearReturn = ReturnMoney::where('user_id',$userId)
->where('created_at','>=',$year)
->sum('amount');

$yearGive = Give::where('user_id',$userId)
->where('created_at','>=',$year)
->sum('amount');

$yearSpend = Give::where('user_id',$userId)
->where('status',true)
->where('updated_at','>=',$year)
->sum('amount');

$yearCollect = ReturnMoney::where('user_id',$userId)
->where('status',true)
->where('updated_at','>=',$year)
->sum('amount');


return view('statistics',[

'todayReturn'=>$todayReturn,
'todayGive'=>$todayGive,
'todaySpend'=>$todaySpend,
'todayCollect'=>$todayCollect,

'weekReturn'=>$weekReturn,
'weekGive'=>$weekGive,
'weekSpend'=>$weekSpend,
'weekCollect'=>$weekCollect,

'monthReturn'=>$monthReturn,
'monthGive'=>$monthGive,
'monthSpend'=>$monthSpend,
'monthCollect'=>$monthCollect,

'yearReturn'=>$yearReturn,
'yearGive'=>$yearGive,
'yearSpend'=>$yearSpend,
'yearCollect'=>$yearCollect

]);

}



/* =========================
   REMINDERS PAGE
========================= */

public function reminders()
{

$userId = Auth::id();

$reminders = collect();


/* RETURN REMINDERS */

$returns = ReturnMoney::where('user_id',$userId)
->where('status',false)
->get();

foreach($returns as $r){

$hours = now()->diffInHours($r->expected_return_date,false);

if($hours <= 12 && $hours >= 0){

$reminders->push([
'type'=>'return',
'person'=>$r->person,
'amount'=>$r->amount,
'reason'=>$r->reason,
'created'=>$r->created_at,
'expected'=>$r->expected_return_date
]);

}

}


/* GIVE REMINDERS */

$gives = Give::where('user_id',$userId)
->where('status',false)
->get();

foreach($gives as $g){

$hours = now()->diffInHours($g->expected_give_date,false);

if($hours <= 12 && $hours >= 0){

$reminders->push([
'type'=>'give',
'person'=>$g->person,
'amount'=>$g->amount,
'reason'=>$g->reason,
'created'=>$g->created_at,
'expected'=>$g->expected_give_date
]);

}

}

return view('reminders',compact('reminders'));

}


}