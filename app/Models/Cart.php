<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;
    // protected $guarded = ['id'];

    // protected $table = 'carts';
    // protected $fillable = [
    //     'user_id',
    //     'product_id',
    //     'qty',
    //     'subtotal'
    // ];

    // public function product(){
    //     return $this->hasOne(Product::class, 'id', 'product_id');
    // }

    // public function user(){
    //     return $this->hasOne(User::class);
    // }

    // public function detail() {
    //     return $this->hasMany(App\CartDetail::class, 'cart_id');
    // }

    protected $table = 'carts';
    protected $fillable = [
        'user_id',
        'product_id',
        'transaction_id',
        'qty',
        // 'harga',
        'diskon',
        'subtotal',
    ];

    public function transaction() {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }

    public function produk() {
        return $this->belongsTo('App\Product', 'product_id');
    }

    // function untuk update qty, sama subtotal
    public function updatedetail($itemdetail, $qty, $harga) {
        $this->attributes['qty'] = $itemdetail->qty + $qty;
        $this->attributes['subtotal'] = $itemdetail->subtotal + ($qty * $harga);
        self::save();
    }

    

}
