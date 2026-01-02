<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'image',
        'image_position',
        'badge_text',
        'badge_subtext',
        'badge_show',
        'video_url',
        'button_text',
        'button_link',
        'button_url',
        'button_target',
        'order',
        'is_active'
    ];

    protected $casts = [
        'order' => 'integer',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}

