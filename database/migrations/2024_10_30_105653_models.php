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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('event_name', 100);
            $table->text('event_description');
            $table->dateTime('event_date');
            $table->integer('price_adult');
            $table->integer('price_kid');
            $table->integer('price_discount');
            $table->integer('price_group');
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->integer('ticket_adult_quantity');
            $table->integer('ticket_kid_quantity');
            $table->integer('ticket_discount_quantity');
            $table->integer('ticket_group_quantity');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->integer('equal_price');
            $table->dateTime('created');
        
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
        });

        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('event_id');
            $table->string('ticket_type', 10);
            $table->string('barcode', 16)->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('tickets');
    }
};
