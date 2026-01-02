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
            if (!Schema::hasColumn('posts', 'event_location')) {
                $table->string('event_location')->nullable()->after('views');
            }
            if (!Schema::hasColumn('posts', 'event_status')) {
                $table->enum('event_status', ['open', 'ongoing', 'completed'])->default('open')->after('event_location');
            }
            if (!Schema::hasColumn('posts', 'event_participants')) {
                $table->integer('event_participants')->default(0)->after('event_status');
            }
            if (!Schema::hasColumn('posts', 'event_cta_type')) {
                $table->string('event_cta_type')->default('detail')->after('event_participants');
            }
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
