<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::with(['items' => function($query) {
            $query->whereNull('parent_id')->orderBy('order');
        }, 'items.children' => function($query) {
            $query->orderBy('order');
        }])
        ->withCount('allItems')
        ->latest()
        ->get();
        
        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        return view('admin.menus.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'nullable|unique:menus,slug',
            'location' => 'required|max:255',
            'description' => 'nullable',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $menu = Menu::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Menu created successfully',
            'redirect' => route('admin.menus.edit', $menu)
        ]);
    }

    public function edit(Menu $menu)
    {
        $menu->load(['items' => function($query) {
            $query->whereNull('parent_id')->orderBy('order');
        }, 'items.children' => function($query) {
            $query->orderBy('order');
        }, 'allItems' => function($query) {
            $query->orderBy('order');
        }]);
        
        return view('admin.menus.edit', compact('menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'nullable|unique:menus,slug,' . $menu->id,
            'location' => 'required|max:255',
            'description' => 'nullable',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $menu->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Menu updated successfully'
        ]);
    }

    public function destroy(Menu $menu)
    {
        $menu->allItems()->delete();
        $menu->delete();

        return response()->json([
            'success' => true,
            'message' => 'Menu deleted successfully'
        ]);
    }

    public function storeItem(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'url' => 'required|max:255',
            'target' => 'nullable|in:_self,_blank',
            'parent_id' => 'nullable|exists:menu_items,id',
            'icon_class' => 'nullable|max:255',
            'order' => 'nullable|integer',
        ]);

        $validated['menu_id'] = $menu->id;
        $validated['target'] = $validated['target'] ?? '_self';
        $validated['order'] = $validated['order'] ?? 0;

        $menuItem = MenuItem::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Menu item added successfully',
            'item' => $menuItem
        ]);
    }

    public function updateItem(Request $request, MenuItem $menuItem)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'url' => 'required|max:255',
            'target' => 'nullable|in:_self,_blank',
            'parent_id' => 'nullable|exists:menu_items,id',
            'icon_class' => 'nullable|max:255',
            'order' => 'nullable|integer',
        ]);

        $menuItem->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Menu item updated successfully',
            'item' => $menuItem
        ]);
    }

    public function destroyItem(MenuItem $menuItem)
    {
        $menuItem->delete();

        return response()->json([
            'success' => true,
            'message' => 'Menu item deleted successfully'
        ]);
    }

    public function updateOrder(Request $request, Menu $menu)
    {
        $items = $request->input('items', []);

        foreach ($items as $index => $item) {
            MenuItem::where('id', $item['id'])->update([
                'order' => $index,
                'parent_id' => $item['parent_id'] ?? null
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Menu order updated successfully'
        ]);
    }
}

