<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sliders', function (Blueprint $table) {
            $table->string('badge_text')->nullable()->after('image_position');
            $table->string('badge_subtext')->nullable()->after('badge_text');
            $table->boolean('badge_show')->default(true)->after('badge_subtext');
        });
    }

    public function down(): void
    {
        Schema::table('sliders', function (Blueprint $table) {
            $table->dropColumn(['badge_text', 'badge_subtext', 'badge_show']);
        });
    }
};
