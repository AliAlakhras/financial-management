<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseDetailes extends Model
{
    protected $fillable = [
        'product_id', 'quantity', 'cost', 'purchase_id',
    ];
    public function purchase(){
        return $this->belongsTo(Purchase::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
