<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->string('code')->unique();
            $table->text('location');
            $table->text('description');
            $table->integer('progress')->default(0);
            $table->enum('status', ['ongoing', 'completed', 'pending'])->default('pending');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('client');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};