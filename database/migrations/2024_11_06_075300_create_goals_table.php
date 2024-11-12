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
        Schema::create('goals', function (Blueprint $table) {
            $table->id(); // goal_id
            $table->foreignId('mentee_id')->constrained('users')->onDelete('cascade');
            $table->text('goal_description');
            $table->enum('progress_status', ['not_started', 'in_progress', 'completed'])->default('not_started');
            $table->date('completion_date')->nullable();
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goals');
    }
};
