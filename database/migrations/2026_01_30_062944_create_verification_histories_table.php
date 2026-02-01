<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('verification_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_member_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['Verified', 'Denied']);
            $table->date('date_submitted');
            $table->date('date_checked');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('verification_histories');
    }
};