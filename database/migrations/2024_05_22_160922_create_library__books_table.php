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
        Schema::create('library__books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('library_id');
            $table->string('name');
            $table->text('description');
            $table->string('author');
            $table->string('type');
            $table->integer('pages');
            $table->timestamps();

            $table->foreign('library_id')
                  ->references('id')
                  ->on('libraries')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('library__books');
    }
};
