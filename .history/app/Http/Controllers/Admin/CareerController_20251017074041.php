<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Career;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    public function index()
    {
        $careers = Career::withCount('applications')->latest()->paginate(15);
        return view('admin.careers.index', compact('careers'));
    }

    public function create()
    {
        return view('admin.careers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'nullable|unique:careers,slug',
            'department' => 'required|max:255',
            'location' => 'required|max:255',
            'type' => 'required|in:full-time,part-time,contract,internship',
            'description' => 'required',
            'requirements' => 'nullable|array',
            'responsibilities' => 'nullable|array',
            'benefits' => 'nullable|array',
            'salary_range' => 'nullable|max:255',
            'deadline' => 'nullable|date',
            'is_active' => 'required|boolean',
            'meta_title' => 'nullable|max:255',
            'meta_description' => 'nullable',
        ]);

        $career = Career::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Career created successfully',
            'redirect' => route('admin.careers.index')
        ]);
    }

    public function edit(Career $career)
    {
        return view('admin.careers.edit', compact('career'));
    }

    public function update(Request $request, Career $career)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'nullable|unique:careers,slug,' . $career->id,
            'department' => 'required|max:255',
            'location' => 'required|max:255',
            'type' => 'required|in:full-time,part-time,contract,internship',
            'description' => 'required',
            'requirements' => 'nullable|array',
            'responsibilities' => 'nullable|array',
            'benefits' => 'nullable|array',
            'salary_range' => 'nullable|max:255',
            'deadline' => 'nullable|date',
            'is_active' => 'required|boolean',
            'meta_title' => 'nullable|max:255',
            'meta_description' => 'nullable',
        ]);

        $career->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Career updated successfully',
            'redirect' => route('admin.careers.index')
        ]);
    }

    public function destroy(Career $career)
    {
        $career->delete();

        return response()->json([
            'success' => true,
            'message' => 'Career deleted successfully'
        ]);
    }

    public function applications(Career $career)
    {
        $applications = $career->applications()->latest()->paginate(15);
        return view('admin.careers.applications', compact('career', 'applications'));
    }

    public function updateApplicationStatus(Request $request, JobApplication $application)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,reviewed,shortlisted,rejected',
            'notes' => 'nullable',
        ]);

        $application->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Application status updated successfully'
        ]);
    }
}

