<?php

/**
 * IDE Helper for Laravel CMS
 * This file helps IDEs understand the project structure
 */

namespace Illuminate\Support\Facades {
    /**
     * @method static \App\Models\User|null user()
     * @method static int|null id()
     * @method static bool check()
     * @method static bool guest()
     * @method static \App\Models\User|null authenticate()
     * @method static bool attempt(array $credentials = [], bool $remember = false)
     * @method static void logout()
     * @method static void login(\App\Models\User $user, bool $remember = false)
     * @method static bool validate(array $credentials = [])
     * @method static \App\Models\User loginUsingId(mixed $id, bool $remember = false)
     * @see \Illuminate\Auth\AuthManager
     */
    class Auth {}
}

namespace App\Models {
    /**
     * @property int $id
     * @property string $name
     * @property string $email
     * @property string $password
     * @property int|null $role_id
     * @property string|null $avatar
     * @property string|null $bio
     * @property string|null $phone
     * @property bool $is_active
     * @property \Illuminate\Support\Carbon|null $email_verified_at
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     *
     * @property-read \App\Models\Role|null $role
     * @property-read \Illuminate\Database\Eloquent\Collection<\App\Models\Post> $posts
     * @property-read \Illuminate\Database\Eloquent\Collection<\App\Models\Page> $pages
     *
     * @method static \Illuminate\Database\Eloquent\Builder active()
     *
     * @mixin \Illuminate\Database\Eloquent\Builder
     */
    class User extends \Illuminate\Foundation\Auth\User
    {
        // Methods from HasRoleAndPermission trait
        public function hasPermission($permission): bool {}
        public function hasRole($role): bool {}
        public function hasAnyRole(array $roles): bool {}
        public function hasAllRoles(array $roles): bool {}
        public function isSuperadmin(): bool {}
        public function isAdmin(): bool {}
        public function isEditor(): bool {}
        public function isAuthor(): bool {}
        public function isViewer(): bool {}
        public function can($action): bool {}
        public function cannot($action): bool {}
    }

    /**
     * @property int $id
     * @property string $name
     * @property string $slug
     * @property string|null $description
     * @property int $level
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     *
     * @property-read \Illuminate\Database\Eloquent\Collection<\App\Models\User> $users
     * @property-read \Illuminate\Database\Eloquent\Collection<\App\Models\Permission> $permissions
     *
     * @mixin \Illuminate\Database\Eloquent\Builder
     */
    class Role extends \Illuminate\Database\Eloquent\Model
    {
        public function hasPermission($permission): bool {}
    }

    /**
     * @property int $id
     * @property string $name
     * @property string $slug
     * @property string|null $description
     * @property string $group
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     *
     * @property-read \Illuminate\Database\Eloquent\Collection<\App\Models\Role> $roles
     *
     * @mixin \Illuminate\Database\Eloquent\Builder
     */
    class Permission extends \Illuminate\Database\Eloquent\Model {}
}

namespace {
    /**
     * @return \App\Helpers\SeoHelper
     */
    function seo() {}

    /**
     * @param string $location
     * @param string $cssClass
     * @return string
     */
    function menu($location, $cssClass = 'menu') {}

    /**
     * @return \App\Helpers\BreadcrumbHelper
     */
    function breadcrumb() {}

    /**
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function setting($key, $default = null) {}

    /**
     * @param string|null $key
     * @param mixed $default
     * @return mixed
     */
    function language($key = null, $default = null) {}

    /**
     * @param string $route
     * @param string $class
     * @return string
     */
    function active_route($route, $class = 'active') {}

    /**
     * @param mixed $date
     * @param string $format
     * @return string
     */
    function format_date($date, $format = 'd M Y') {}

    /**
     * @param string $text
     * @param int $length
     * @param string $suffix
     * @return string
     */
    function truncate($text, $length = 150, $suffix = '...') {}

    /**
     * @param string $path
     * @return string
     */
    function asset_url($path) {}

    /**
     * @param \App\Models\User|null $user
     * @param int $size
     * @return string
     */
    function user_avatar($user, $size = 50) {}
}

