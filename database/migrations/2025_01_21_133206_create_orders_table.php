<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('pickup_location');
            $table->string('delivery_location');
            $table->decimal('size', 8, 2);
            $table->decimal('weight', 8, 2);
            $table->enum('status', ['Pending', 'In Progress', 'Delivered'])->default('Pending');
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
