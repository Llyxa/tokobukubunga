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
        Schema::create('transactions', function (Blueprint $table) {
            // $table->id();
            // $table->foreignId('users_id');
            // $table->foreignId('payment_option_id');
            // $table->foreignId('delivery_id');
            // $table->foreignId('cart_id');
            // $table->string('alamat');
            // $table->integer('qty_total'); //jumlah produk yang dibeli
            // $table->double('ongkir');
            // $table->double('diskon');
            // $table->double('total'); //jumlah dari subtotal + ongkir - diskon
            // $table->date('tgl_transaksi');
            // $table->string('status_pembayaran');// ada 2 sudah dan belum
            // $table->string('status_pengiriman');// ada 2 yaitu belum dan sudah
            // $table->timestamps();

            $table->id();
            $table->foreignId('user_id');
            $table->string('no_invoice');
            $table->string('status_cart');// ada 2 yaitu cart, checkout
            $table->string('status_pembayaran');// ada 2 sudah dan belum
            $table->string('status_pengiriman');// ada 2 yaitu belum dan sudah
            $table->string('no_resi')->nullable();
            $table->string('ekspedisi')->nullable();
            $table->double('subtotal', 12, 2)->default(0);
            $table->double('ongkir', 12, 2)->default(0);
            $table->double('diskon', 12, 2)->default(0);
            $table->double('total', 12, 2)->default(0);
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
        Schema::dropIfExists('transactions');
    }
};
