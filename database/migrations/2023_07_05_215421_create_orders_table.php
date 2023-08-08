<?php

use App\Models\Order;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('contact');

            $table->string('phone');

            $table->enum('status', [Order::PENDIENTE,Order::RECIBIDO, Order::ENVIADO, Order::ENTREGADO, Order::ANULADO])->default(Order::PENDIENTE);

            $table->enum('envio_type', [1, 2]);

            $table->float('shipping_cost');

            $table->float('total');

            $table->json('content');

            $table->json('envio')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
