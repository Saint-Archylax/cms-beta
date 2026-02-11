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
        Schema::table('project_team_member', function (Blueprint $table) {
            $table->string('assigned_role')->nullable()->after('team_member_id');
            $table->date('assigned_date')->nullable()->after('assigned_role');
            $table->boolean('is_active')->default(true)->after('assigned_date');
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
