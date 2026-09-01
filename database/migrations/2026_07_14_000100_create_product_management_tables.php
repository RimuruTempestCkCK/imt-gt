<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('company_profile_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('product_category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('status')->default('draft');
            $table->string('trade_kind')->default('goods');
            $table->string('import_type')->nullable();
            $table->boolean('show_price')->default(true);
            $table->decimal('price', 18, 2)->nullable();
            $table->string('currency', 10)->default('IDR');
            $table->string('price_unit')->nullable();
            $table->longText('description')->nullable();
            $table->string('video_url')->nullable();
            $table->string('origin_country')->nullable();
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('sku')->nullable();
            $table->string('hs_code')->nullable();
            $table->string('min_order_qty')->nullable();
            $table->string('production_capacity')->nullable();
            $table->string('delivery_time')->nullable();
            $table->string('packaging')->nullable();
            $table->longText('specifications')->nullable();
            $table->longText('additional_information')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->string('support_contact')->nullable();
            $table->boolean('is_hazardous')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });

        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('path');
            $table->string('caption')->nullable();
            $table->unsignedInteger('sort_order')->default(1);
            $table->boolean('is_primary')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_images');
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_categories');
    }
};
