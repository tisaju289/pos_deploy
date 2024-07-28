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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('brand_id');

            $table->foreign('user_id')->references('id')->on('users')
                ->cascadeOnUpdate()->restrictOnDelete();

            $table->foreign('category_id')->references('id')->on('categories')
                ->cascadeOnUpdate()->restrictOnDelete();
                
            $table->foreign('brand_id')->references('id')->on('brands')
                ->cascadeOnUpdate()->restrictOnDelete();

            $table->string('name');
            $table->string('description');
            $table->string('price');
            $table->string('cost_price');
            $table->string('unit');
            $table->string('color');
            $table->string('size');
            $table->string('status')->default('active');
            $table->date('date_added');
            $table->date('expiry_date')->nullable();
            $table->string('img_url');


            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
