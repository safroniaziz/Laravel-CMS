<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cache;

class Translation extends Model
{
    protected $fillable = [
        'language_id',
        'key',
        'value',
        'group'
    ];

    protected static function boot()
    {
        parent::boot();

        static::saved(function ($translation) {
            Cache::forget("translations.{$translation->language->code}");
        });

        static::deleted(function ($translation) {
            Cache::forget("translations.{$translation->language->code}");
        });
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    public static function get($key, $default = null, $languageCode = null)
    {
        if (!$languageCode) {
            $languageCode = app()->getLocale();
        }

        $translations = Cache::rememberForever("translations.{$languageCode}", function () use ($languageCode) {
            $language = Language::where('code', $languageCode)->first();
            if (!$language) {
                return collect();
            }
            return $language->translations->pluck('value', 'key');
        });

        return $translations->get($key, $default);
    }
}

