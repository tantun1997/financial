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
        Schema::create('dept', function (Blueprint $table) {
            $table->id();
            $table->string('deptName')->unique();
            $table->bigInteger('manageDept')->nullable();
            $table->bigInteger('manageId')->nullable();
            $table->boolean('enable')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dept');
    }
};
