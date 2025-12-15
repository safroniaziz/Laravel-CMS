<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('file_name');
            $table->string('mime_type');
            $table->string('path');
            $table->string('disk')->default('public');
            $table->string('collection_name')->default('default');
            $table->unsignedBigInteger('size');
            $table->json('custom_properties')->nullable();
            $table->json('responsive_images')->nullable();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->timestamps();
            $table->index('collection_name');
        });
    }

    public function down()
    {
        Schema::dropIfExists('media');
    }
};