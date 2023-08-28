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
        Schema::create('medicine_purchase', function (Blueprint $table) {

            $table->foreignId('medicine_id')->required()->constrained()->cascadeOnDelete();
            $table->foreignId('purchase_id')->required()->constrained()->cascadeOnDelete();
            $table->integer('quantity')->required();
            $table->float('purchase_price')->required();
            $table->primary(['medicine_id', 'purchase_id']);
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
