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
        Schema::create('kenali_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('order')->default(0)->comment('Display order');
            $table->string('icon')->comment('FontAwesome icon class');
            $table->string('title')->comment('Info section title');
            $table->text('description')->comment('Info section description');
            $table->string('color', 7)->comment('Hex color for icon gradient');
            $table->boolean('active')->default(true)->comment('Is this info active/visible');
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
        Schema::dropIfExists('kenali_infos');
    }
};
