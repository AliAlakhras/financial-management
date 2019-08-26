<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = [
        'type', 'income', 'user_id', 'company_id',
    ];

    public function users(){
        return $this->belongsTo(User::class);
    }

}
