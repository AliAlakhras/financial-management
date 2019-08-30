<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    protected $fillable = ['purchase_id', 'paid', 'due',];

    public function purchases(){
        return $this->belongsTo(Purchase::class);
    }
}
