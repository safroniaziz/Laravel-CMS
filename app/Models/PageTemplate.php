<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PageTemplate extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'thumbnail',
        'default_blocks',
        'default_colors',
        'default_css',
        'is_active',
    ];

    protected $casts = [
        'default_blocks' => 'array',
        'default_colors' => 'array',
        'is_active' => 'boolean',
    ];

    public function pages(): HasMany
    {
        return $this->hasMany(Page::class, 'template_id');
    }
}
