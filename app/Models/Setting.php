<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'label',
        'is_public',
    ];

    protected function casts(): array
    {
        return [
            'is_public' => 'boolean',
        ];
    }

    public static function pairs(bool $onlyPublic = false): array
    {
        $cacheKey = $onlyPublic ? 'settings.public' : 'settings.all';

        return Cache::remember($cacheKey, now()->addHour(), function () use ($onlyPublic) {
            $query = static::query();

            if ($onlyPublic) {
                $query->where('is_public', true);
            }

            return $query->pluck('value', 'key')->all();
        });
    }

    public static function value(string $key, mixed $default = null): mixed
    {
        return static::pairs()[$key] ?? $default;
    }

    public static function flushCache(): void
    {
        Cache::forget('settings.all');
        Cache::forget('settings.public');
    }
}
