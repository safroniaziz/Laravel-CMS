<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'version',
        'author',
        'author_url',
        'screenshot',
        'path',
        'is_active',
        'settings'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'settings' => 'array',
    ];

    public function activate()
    {
        static::query()->update(['is_active' => false]);
        $this->update(['is_active' => true]);

        Setting::set('active_theme', $this->slug);
    }

    public static function active()
    {
        return static::where('is_active', true)->first();
    }
}

