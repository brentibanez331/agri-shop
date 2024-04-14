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
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('tag_name');
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('merchant_id');
            $table->unsignedBigInteger('tag_id');
            $table->string('product_name');
            $table->text('description');
            $table->integer('no_of_stocks');
            $table->decimal('product_rating');
            $table->text('product_image_url');
            $table->integer('items_sold');

            $table->foreign('merchant_id')->references('id')->on('merchants')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('products_merchant_id_foreign');
            $table->dropForeign('products_tag_id_foreign');
        });

        Schema::dropIfExists('tags');
        Schema::dropIfExists('products');
    }
};
