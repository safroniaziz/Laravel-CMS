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
        Schema::create('kenali_stats', function (Blueprint $table) {
            $table->id();
            $table->integer('order')->default(0)->comment('Display order');
            $table->string('icon')->comment('FontAwesome icon class');
            $table->string('number', 20)->comment('Stat number/value');
            $table->string('label')->comment('Stat label/description');
            $table->boolean('active')->default(true)->comment('Is this stat active/visible');
            $table->timestamps();
            
            $table->index('order');
            $table->index('active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kenali_stats');
    }
};
