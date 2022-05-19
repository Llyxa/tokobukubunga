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
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id');
            $table->foreignId('product_id');
            $table->integer('qty'); //qty tiap produk 
            $table->integer('total'); //harga tiap produk dikali qty
            $table->string('no_resi')->nullable();
            $table->string('ekspedisi')->nullable();
            $table->double('ongkir', 12, 2)->default(0);
            $table->double('diskon', 12, 2)->default(0);
            // $table->double('total', 12, 2)->default(0);
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
        Schema::dropIfExists('transaction_details');
    }
};
