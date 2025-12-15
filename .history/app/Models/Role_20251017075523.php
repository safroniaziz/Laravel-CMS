<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method bool hasPermission(string|object $permission)
 */
class Role extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'level'
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'role_permissions');
    }

    public function hasPermission($permission): bool
    {
        // Load permissions if not loaded
        if (!$this->relationLoaded('permissions')) {
            $this->load('permissions');
        }

        if (is_string($permission)) {
            return $this->permissions->contains('slug', $permission);
        }

        return $this->permissions->contains('id', $permission->id);
    }
}

