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
        // Migration ini akan menambahkan settings melalui seeder
        // Tidak perlu mengubah struktur table settings
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Rollback akan dilakukan melalui seeder juga
    }
};
