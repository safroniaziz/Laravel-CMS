<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceFrontendController extends Controller
{
    public function index()
    {
        $services = Service::active()->orderBy('order')->get();
        return view('frontend.services.index', compact('services'));
    }

    public function show($slug)
    {
        $service = Service::active()->where('slug', $slug)->firstOrFail();
        $otherServices = Service::active()
            ->where('id', '!=', $service->id)
            ->orderBy('order')
            ->take(3)
            ->get();

        return view('frontend.services.show', compact('service', 'otherServices'));
    }
}

