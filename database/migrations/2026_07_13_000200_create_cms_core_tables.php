<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('media_items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type')->default('image');
            $table->string('source_url');
            $table->string('alt_text')->nullable();
            $table->text('caption')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });

        Schema::create('news_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('media_item_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('body');
            $table->string('status')->default('draft');
            $table->boolean('featured')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });

        Schema::create('news_post_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('news_post_id')->constrained()->cascadeOnDelete();
            $table->foreignId('tag_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['news_post_id', 'tag_id']);
        });

        Schema::create('static_pages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('body');
            $table->string('status')->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });

        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('media_item_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->text('subtitle')->nullable();
            $table->string('cta_label')->nullable();
            $table->string('cta_url')->nullable();
            $table->unsignedInteger('sort_order')->default(1);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('url');
            $table->string('location')->default('header');
            $table->unsignedInteger('sort_order')->default(1);
            $table->string('target')->default('_self');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('greetings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position');
            $table->string('headline');
            $table->longText('message');
            $table->unsignedInteger('sort_order')->default(1);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('profile_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('media_item_id')->nullable()->constrained()->nullOnDelete();
            $table->string('section_key')->index();
            $table->string('title');
            $table->text('summary')->nullable();
            $table->longText('body');
            $table->unsignedInteger('sort_order')->default(1);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profile_sections');
        Schema::dropIfExists('greetings');
        Schema::dropIfExists('menu_items');
        Schema::dropIfExists('banners');
        Schema::dropIfExists('static_pages');
        Schema::dropIfExists('news_post_tag');
        Schema::dropIfExists('news_posts');
        Schema::dropIfExists('media_items');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('categories');
    }
};
