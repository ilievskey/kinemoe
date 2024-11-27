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
        Schema::create('content', function (Blueprint $table) {
            $table->id();
            $table->string('image_path')->nullable();
            $table->string('title');
            $table->text('description');
            $table->string('url');
            $table->unsignedBigInteger('genre_id');
            $table->string('cast');
            $table->enum('content_type', ['movie', 'series', 'podcast']);
            $table->date('release_date');
            $table->dateTime('scheduled_for')->nullable();
            $table->timestamps();

            $table->foreign('genre_id')->references('id')->on('genres')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content');
    }
};
