<?php

namespace App\Models;

use App\Models\CartDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;
    protected $table = carts;
    protected $fillable = [
        'user_id',
        'product_id',
        'qty',
        'subtotal'
    ];

    public function product(){
        return $this->hasMany(Product::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    // public function detail() {
    //     return $this->hasMany(App\CartDetail::class, 'cart_id');
    // }

    // public function updatetotal($itemcart, $subtotal) {
    //     $this->attributes['subtotal'] = $itemcart->subtotal + $subtotal;
    //     $this->attributes['total'] = $itemcart->total + $subtotal;
    //     self::save();
    // }

}
