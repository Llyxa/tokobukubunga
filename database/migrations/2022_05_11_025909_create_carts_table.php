<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('carts', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('user_id');
        //     $table->string('product_id');
        //     $table->integer('qty')->default(0);
        //     // $table->double('harga')->default(0); harga dari tabel products
        //     $table->double('subtotal');
        //     $table->timestamps();
        // });

        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('product_id');
            $table->foreignId('transaction_id');
            // $table->integer('cart_id')->unsigned();
            $table->integer('qty')->default(0);
            // $table->double('harga', 12, 2)->default(0);
            $table->double('diskon', 12, 2)->default(0);
            $table->double('subtotal', 12, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
};
