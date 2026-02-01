<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('expense_requests', function (Blueprint $table) {
            $table->id();
            $table->string('materials');
            $table->string('quantity');
            $table->string('price_per_unit');
            $table->string('total');
            $table->date('date');
            $table->enum('status', ['pending', 'complete'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('expense_requests');
    }
};