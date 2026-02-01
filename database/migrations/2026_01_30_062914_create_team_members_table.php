<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role');
            $table->enum('location', ['Onsite', 'Remote'])->default('Onsite');
            $table->string('salary');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('avatar')->nullable();
            $table->string('gender');
            $table->date('date_of_birth');
            $table->string('nationality');
            $table->string('address_line');
            $table->string('address_city');
            $table->string('address_state');
            $table->integer('workload')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('team_members');
    }
};