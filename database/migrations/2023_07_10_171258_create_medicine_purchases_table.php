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
        Schema::create('medicine_purchases', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('medicine_id');
            $table->bigInteger('purchase_id');
            $table->integer('quantity');
            $table->bigInteger('purchase_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicine_purchases');
    }
};
