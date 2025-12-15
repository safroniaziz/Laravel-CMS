<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('content')->nullable();
            $table->string('featured_image')->nullable();
            $table->foreignId('author_id')->constrained('users');
            $table->foreignId('category_id')->nullable()->constrained();
            $table->enum('status', ['draft', 'published', 'scheduled', 'private'])->default('draft');
            $table->enum('type', ['post', 'page'])->default('post');
            $table->string('template')->nullable();
            $table->datetime('published_at')->nullable();
            $table->integer('views')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('allow_comments')->default(true);
            $table->json('meta')->nullable(); // SEO meta data
            $table->json('custom_fields')->nullable();
            $table->timestamps();
            $table->index(['slug', 'status', 'type']);
            $table->index('published_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
};