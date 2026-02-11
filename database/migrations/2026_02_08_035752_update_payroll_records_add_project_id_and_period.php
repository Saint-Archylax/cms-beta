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
        Schema::table('payroll_records', function (Blueprint $table) {
            $table->foreignId('project_id')->nullable()->after('team_member_id')
                ->constrained('projects')->nullOnDelete();

            $table->date('period_start')->nullable()->after('project_id');
            $table->date('period_end')->nullable()->after('period_start');

            $table->decimal('total_amount', 12, 2)->nullable()->after('salary');
            $table->enum('status', ['pending','completed'])->default('pending')->after('total_amount');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
