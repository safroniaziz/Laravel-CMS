@extends('layouts.frontend')

@section('title', $page->meta_title ?? $page->title)

@if($page->meta_description)
@section('meta_description', $page->meta_description)
@endif

@section('content')
@php
    $layout = $page->layout ?? 'modern';

    // Map old layouts to new ones if needed
    $layoutMap = [
        'default' => 'modern',
        'hero' => 'modern',
        'split' => 'bold',
        'cards' => 'classic',
        'centered' => 'elegant',
    ];

    $layout = $layoutMap[$layout] ?? $layout;
    $layoutPath = "frontend.pages.layouts.{$layout}";
@endphp

@if(view()->exists($layoutPath))
    @include($layoutPath)
@else
    @include('frontend.pages.layouts.modern')
@endif

@if($page->custom_css)
    <style>{{ $page->custom_css }}</style>
@endif

<!-- Back to Home -->
<div style="text-align: center; padding: 40px 0 80px; background: #f9fafb;">
    <a href="/" style="display: inline-flex; align-items: center; gap: 10px; padding: 14px 35px; background: linear-gradient(135deg, {{ $page->accent_color ?? '#1e3a8a' }}, {{ $page->accent_color ?? '#1e3a8a' }}cc); color: #fff; text-decoration: none; border-radius: 50px; font-weight: 600; font-size: 15px; transition: all 0.3s ease; box-shadow: 0 4px 15px {{ $page->accent_color ?? '#1e3a8a' }}40;">
        <svg width="18" height="18" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/></svg>
        Kembali ke Beranda
    </a>
</div>
@endsection
