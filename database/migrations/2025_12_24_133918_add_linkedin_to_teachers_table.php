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
        Schema::table('teachers', function (Blueprint $table) {
            if (!Schema::hasColumn('teachers', 'linkedin')) {
                $table->string('linkedin')->nullable()->after('phone');
            }
            if (!Schema::hasColumn('teachers', 'google_scholar')) {
                $table->string('google_scholar')->nullable()->after('linkedin');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->dropColumn(['linkedin', 'google_scholar']);
        });
    }
};
