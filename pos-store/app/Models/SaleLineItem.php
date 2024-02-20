<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleLineItem extends Model
{
    protected $fillable = ['quantity', 'subtotal'];
    protected $table = 'salelines';
    public $timestamps = false;

    public function item()
    {
        return $this->belongsTo(Items::class, 'itemId','id');
    }
    
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}
