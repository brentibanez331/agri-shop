<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('merchant_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('order_ref');
            $table->integer('quantity');
            $table->float('total_amount');
            $table->float('selling_price');
            $table->string('status')->default("Pending");
            $table->string('shipping_option');
            $table->string('est_arrival');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('merchant_id')->references('id')->on('merchants')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign('transactions_product_id_foreign');
            $table->dropForeign('transactions_merchant_id_foreign');
            $table->dropForeign('transactions_user_id_foreign');
        });

        Schema::dropIfExists('transactions');
    }
};
