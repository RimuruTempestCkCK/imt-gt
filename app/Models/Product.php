<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_profile_id',
        'product_category_id',
        'title',
        'slug',
        'status',
        'trade_kind',
        'import_type',
        'show_price',
        'price',
        'currency',
        'price_unit',
        'description',
        'video_url',
        'origin_country',
        'brand',
        'model',
        'sku',
        'hs_code',
        'min_order_qty',
        'production_capacity',
        'delivery_time',
        'packaging',
        'specifications',
        'additional_information',
        'seo_keywords',
        'support_contact',
        'is_hazardous',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'show_price' => 'boolean',
            'is_hazardous' => 'boolean',
            'price' => 'decimal:2',
            'published_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function companyProfile(): BelongsTo
    {
        return $this->belongsTo(CompanyProfile::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }
}
