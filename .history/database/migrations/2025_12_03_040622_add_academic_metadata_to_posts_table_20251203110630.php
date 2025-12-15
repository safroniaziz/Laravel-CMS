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
        Schema::table('posts', function (Blueprint $table) {
            $table->string('event_location')->nullable()->after('custom_fields')->comment('Location for academic events');
            $table->enum('event_status', ['open', 'ongoing', 'completed'])->nullable()->after('event_location')->comment('Status of academic event');
            $table->integer('event_participants')->nullable()->after('event_status')->comment('Number of participants');
            $table->enum('event_cta_type', ['register', 'detail', 'download'])->nullable()->after('event_participants')->comment('CTA button type for event');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['event_location', 'event_status', 'event_participants', 'event_cta_type']);
        });
    }
};
