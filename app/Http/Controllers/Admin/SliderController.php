<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('order')->get();
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'image_position' => 'required|in:left,right',
            'badge_text' => 'nullable|string|max:100',
            'badge_subtext' => 'nullable|string|max:100',
            'badge_show' => 'boolean',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('sliders', 'public');
        }

        $validated['is_active'] = $request->input('is_active') == '1';
        $validated['badge_show'] = $request->input('badge_show') == '1';
        $validated['order'] = (Slider::max('order') ?? 0) + 1;

        $slider = Slider::create($validated);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Slider berhasil ditambahkan!', 'slider' => $slider]);
        }

        return redirect()->route('admin.sliders.index')->with('success', 'Slider berhasil ditambahkan!');
    }

    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'image_position' => 'required|in:left,right',
            'badge_text' => 'nullable|string|max:100',
            'badge_subtext' => 'nullable|string|max:100',
            'badge_show' => 'boolean',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if it's local
            if ($slider->image && !str_starts_with($slider->image, 'http') && Storage::disk('public')->exists($slider->image)) {
                Storage::disk('public')->delete($slider->image);
            }
            $validated['image'] = $request->file('image')->store('sliders', 'public');
        }

        $validated['is_active'] = $request->has('is_active') && $request->input('is_active') == '1';
        $validated['badge_show'] = $request->input('badge_show') == '1';

        $slider->update($validated);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Slider berhasil diperbarui!', 'slider' => $slider]);
        }

        return redirect()->route('admin.sliders.index')->with('success', 'Slider berhasil diperbarui!');
    }

    public function destroy(Slider $slider)
    {
        if ($slider->image && Storage::disk('public')->exists($slider->image)) {
            Storage::disk('public')->delete($slider->image);
        }

        $slider->delete();

        return redirect()->route('admin.sliders.index')->with('success', 'Slider berhasil dihapus!');
    }

    public function toggle(Slider $slider)
    {
        $slider->update(['is_active' => !$slider->is_active]);

        return response()->json([
            'success' => true,
            'is_active' => $slider->is_active,
            'message' => $slider->is_active ? 'Slider diaktifkan!' : 'Slider dinonaktifkan!'
        ]);
    }

    public function reorder(Request $request)
    {
        $orders = $request->input('orders', []);
        
        foreach ($orders as $id => $order) {
            Slider::where('id', $id)->update(['order' => $order]);
        }

        return response()->json(['success' => true, 'message' => 'Urutan berhasil disimpan!']);
    }
}
