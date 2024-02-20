<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $fillable = ['id', 'name', 'price'];
    public $timestamps = false;

    public function saleLineItems()
    {
        return $this->hasMany(SaleLineItem::class);
    }
}
