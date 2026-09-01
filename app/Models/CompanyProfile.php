<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_prefix',
        'company_name',
        'year_of_establishment',
        'main_product',
        'company_description',
        'address',
        'country_id',
        'region_id',
        'city',
        'province',
        'zip_code',
        'fax',
        'scale_of_business',
        'scale_of_business_detail',
        'incoterm',
        'terms_of_payment',
        'employee_count',
        'website',
        'business_email',
        'business_phone',
        'type_of_business',
        'type_of_business_detail',
        'google_maps_link',
        'longitude',
        'latitude',
        'logo_path',
        'npwp_number',
        'npwp_document_path',
        'nib_number',
        'nib_document_path',
        'profile_completed_at',
    ];

    protected function casts(): array
    {
        return [
            'profile_completed_at' => 'datetime',
            'year_of_establishment' => 'integer',
            'employee_count' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function contacts(): HasMany
    {
        return $this->hasMany(CompanyContact::class)->orderBy('sort_order');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class)->latest('published_at');
    }
}
