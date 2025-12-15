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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('role', ['kaprodi', 'dosen'])->default('dosen');
            $table->string('title')->nullable();
            $table->json('expertise')->nullable()->comment('Array of expertise areas');
            $table->integer('publications')->default(0);
            $table->integer('students')->default(0);
            $table->integer('projects')->default(0);
            $table->string('gradient')->nullable()->comment('CSS gradient string');
            $table->string('icon')->default('fa-user-tie')->comment('FontAwesome icon class');
            $table->string('badge_color')->nullable()->comment('Badge color for special roles');
            $table->string('photo')->nullable()->comment('Photo path');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('bio')->nullable();
            $table->integer('order')->default(0)->comment('Display order');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('role');
            $table->index('is_active');
            $table->index('order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
