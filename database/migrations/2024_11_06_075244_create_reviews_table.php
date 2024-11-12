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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id(); // review_id
            $table->foreignId('session_id')->constrained('appts')->onDelete('cascade'); // Links to session
            $table->foreignId('mentee_id')->constrained('users')->onDelete('cascade'); // Mentee submitting the review
            $table->foreignId('mentor_id')->constrained('users')->onDelete('cascade'); // Mentor being reviewed
            $table->tinyInteger('rating')->unsigned()->check('rating between 1 and 5'); // Rating from 1 to 5
            $table->text('comments')->nullable(); // Optional comments
            $table->timestamp('created_at')->useCurrent(); // Review submission timestamp
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
