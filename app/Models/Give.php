<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Give extends Model
{

protected $fillable = [

'user_id',

'person',

'reason',

'date',

'tolded_date',

'expected_give_date',

'amount',

'status'

];

}