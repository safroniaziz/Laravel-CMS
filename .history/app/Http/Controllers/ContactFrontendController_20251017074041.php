<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Faq;
use Illuminate\Http\Request;

class ContactFrontendController extends Controller
{
    public function index()
    {
        $faqs = Faq::active()->orderBy('order')->get()->groupBy('category');
        return view('frontend.contact.index', compact('faqs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|max:20',
            'subject' => 'required|max:255',
            'message' => 'required',
        ]);

        $validated['ip_address'] = $request->ip();
        $validated['user_agent'] = $request->userAgent();
        $validated['status'] = 'pending';

        Contact::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Thank you for contacting us! We will get back to you soon.'
        ]);
    }

    public function faq()
    {
        $faqs = Faq::active()->orderBy('order')->get()->groupBy('category');
        return view('frontend.faq.index', compact('faqs'));
    }
}

