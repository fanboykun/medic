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
        Schema::create('medicine_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medicine_id')->required()->constrained()->nullOnDelete();
            $table->date('expired')->required();
            $table->integer('stock')->default(0)->required();
            $table->float('purchase_price')->required();
            $table->float('selling_price')->required();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicine_items');
    }
};
