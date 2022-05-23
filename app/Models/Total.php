<?php

namespace App\Models;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class Total 
{
    public static function total()
    {
        if (@Auth::user()->id && @Auth::user()->role === 'User') {
            $carts = Cart::where('user_id', '=', Auth::user()->id)->get();
            $array = [];
            foreach ($carts as $cart) {
                $array[] = intval($cart->subtotal);
                array_push($array);
                if ($array == []) {
                    return null;
                }
            };
            $index = collect($array);
            $index = $index->count();
            $total = 0;
            for ($i = 0; $i < $index; $i++) {
                $total += $array[$i];
            }
            return $total;
        }
        return null;
    }

}
