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
        Schema::table('days', function (Blueprint $table) {
            $table->unsignedBigInteger('subject_id');
            $table->integer('day_1')->nullable(false);
            $table->integer('day_2')->nullable(false);
            $table->integer('day_3')->nullable(false);
            $table->integer('day_4')->nullable(false);
            $table->integer('day_5')->nullable(false);
            $table->integer('day_6')->nullable(false);
            $table->integer('day_7')->nullable(false);
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('days');
    }
};
