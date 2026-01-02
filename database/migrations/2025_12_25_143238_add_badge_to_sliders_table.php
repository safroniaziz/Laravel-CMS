<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sliders', function (Blueprint $table) {
            if (!Schema::hasColumn('sliders', 'badge_text')) {
                $table->string('badge_text')->nullable()->after('image_position');
            }
            if (!Schema::hasColumn('sliders', 'badge_subtext')) {
                $table->string('badge_subtext')->nullable()->after('badge_text');
            }
            if (!Schema::hasColumn('sliders', 'badge_show')) {
                $table->boolean('badge_show')->default(true)->after('badge_subtext');
            }
        });
    }

    public function down(): void
    {
        Schema::table('sliders', function (Blueprint $table) {
            $table->dropColumn(['badge_text', 'badge_subtext', 'badge_show']);
        });
    }
};
