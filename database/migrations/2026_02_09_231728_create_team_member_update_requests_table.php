<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('team_member_update_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_member_id')->constrained()->onDelete('cascade');

            // stores only fields they want to change
            $table->json('changes');

            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('remarks')->nullable(); // for reject reason
            $table->timestamp('reviewed_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('team_member_update_requests');
    }
};
