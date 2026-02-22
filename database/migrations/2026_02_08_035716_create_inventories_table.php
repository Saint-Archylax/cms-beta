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
        if (Schema::hasTable('inventories')) {
            return;
        }

        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('material_id');
            $table->decimal('current_quantity', 12, 2)->default(0);
            $table->decimal('threshold_quantity', 12, 2)->default(0);
            $table->timestamps();

            $table->unique('material_id');
            $table->index('material_id');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
