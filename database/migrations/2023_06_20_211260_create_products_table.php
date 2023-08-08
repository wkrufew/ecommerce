<?php

use App\Models\Product;
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

            $table->string('name');
            $table->string('slug');
            $table->longText('description');
            $table->float('price');
            $table->float('discount')->default(0);
            $table->boolean('nuevo')->default(false);
            $table->boolean('destacado')->default(false);
            $table->text('ficha')->nullable();
            $table->text('video')->nullable();
            $table->integer('quantity')->nullable();
            $table->enum('status',[Product::BORRADOR, Product::PUBLICADO])->default(Product::BORRADOR);
            $table->unsignedBigInteger('subcategory_id');
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');

            $table->unsignedBigInteger('brand_id');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');

            
            $table->timestamps();

            $table->index('subcategory_id');
            $table->index('brand_id');
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
