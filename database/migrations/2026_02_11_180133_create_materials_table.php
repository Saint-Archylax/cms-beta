<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('supplier_name');
            $table->string('supplier')->nullable();
            $table->string('unit')->default('pcs'); // kg / sack / pcs etc
            $table->decimal('unit_price', 12, 2)->default(0); // from MMS
            $table->decimal('stock', 12, 2)->default(0);      // managed by IMS
            $table->decimal('min_threshold', 12, 2)->default(0);
            $table->decimal('max_threshold', 12, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
