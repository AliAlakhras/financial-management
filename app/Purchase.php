<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'total', 'user_id', 'vendor_id', 'company_id',
    ];
    public function purchasedetailes(){
        return $this->hasMany(PurchaseDetailes::class);
    }
}
