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
            $table->string('event_location')->nullable()->after('views');
            $table->enum('event_status', ['open', 'ongoing', 'completed'])->default('open')->after('event_location');
            $table->integer('event_participants')->default(0)->after('event_status');
            $table->string('event_cta_type')->default('detail')->after('event_participants'); // register, detail, download
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
