<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('voucher_code');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('merchant_id')->nullable();
            $table->float('discount')->nullable();
            
            $table->foreign('merchant_id')->references('id')->on('merchants')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vouchers', function (Blueprint $table) {
            $table->dropForeign('vouchers_merchant_id_foreign');
            $table->dropForeign('vouchers_product_id_foreign');
        });

        Schema::dropIfExists('vouchers');
    }
};
