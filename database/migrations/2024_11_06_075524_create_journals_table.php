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
        Schema::create('journals', function (Blueprint $table) {
            $table->id(); // journal_id
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // User who created the journal entry
            $table->date('entry_date'); // Date of the journal entry
            $table->string('title')->nullable(); // Optional title for the journal entry
            $table->text('content'); // Main content of the journal entry
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journals');
    }
};
