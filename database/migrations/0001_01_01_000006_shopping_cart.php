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
        Schema::create('shopping_cart', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->integer('total_items')->default(0);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('cart_item', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cart_id')->nullable();
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity');
            $table->decimal('price');

            $table->foreign('cart_id')->references('id')->on('shopping_cart')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shopping_cart', function (Blueprint $table) {
            $table->dropForeign('shopping_cart_user_id_foreign');
        });

        Schema::table('cart_item', function (Blueprint $table) {
            $table->dropForeign('cart_item_cart_id_foreign');
            $table->dropForeign('cart_item_product_id_foreign');
        });

        Schema::dropIfExists('shopping_cart');
        Schema::dropIfExists('cart_item');
    }
};
