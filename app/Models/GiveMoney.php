<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GiveMoney extends Model
{

protected $table = "gives";

protected $fillable = [

'person',
'reason',
'amount',
'date',
'expected_give_date',
'status'

];

protected $casts = [

'status' => 'boolean'

];

}