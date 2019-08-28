<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'name', 'price', 'user_id', 'company_id',
    ];
}
