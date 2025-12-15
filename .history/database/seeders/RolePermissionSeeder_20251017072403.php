<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Create Permissions
        $permissions = [
            // Posts
            ['name' => 'View Posts', 'slug' => 'posts.view', 'group' => 'posts'],
            ['name' => 'Create Posts', 'slug' => 'posts.create', 'group' => 'posts'],
            ['name' => 'Edit Posts', 'slug' => 'posts.edit', 'group' => 'posts'],
            ['name' => 'Delete Posts', 'slug' => 'posts.delete', 'group' => 'posts'],
            ['name' => 'Publish Posts', 'slug' => 'posts.publish', 'group' => 'posts'],
            
            // Pages
            ['name' => 'View Pages', 'slug' => 'pages.view', 'group' => 'pages'],
            ['name' => 'Create Pages', 'slug' => 'pages.create', 'group' => 'pages'],
            ['name' => 'Edit Pages', 'slug' => 'pages.edit', 'group' => 'pages'],
            ['name' => 'Delete Pages', 'slug' => 'pages.delete', 'group' => 'pages'],
            
            // Media
            ['name' => 'View Media', 'slug' => 'media.view', 'group' => 'media'],
            ['name' => 'Upload Media', 'slug' => 'media.upload', 'group' => 'media'],
            ['name' => 'Delete Media', 'slug' => 'media.delete', 'group' => 'media'],
            
            // Categories
            ['name' => 'Manage Categories', 'slug' => 'categories.manage', 'group' => 'categories'],
            
            // Tags
            ['name' => 'Manage Tags', 'slug' => 'tags.manage', 'group' => 'tags'],
            
            // Users
            ['name' => 'View Users', 'slug' => 'users.view', 'group' => 'users'],
            ['name' => 'Create Users', 'slug' => 'users.create', 'group' => 'users'],
            ['name' => 'Edit Users', 'slug' => 'users.edit', 'group' => 'users'],
            ['name' => 'Delete Users', 'slug' => 'users.delete', 'group' => 'users'],
            
            // Roles & Permissions
            ['name' => 'Manage Roles', 'slug' => 'roles.manage', 'group' => 'roles'],
            ['name' => 'Manage Permissions', 'slug' => 'permissions.manage', 'group' => 'permissions'],
            
            // Menus
            ['name' => 'Manage Menus', 'slug' => 'menus.manage', 'group' => 'menus'],
            
            // Settings
            ['name' => 'Manage Settings', 'slug' => 'settings.manage', 'group' => 'settings'],
            
            // Themes
            ['name' => 'Manage Themes', 'slug' => 'themes.manage', 'group' => 'themes'],
            
            // Modules
            ['name' => 'Manage Modules', 'slug' => 'modules.manage', 'group' => 'modules'],
            
            // Languages
            ['name' => 'Manage Languages', 'slug' => 'languages.manage', 'group' => 'languages'],
            
            // Company Profile Features
            ['name' => 'Manage Services', 'slug' => 'services.manage', 'group' => 'services'],
            ['name' => 'Manage Portfolio', 'slug' => 'portfolio.manage', 'group' => 'portfolio'],
            ['name' => 'Manage Testimonials', 'slug' => 'testimonials.manage', 'group' => 'testimonials'],
            ['name' => 'Manage Partners', 'slug' => 'partners.manage', 'group' => 'partners'],
            ['name' => 'Manage Careers', 'slug' => 'careers.manage', 'group' => 'careers'],
            ['name' => 'View Applications', 'slug' => 'applications.view', 'group' => 'applications'],
            ['name' => 'Manage FAQ', 'slug' => 'faq.manage', 'group' => 'faq'],
            ['name' => 'View Contacts', 'slug' => 'contacts.view', 'group' => 'contacts'],
            ['name' => 'Manage Sliders', 'slug' => 'sliders.manage', 'group' => 'sliders'],
            ['name' => 'Manage Gallery', 'slug' => 'gallery.manage', 'group' => 'gallery'],
            
            // Backup
            ['name' => 'Manage Backup', 'slug' => 'backup.manage', 'group' => 'backup'],
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['slug' => $permission['slug']], $permission);
        }

        // Create Roles
        $superadmin = Role::firstOrCreate(
            ['slug' => 'superadmin'],
            ['name' => 'Superadmin', 'level' => 1, 'description' => 'Full access to all features']
        );

        $admin = Role::firstOrCreate(
            ['slug' => 'admin'],
            ['name' => 'Admin', 'level' => 2, 'description' => 'Manage content and users']
        );

        $editor = Role::firstOrCreate(
            ['slug' => 'editor'],
            ['name' => 'Editor', 'level' => 3, 'description' => 'Edit and publish content']
        );

        $author = Role::firstOrCreate(
            ['slug' => 'author'],
            ['name' => 'Author', 'level' => 4, 'description' => 'Create and edit own content']
        );

        $viewer = Role::firstOrCreate(
            ['slug' => 'viewer'],
            ['name' => 'Viewer', 'level' => 5, 'description' => 'View content only']
        );

        // Assign all permissions to Superadmin
        $superadmin->permissions()->sync(Permission::all());

        // Admin permissions (everything except roles, permissions, backup)
        $adminPermissions = Permission::whereNotIn('group', ['roles', 'permissions', 'backup'])->get();
        $admin->permissions()->sync($adminPermissions);

        // Editor permissions (content management)
        $editorPermissions = Permission::whereIn('group', [
            'posts', 'pages', 'media', 'categories', 'tags', 'menus',
            'services', 'portfolio', 'testimonials', 'partners', 'careers',
            'faq', 'sliders', 'gallery'
        ])->get();
        $editor->permissions()->sync($editorPermissions);

        // Author permissions (create/edit own posts)
        $authorPermissions = Permission::whereIn('slug', [
            'posts.view', 'posts.create', 'posts.edit',
            'media.view', 'media.upload',
            'pages.view', 'pages.create', 'pages.edit'
        ])->get();
        $author->permissions()->sync($authorPermissions);

        // Viewer permissions (view only)
        $viewerPermissions = Permission::whereIn('slug', [
            'posts.view', 'pages.view', 'media.view'
        ])->get();
        $viewer->permissions()->sync($viewerPermissions);
    }
}

