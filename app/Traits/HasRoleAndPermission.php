<?php

namespace App\Traits;

use App\Models\Role;

trait HasRoleAndPermission
{
    /**
     * Check if user has specific permission
     *
     * @param string|object $permission
     * @return bool
     */
    public function hasPermission($permission): bool
    {
        // Load role if not loaded
        if (!$this->relationLoaded('role')) {
            $this->load('role.permissions');
        }

        if (!$this->role) {
            return false;
        }

        return $this->role->hasPermission($permission);
    }

    /**
     * Check if user has specific role
     *
     * @param string|Role $role
     * @return bool
     */
    public function hasRole($role): bool
    {
        // Load role if not loaded
        if (!$this->relationLoaded('role')) {
            $this->load('role');
        }

        if (!$this->role) {
            return false;
        }

        if (is_string($role)) {
            return $this->role->slug === $role;
        }

        return $this->role_id === $role->id;
    }

    /**
     * Check if user has any of the given roles
     *
     * @param array $roles
     * @return bool
     */
    public function hasAnyRole(array $roles): bool
    {
        foreach ($roles as $role) {
            if ($this->hasRole($role)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if user has all of the given roles
     *
     * @param array $roles
     * @return bool
     */
    public function hasAllRoles(array $roles): bool
    {
        foreach ($roles as $role) {
            if (!$this->hasRole($role)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Check if user is superadmin
     *
     * @return bool
     */
    public function isSuperadmin(): bool
    {
        return $this->hasRole('superadmin');
    }

    /**
     * Check if user is admin (admin or superadmin)
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->hasRole('admin') || $this->isSuperadmin();
    }

    /**
     * Check if user is editor
     *
     * @return bool
     */
    public function isEditor(): bool
    {
        return $this->hasRole('editor');
    }

    /**
     * Check if user is author
     *
     * @return bool
     */
    public function isAuthor(): bool
    {
        return $this->hasRole('author');
    }

    /**
     * Check if user is viewer
     *
     * @return bool
     */
    public function isViewer(): bool
    {
        return $this->hasRole('viewer');
    }
}

