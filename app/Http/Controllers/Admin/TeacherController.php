<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $query = Teacher::query();

        // Search
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('title', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by role
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // Filter by active status
        if ($request->filled('is_active')) {
            $query->where('is_active', $request->is_active);
        }

        $teachers = $query->ordered()->paginate(15);

        return view('admin.teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('admin.teachers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'role' => 'required|in:kaprodi,dosen',
            'title' => 'nullable|max:255',
            'expertise' => 'nullable|array',
            'publications' => 'nullable|integer|min:0',
            'projects' => 'nullable|integer|min:0',
            'gradient' => 'nullable|string',
            'icon' => 'nullable|string',
            'badge_color' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('teachers', 'public');
            $validated['photo'] = $path;
        }

        // Set default order if not provided
        if (!isset($validated['order'])) {
            $validated['order'] = Teacher::max('order') + 1;
        }

        $teacher = Teacher::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Teacher created successfully',
            'redirect' => route('admin.teachers.index')
        ]);
    }

    public function edit(Teacher $teacher)
    {
        return view('admin.teachers.edit', compact('teacher'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'role' => 'required|in:kaprodi,dosen',
            'title' => 'nullable|max:255',
            'expertise' => 'nullable|array',
            'publications' => 'nullable|integer|min:0',
            'projects' => 'nullable|integer|min:0',
            'gradient' => 'nullable|string',
            'icon' => 'nullable|string',
            'badge_color' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($teacher->photo) {
                Storage::disk('public')->delete($teacher->photo);
            }
            $path = $request->file('photo')->store('teachers', 'public');
            $validated['photo'] = $path;
        }

        $teacher->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Teacher updated successfully',
            'redirect' => route('admin.teachers.index')
        ]);
    }

    public function destroy(Teacher $teacher)
    {
        // Delete photo
        if ($teacher->photo) {
            Storage::disk('public')->delete($teacher->photo);
        }

        $teacher->delete();

        return response()->json([
            'success' => true,
            'message' => 'Teacher deleted successfully'
        ]);
    }

    public function toggle(Teacher $teacher)
    {
        $teacher->update(['is_active' => !$teacher->is_active]);

        return response()->json([
            'success' => true,
            'message' => 'Teacher status updated',
            'is_active' => $teacher->is_active
        ]);
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'required|integer|exists:teachers,id'
        ]);

        foreach ($request->order as $index => $id) {
            Teacher::where('id', $id)->update(['order' => $index + 1]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Teachers reordered successfully'
        ]);
    }
}
