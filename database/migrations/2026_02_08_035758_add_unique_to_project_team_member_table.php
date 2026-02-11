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
            $table->unique(['project_id', 'team_member_id'], 'ptm_project_team_unique');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('project_team_member', function (Blueprint $table) {
            //
        });
    }
};
