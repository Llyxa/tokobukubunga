<?php

namespace App\Models;

use App\Models\Cart;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;
    // protected $guarded = ['id'];
    protected $table = 'transactions';
    protected $fillable = [
        'user_id',
        'no_invoice',
        'status_cart',
        'status_pembayaran',
        'status_pengiriman',
        'no_resi',
        'ekspedisi',
        'subtotal',
        'ongkir',
        'diskon',
        'total',
    ];

    public function user() {
        return $this->belongsTo('App\User','user_id');
    }

    public function cart() {
        return $this->hasMany(Cart::class, 'transaction_id');
    }

    public function updatetotal($itemtransaksi, $total) {
        $this->attributes['total'] = $itemtransaksi->total + $total;
        self::save();
    }
    // public function product(){
    //     return $this->belongsTo(Product::class);
    // }

    // public function delivery(){
    //     return $this->belongsTo(Delivery::class);
    // }

    // public function paymentOption(){
    //     return $this->belongsTo(PaymentOption::class);
    // }

}
