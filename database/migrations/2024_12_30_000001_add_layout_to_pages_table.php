<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            if (!Schema::hasColumn('pages', 'layout')) {
                $table->string('layout')->default('default')->after('slug');
            }
            if (!Schema::hasColumn('pages', 'bg_color')) {
                $table->string('bg_color')->default('#ffffff')->after('layout');
            }
            if (!Schema::hasColumn('pages', 'text_color')) {
                $table->string('text_color')->default('#333333')->after('bg_color');
            }
            if (!Schema::hasColumn('pages', 'accent_color')) {
                $table->string('accent_color')->default('#1e3a8a')->after('text_color');
            }
            if (!Schema::hasColumn('pages', 'meta_title')) {
                $table->string('meta_title')->nullable()->after('published_at');
            }
            if (!Schema::hasColumn('pages', 'meta_description')) {
                $table->text('meta_description')->nullable()->after('meta_title');
            }
            if (!Schema::hasColumn('pages', 'meta_keywords')) {
                $table->string('meta_keywords')->nullable()->after('meta_description');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn(['layout', 'bg_color', 'text_color', 'accent_color', 'meta_title', 'meta_description', 'meta_keywords']);
        });
    }
};
