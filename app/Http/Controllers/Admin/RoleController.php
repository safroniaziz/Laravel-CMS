<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::withCount('users', 'permissions')->get();
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all()->groupBy('group');
        return view('admin.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'nullable|unique:roles,slug',
            'description' => 'nullable',
            'level' => 'required|integer',
            'permissions' => 'nullable|array',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $role = Role::create($validated);

        if ($request->filled('permissions')) {
            $role->permissions()->sync($request->permissions);
        }

        return response()->json([
            'success' => true,
            'message' => 'Role created successfully',
            'redirect' => route('roles.index')
        ]);
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all()->groupBy('group');
        $role->load('permissions');
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'nullable|unique:roles,slug,' . $role->id,
            'description' => 'nullable',
            'level' => 'required|integer',
            'permissions' => 'nullable|array',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $role->update($validated);

        if ($request->has('permissions')) {
            $role->permissions()->sync($request->permissions);
        }

        return response()->json([
            'success' => true,
            'message' => 'Role updated successfully',
            'redirect' => route('roles.index')
        ]);
    }

    public function destroy(Role $role)
    {
        if ($role->users()->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete role with existing users'
            ], 422);
        }

        if (in_array($role->slug, ['superadmin', 'admin'])) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete system roles'
            ], 422);
        }

        $role->delete();

        return response()->json([
            'success' => true,
            'message' => 'Role deleted successfully'
        ]);
    }
}

