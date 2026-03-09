<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnMoney extends Model
{

protected $table = 'returns';

protected $fillable = [

'user_id',

'person',

'reason',

'date',

'expected_return_date',

'amount',

'status'

];

}