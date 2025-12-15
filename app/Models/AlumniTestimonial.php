<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumniTestimonial extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'order', 'name', 'graduation_year', 'position', 
        'company', 'testimonial', 'rating', 'photo_url', 
        'linkedin_url', 'active'
    ];
    
    protected $casts = [
        'active' => 'boolean',
        'order' => 'integer',
        'rating' => 'integer',
    ];
    
    public function scopeActive($query)
    {
        return $query->where('active', true)->orderBy('order');
    }
}
