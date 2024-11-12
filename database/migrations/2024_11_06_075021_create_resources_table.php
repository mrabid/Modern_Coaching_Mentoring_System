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
        Schema::create('resources', function (Blueprint $table) {
            $table->id(); // resource_id
            $table->foreignId('mentor_id')->constrained('users')->onDelete('cascade');
            $table->string('file_url'); // URL of the file in S3
            $table->text('description')->nullable();
            $table->timestamp('upload_date')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resources');
    }
};
