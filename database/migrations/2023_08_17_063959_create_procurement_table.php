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
        Schema::create('procurements', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('procurementType');
            $table->integer('priorityNo');
            $table->string('description');
            $table->decimal('price');
            $table->string('package');
            $table->integer('quant');
            $table->integer('objectTypeId');
            $table->string('reason')->nullable();
            $table->integer('deptId');
            $table->integer('budget');
            $table->integer('time');
            $table->text('remark')->nullable();
            $table->bigInteger('userId');
            $table->boolean('enable')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('procurements');
    }
};
