<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('finance_funds', function (Blueprint $table) {
            $table->id();
            $table->decimal('balance', 15, 2)->default(1200000);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('finance_funds');
    }
};
