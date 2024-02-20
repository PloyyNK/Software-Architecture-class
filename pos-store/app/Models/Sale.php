<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public $timestamps = false;

    public function lineItems()
    {
        return $this->hasMany(SaleLineItem::class, 'saleId'); 
    }
}
