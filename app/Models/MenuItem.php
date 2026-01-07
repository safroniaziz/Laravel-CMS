<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MenuItem extends Model
{
    protected $fillable = [
        'menu_id',
        'parent_id',
        'title',
        'url',
        'type',
        'target',
        'icon',
        'css_class',
        'order'
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(MenuItem::class, 'parent_id')->orderBy('order');
    }

    public function getFullUrlAttribute(): string
    {
        $url = $this->url ?? '';

        if (empty($url)) {
            return url('/');
        }

        if (preg_match('/^(https?:\/\/|#|javascript:|mailto:|tel:)/i', $url)) {
            return $url;
        }

        return url(ltrim($url, '/'));
    }
}

