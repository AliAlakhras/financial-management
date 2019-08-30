<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = ['product_id', 'quantity', 'cost', 'total', 'user_id', 'company_id'];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
