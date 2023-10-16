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
        Schema::create('replace_increase_equip1', function (Blueprint $table) {
            $table->id();
            $table->string('levelNo');
            $table->string('year');
            $table->string('description');
            $table->decimal('price');
            $table->decimal('price_total');
            $table->string('unit');
            $table->string('qty');
            $table->string('reason');
            $table->string('deptId');
            $table->string('remark');
            $table->string('userId');
            $table->string('enable');
            $table->string('approved');
            $table->string('approved_at');
            $table->string('approved_userId');
            $table->string('deleted_at');
            $table->string('deleted_userId');
            $table->string('request_type');
            $table->timestamps();
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