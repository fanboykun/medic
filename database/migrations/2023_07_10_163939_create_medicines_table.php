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
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('storage');
            $table->string('stock');
            $table->bigInteger('unit_id');
            $table->bigInteger('category_id');
            $table->date('expired');
            $table->string('description');
            $table->bigInteger('purchase_price');
            $table->bigInteger('selling_price');
            $table->bigInteger('supplier_id');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicines');
    }
};
