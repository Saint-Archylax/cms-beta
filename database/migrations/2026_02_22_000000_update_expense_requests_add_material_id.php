<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('expense_requests', function (Blueprint $table) {
            $table->foreignId('material_id')->nullable()->after('id')
                ->constrained('materials')->nullOnDelete();
            $table->decimal('quantity_value', 15, 2)->nullable()->after('quantity');
        });
    }

    public function down(): void
    {
        Schema::table('expense_requests', function (Blueprint $table) {
            $table->dropForeign(['material_id']);
            $table->dropColumn(['material_id', 'quantity_value']);
        });
    }
};
