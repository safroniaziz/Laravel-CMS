<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Language extends Model
{
    protected $fillable = [
        'name',
        'code',
        'locale',
        'flag',
        'is_default',
        'is_active',
        'direction'
    ];

    protected $casts = [
        'is_default' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function translations(): HasMany
    {
        return $this->hasMany(Translation::class);
    }

    public static function default()
    {
        return static::where('is_default', true)->first() ?? static::where('code', 'en')->first();
    }

    public static function active()
    {
        return static::where('is_active', true)->get();
    }
}

