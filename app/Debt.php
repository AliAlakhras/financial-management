<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    protected $fillable = ['purchase_id', 'paid', 'due', 'company_id'];

    public function purchases(){
        return $this->belongsTo(Purchase::class);
    }
}
