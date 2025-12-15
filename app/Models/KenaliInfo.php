<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KenaliInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'order',
        'icon',
        'title',
        'description',
        'color',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
        'order' => 'integer',
    ];

    /**
     * Scope to get only active info sections ordered by order field
     */
    public function scopeActive($query)
    {
        return $query->where('active', true)->orderBy('order');
    }
}
