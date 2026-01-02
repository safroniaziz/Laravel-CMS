<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        $query = Permission::query();
        
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('slug', 'like', '%' . $request->search . '%');
        }
        
        if ($request->filled('group')) {
            $query->where('group', $request->group);
        }
        
        $permissions = $query->orderBy('group')->orderBy('name')->paginate(30);
        $groups = Permission::distinct()->pluck('group')->sort();
        
        return view('admin.permissions.index', compact('permissions', 'groups'));
    }

    public function create()
    {
        $groups = Permission::distinct()->pluck('group')->sort();
        return view('admin.permissions.create', compact('groups'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'nullable|unique:permissions,slug',
            'description' => 'nullable',
            'group' => 'required',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name'], '.');
        }

        Permission::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Permission berhasil dibuat',
            'redirect' => route('permissions.index')
        ]);
    }

    public function edit(Permission $permission)
    {
        $groups = Permission::distinct()->pluck('group')->sort();
        return view('admin.permissions.edit', compact('permission', 'groups'));
    }

    public function update(Request $request, Permission $permission)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'nullable|unique:permissions,slug,' . $permission->id,
            'description' => 'nullable',
            'group' => 'required',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name'], '.');
        }

        $permission->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Permission berhasil diupdate',
            'redirect' => route('permissions.index')
        ]);
    }

    public function destroy(Permission $permission)
    {
        // Check if permission is used by any role
        if ($permission->roles()->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Permission masih digunakan oleh role. Hapus dari role terlebih dahulu.'
            ], 422);
        }

        $permission->delete();

        return response()->json([
            'success' => true,
            'message' => 'Permission berhasil dihapus'
        ]);
    }
}
