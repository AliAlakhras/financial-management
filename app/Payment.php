<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'purchase_id', 'paid', 'company_id',
    ];
}
