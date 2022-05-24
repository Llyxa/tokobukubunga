<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Genre;
use App\Models\Category;
use App\Models\Delivery;
use App\Models\Publisher;
use App\Models\Transaction;
use App\Models\PaymentOption;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function publisher(){
        return $this->belongsTo(Publisher::class);
    }

    public function genre(){
        return $this->belongsToMany(Genre::class, 'genre_product');
    }
    
    // public function transaction(){
    //     return $this->belongsToMany(Transaction::class);
    // }

    // public function delivery(){
    //     return $this->belongsTo(Delivery::class);
    // }

    // public function paymentOption(){
    //     return $this->belongsTo(PaymentOption::class);
    // }

    public function cart(){
        return $this->belongsTo(Cart::class);
    }
}
