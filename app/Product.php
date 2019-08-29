<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'quantity', 'cost', 'total', 'company_id',
    ];

    public function purchasedetailes(){
        return $this->hasMany(PurchaseDetailes::class);
    }
}
