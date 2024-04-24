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
        Schema::create('merchants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('store_name');
            $table->integer('no_of_products');
            $table->decimal('merchant_rating', 8, 1);
            $table->text('image_url')->nullable()->default('unknown.jpg');
            $table->string('city');
            $table->string('country');
            $table->string('state');
            $table->string('pickup_address');
            $table->string('postal_code');
            $table->string('tin');
            $table->string('reg_address');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('merchants', function (Blueprint $table) {
            $table->dropForeign('merchants_user_id_foreign');
        });

        Schema::dropIfExists('merchants');
    }
};
