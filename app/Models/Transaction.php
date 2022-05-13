<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function delivery(){
        return $this->belongsTo(Delivery::class);
    }

    public function paymentOption(){
        return $this->belongsTo(PaymentOption::class);
    }

}
