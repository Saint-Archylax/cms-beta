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
        Schema::create('progress_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_member_id')->constrained()->cascadeOnDelete();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();

            $table->date('report_date');
            $table->text('description');

            $table->enum('status', ['pending','approved','rejected'])->default('pending');
            $table->foreignId('validated_by')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
            $table->index(['project_id', 'report_date']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress_reports');
    }
};
