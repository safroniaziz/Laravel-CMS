<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('translations', function (Blueprint $table) {
            $table->id();
            $table->morphs('translatable');
            $table->string('language_code');
            $table->string('field');
            $table->longText('value')->nullable();
            $table->timestamps();
            $table->unique(['translatable_id', 'translatable_type', 'language_code', 'field'], 'unique_translation');
            $table->index('language_code');
        });
    }

    public function down()
    {
        Schema::dropIfExists('translations');
    }
};