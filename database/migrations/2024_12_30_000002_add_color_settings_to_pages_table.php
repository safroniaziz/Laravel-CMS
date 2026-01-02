<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            // Per-page color settings - only add if not exists
            if (!Schema::hasColumn('pages', 'bg_color')) {
                $table->string('bg_color')->default('#ffffff')->after('layout');
            }
            if (!Schema::hasColumn('pages', 'text_color')) {
                $table->string('text_color')->default('#333333')->after('bg_color');
            }
            if (!Schema::hasColumn('pages', 'accent_color')) {
                $table->string('accent_color')->default('#1e3a8a')->after('text_color');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn(['bg_color', 'text_color', 'accent_color']);
        });
    }
};
