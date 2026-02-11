<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('inventory_transactions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('material_id')->constrained('materials')->cascadeOnDelete();

            $table->enum('type', ['stock_in', 'stock_out']);
            $table->decimal('quantity', 12, 2);
            $table->decimal('remaining_stock', 12, 2)->default(0);

            // stock-out needs project
            $table->foreignId('project_id')->nullable()->constrained('projects')->nullOnDelete();

            $table->string('remarks')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory_transactions');
    }
};
