<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            // Subtitle
            $table->string('subtitle')->nullable()->after('title');
            
            // 3 Feature items
            $table->string('feature_1_title')->nullable()->after('content');
            $table->text('feature_1_text')->nullable()->after('feature_1_title');
            $table->string('feature_1_icon')->nullable()->after('feature_1_text');
            
            $table->string('feature_2_title')->nullable()->after('feature_1_icon');
            $table->text('feature_2_text')->nullable()->after('feature_2_title');
            $table->string('feature_2_icon')->nullable()->after('feature_2_text');
            
            $table->string('feature_3_title')->nullable()->after('feature_2_icon');
            $table->text('feature_3_text')->nullable()->after('feature_3_title');
            $table->string('feature_3_icon')->nullable()->after('feature_3_text');
            
            // CTA Button
            $table->string('cta_text')->nullable()->after('feature_3_icon');
            $table->string('cta_link')->nullable()->after('cta_text');
        });
    }

    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn([
                'subtitle',
                'feature_1_title', 'feature_1_text', 'feature_1_icon',
                'feature_2_title', 'feature_2_text', 'feature_2_icon',
                'feature_3_title', 'feature_3_text', 'feature_3_icon',
                'cta_text', 'cta_link'
            ]);
        });
    }
};
