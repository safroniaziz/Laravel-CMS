<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'role',
        'title',
        'expertise',
        'publications',
        'projects',
        'gradient',
        'icon',
        'badge_color',
        'photo',
        'email',
        'phone',
        'linkedin',
        'google_scholar',
        'bio',
        'order',
        'is_active',
    ];

    protected $casts = [
        'expertise' => 'array',
        'is_active' => 'boolean',
        'publications' => 'integer',
        'projects' => 'integer',
        'order' => 'integer',
    ];

    /**
     * Scope a query to only include active teachers.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to order by order field.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('name');
    }
}
