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
        Schema::create('medicine_sale', function (Blueprint $table) {

            $table->foreignId('medicine_id')->required()->constrained()->cascadeOnDelete();
            $table->foreignId('sell_id')->required()->constrained('sales')->cascadeOnDelete();
            $table->float('selling_price')->required();
            $table->integer('quantity')->required();
            $table->primary(['medicine_id', 'sell_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicine_sales');
    }
};
