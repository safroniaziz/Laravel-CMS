<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()->paginate(15);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'position' => 'required|max:255',
            'company' => 'nullable|max:255',
            'content' => 'required',
            'rating' => 'nullable|integer|min:1|max:5',
            'avatar' => 'nullable',
            'order' => 'nullable|integer',
            'is_featured' => 'required|boolean',
            'is_active' => 'required|boolean',
        ]);

        $testimonial = Testimonial::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Testimonial created successfully',
            'testimonial' => $testimonial
        ]);
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'position' => 'required|max:255',
            'company' => 'nullable|max:255',
            'content' => 'required',
            'rating' => 'nullable|integer|min:1|max:5',
            'avatar' => 'nullable',
            'order' => 'nullable|integer',
            'is_featured' => 'required|boolean',
            'is_active' => 'required|boolean',
        ]);

        $testimonial->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Testimonial updated successfully',
            'testimonial' => $testimonial
        ]);
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        return response()->json([
            'success' => true,
            'message' => 'Testimonial deleted successfully'
        ]);
    }
}

