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
        Schema::table('appts', function (Blueprint $table) {
            $table->text('session_details')->nullable()->after('status'); // Add the new column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appts', function (Blueprint $table) {
            $table->dropColumn('session_details'); // Remove the column if rolled back
        });
    }
};
