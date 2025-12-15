<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CareerFrontendController extends Controller
{
    public function index(Request $request)
    {
        $query = Career::active();

        if ($request->filled('department')) {
            $query->where('department', $request->department);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('location')) {
            $query->where('location', $request->location);
        }

        $careers = $query->latest()->paginate(12);
        
        $departments = Career::active()
            ->select('department')
            ->distinct()
            ->pluck('department');
        
        $locations = Career::active()
            ->select('location')
            ->distinct()
            ->pluck('location');

        return view('frontend.careers.index', compact('careers', 'departments', 'locations'));
    }

    public function show($slug)
    {
        $career = Career::active()->where('slug', $slug)->firstOrFail();
        $relatedCareers = Career::active()
            ->where('id', '!=', $career->id)
            ->where('department', $career->department)
            ->take(3)
            ->get();

        return view('frontend.careers.show', compact('career', 'relatedCareers'));
    }

    public function apply(Request $request, Career $career)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|max:20',
            'address' => 'nullable',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:5120',
            'cover_letter' => 'required',
            'portfolio_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
        ]);

        // Upload resume
        if ($request->hasFile('resume')) {
            $file = $request->file('resume');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('resumes', $filename, 'public');
            $validated['resume'] = $path;
        }

        $validated['career_id'] = $career->id;
        $validated['status'] = 'pending';
        $validated['additional_info'] = $request->only(['portfolio_url', 'linkedin_url']);

        JobApplication::create($validated);

        return redirect()->back()->with('success', 'Your application has been submitted successfully!');
    }
}

