<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'version',
        'author',
        'author_url',
        'path',
        'is_active',
        'settings',
        'requirements'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'settings' => 'array',
        'requirements' => 'array',
    ];

    public function activate()
    {
        $this->update(['is_active' => true]);
    }

    public function deactivate()
    {
        $this->update(['is_active' => false]);
    }

    public static function active()
    {
        return static::where('is_active', true)->get();
    }
}

