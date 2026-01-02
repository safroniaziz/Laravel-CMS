@extends('layouts.dashboard.dashboard')

@section('title', 'Edit Page')
@section('menu', 'Pages')

@php
    $sections = $page->page_builder_data ?? [];
@endphp

@section('link')
    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-muted"><a href="{{ route('pages.index') }}" class="text-muted text-hover-primary">Pages</a></li>
    <li class="breadcrumb-item text-gray-700">Edit: {{ Str::limit($page->title, 30) }}</li>
@endsection

@push('styles')
<style>
.btn-check:checked + .btn-outline-secondary {
    background-color: #e0f2fe !important;
    border-color: #1e3a8a !important;
    border-width: 2px !important;
}
.btn-check:checked + .btn-outline-secondary strong {
    color: #1e3a8a !important;
}
.section-card {
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    transition: all 0.3s ease;
}
.section-card.active {
    border-color: #1e3a8a;
    box-shadow: 0 4px 15px rgba(30, 58, 138, 0.15);
}
.section-card .card-header {
    background: linear-gradient(135deg, #f8fafc, #f1f5f9);
    border-radius: 10px 10px 0 0;
    cursor: pointer;
}
.section-card.active .card-header {
    background: linear-gradient(135deg, #1e3a8a, #2563eb);
    color: white;
}
.section-card.active .card-header .form-check-input {
    background-color: white;
}
.section-toggle {
    width: 20px;
    height: 20px;
}
.section-help {
    background: #fef3c7;
    border-left: 4px solid #f59e0b;
    padding: 12px 15px;
    border-radius: 0 8px 8px 0;
    font-size: 13px;
    margin-bottom: 15px;
}
.section-help i {
    color: #f59e0b;
}
.repeater-item {
    background: #f8fafc;
    border-radius: 10px;
    padding: 15px;
    margin-bottom: 15px;
    border: 1px solid #e5e7eb;
    position: relative;
}
.repeater-item .remove-btn {
    position: absolute;
    top: 10px;
    right: 10px;
}
</style>
@endpush

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        
        <form id="pageForm" method="POST" action="{{ route('pages.update', $page) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row g-5">
                <!-- Main Content -->
                <div class="col-lg-8">
                    
                    <!-- Basic Info -->
                    <div class="card mb-5">
                        <div class="card-header">
                            <h3 class="card-title">📝 Informasi Dasar Halaman</h3>
                            <div class="card-toolbar">
                                <a href="/{{ $page->slug }}" target="_blank" class="btn btn-sm btn-light-primary">
                                    <i class="fas fa-eye me-1"></i> Lihat Halaman
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="section-help">
                                <i class="fas fa-info-circle me-2"></i>
                                <strong>Info:</strong> Isi judul dan slug halaman. Judul akan tampil di browser dan sebagai heading utama.
                            </div>
                            
                            <div class="mb-5">
                                <label class="form-label required">Judul Halaman</label>
                                <input type="text" name="title" id="title" class="form-control form-control-lg" value="{{ $page->title }}" required />
                                <small class="text-muted">Akan tampil di tab browser dan sebagai judul utama</small>
                            </div>
                            
                            <div class="mb-0">
                                <label class="form-label">Slug URL</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">{{ url('/') }}/</span>
                                    <input type="text" name="slug" id="slug" class="form-control" value="{{ $page->slug }}" />
                                </div>
                                <small class="text-muted">Kosongkan untuk auto-generate dari judul</small>
                            </div>
                        </div>
                    </div>

                    <!-- ========== SECTION 1: HERO ========== -->
                    <div class="section-card card mb-5 {{ !empty($sections['hero']['enabled']) ? 'active' : '' }}" id="section-hero">
                        <div class="card-header d-flex align-items-center justify-content-between py-4" onclick="toggleSection('hero')">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="form-check-input section-toggle me-3" name="sections[hero][enabled]" id="hero_enabled" value="1" {{ !empty($sections['hero']['enabled']) ? 'checked' : '' }}>
                                <div>
                                    <h3 class="card-title mb-0">🖼️ Hero Section</h3>
                                    <small class="text-muted">Banner besar di bagian atas halaman</small>
                                </div>
                            </div>
                            <span class="badge badge-light-primary">Opsional</span>
                        </div>
                        <div class="card-body section-body" style="display: {{ !empty($sections['hero']['enabled']) ? 'block' : 'none' }};">
                            <div class="section-help">
                                <i class="fas fa-lightbulb me-2"></i>
                                <strong>Fungsi:</strong> Hero adalah banner besar di atas halaman. Cocok untuk judul besar, tagline, dan tombol CTA.
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Judul Hero</label>
                                    <input type="text" name="sections[hero][title]" class="form-control" value="{{ $sections['hero']['title'] ?? '' }}" />
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Subtitle Hero</label>
                                    <input type="text" name="sections[hero][subtitle]" class="form-control" value="{{ $sections['hero']['subtitle'] ?? '' }}" />
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Background Hero</label>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="d-block">
                                            <input type="radio" name="sections[hero][bg_type]" value="color" class="me-2" {{ ($sections['hero']['bg_type'] ?? 'color') === 'color' ? 'checked' : '' }} onchange="toggleHeroBg()">
                                            Warna Solid
                                        </label>
                                        <input type="color" name="sections[hero][bg_color]" value="{{ $sections['hero']['bg_color'] ?? '#1e3a8a' }}" class="form-control form-control-color w-100 mt-2" id="hero_bg_color">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="d-block">
                                            <input type="radio" name="sections[hero][bg_type]" value="gradient" class="me-2" {{ ($sections['hero']['bg_type'] ?? '') === 'gradient' ? 'checked' : '' }} onchange="toggleHeroBg()">
                                            Gradient
                                        </label>
                                        <select name="sections[hero][gradient]" class="form-select mt-2" id="hero_gradient">
                                            <option value="blue" {{ ($sections['hero']['gradient'] ?? '') === 'blue' ? 'selected' : '' }}>🔵 Blue Gradient</option>
                                            <option value="purple" {{ ($sections['hero']['gradient'] ?? '') === 'purple' ? 'selected' : '' }}>🟣 Purple Gradient</option>
                                            <option value="green" {{ ($sections['hero']['gradient'] ?? '') === 'green' ? 'selected' : '' }}>🟢 Green Gradient</option>
                                            <option value="orange" {{ ($sections['hero']['gradient'] ?? '') === 'orange' ? 'selected' : '' }}>🟠 Orange Gradient</option>
                                            <option value="dark" {{ ($sections['hero']['gradient'] ?? '') === 'dark' ? 'selected' : '' }}>⚫ Dark Gradient</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="d-block">
                                            <input type="radio" name="sections[hero][bg_type]" value="image" class="me-2" {{ ($sections['hero']['bg_type'] ?? '') === 'image' ? 'checked' : '' }} onchange="toggleHeroBg()">
                                            Gambar Background
                                        </label>
                                        <input type="file" name="sections[hero][bg_image]" class="form-control mt-2" id="hero_bg_image" accept="image/*">
                                        @if(!empty($sections['hero']['bg_image']))
                                            <small class="text-success">✓ Gambar sudah ada</small>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Tombol CTA 1</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">Teks</span>
                                        <input type="text" name="sections[hero][cta1_text]" class="form-control" value="{{ $sections['hero']['cta1_text'] ?? '' }}" />
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-text">Link</span>
                                        <input type="text" name="sections[hero][cta1_link]" class="form-control" value="{{ $sections['hero']['cta1_link'] ?? '' }}" />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Tombol CTA 2 <span class="text-muted">(Opsional)</span></label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">Teks</span>
                                        <input type="text" name="sections[hero][cta2_text]" class="form-control" value="{{ $sections['hero']['cta2_text'] ?? '' }}" />
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-text">Link</span>
                                        <input type="text" name="sections[hero][cta2_link]" class="form-control" value="{{ $sections['hero']['cta2_link'] ?? '' }}" />
                                    </div>
                                </div>
                            </div>

                            <div class="mb-0">
                                <label class="form-label">Tinggi Hero</label>
                                <select name="sections[hero][height]" class="form-select w-auto">
                                    <option value="small" {{ ($sections['hero']['height'] ?? '') === 'small' ? 'selected' : '' }}>Kecil (40vh)</option>
                                    <option value="medium" {{ ($sections['hero']['height'] ?? 'medium') === 'medium' ? 'selected' : '' }}>Sedang (60vh)</option>
                                    <option value="large" {{ ($sections['hero']['height'] ?? '') === 'large' ? 'selected' : '' }}>Besar (80vh)</option>
                                    <option value="full" {{ ($sections['hero']['height'] ?? '') === 'full' ? 'selected' : '' }}>Full Screen (100vh)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- ========== SECTION 2: ABOUT ========== -->
                    <div class="section-card card mb-5 {{ !empty($sections['about']['enabled']) ? 'active' : '' }}" id="section-about">
                        <div class="card-header d-flex align-items-center justify-content-between py-4" onclick="toggleSection('about')">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="form-check-input section-toggle me-3" name="sections[about][enabled]" id="about_enabled" value="1" {{ !empty($sections['about']['enabled']) ? 'checked' : '' }}>
                                <div>
                                    <h3 class="card-title mb-0">📖 About / Intro Section</h3>
                                    <small class="text-muted">Pengenalan dengan teks dan gambar</small>
                                </div>
                            </div>
                            <span class="badge badge-light-primary">Opsional</span>
                        </div>
                        <div class="card-body section-body" style="display: {{ !empty($sections['about']['enabled']) ? 'block' : 'none' }};">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label">Heading Section</label>
                                    <input type="text" name="sections[about][heading]" class="form-control" value="{{ $sections['about']['heading'] ?? '' }}" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Subheading</label>
                                    <input type="text" name="sections[about][subheading]" class="form-control" value="{{ $sections['about']['subheading'] ?? '' }}" />
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Konten / Deskripsi</label>
                                <textarea name="sections[about][content]" class="form-control" rows="5">{{ $sections['about']['content'] ?? '' }}</textarea>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label">Gambar Pendukung</label>
                                    <input type="file" name="sections[about][image]" class="form-control" accept="image/*">
                                    @if(!empty($sections['about']['image']))
                                        <small class="text-success">✓ Gambar sudah ada</small>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Posisi Gambar</label>
                                    <select name="sections[about][image_position]" class="form-select">
                                        <option value="right" {{ ($sections['about']['image_position'] ?? 'right') === 'right' ? 'selected' : '' }}>📷 Gambar di Kanan</option>
                                        <option value="left" {{ ($sections['about']['image_position'] ?? '') === 'left' ? 'selected' : '' }}>📷 Gambar di Kiri</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Tombol (Opsional)</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">Teks</span>
                                        <input type="text" name="sections[about][btn_text]" class="form-control" value="{{ $sections['about']['btn_text'] ?? '' }}" />
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-text">Link</span>
                                        <input type="text" name="sections[about][btn_link]" class="form-control" value="{{ $sections['about']['btn_link'] ?? '' }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ========== SECTION 3: FEATURES ========== -->
                    <div class="section-card card mb-5 {{ !empty($sections['features']['enabled']) ? 'active' : '' }}" id="section-features">
                        <div class="card-header d-flex align-items-center justify-content-between py-4" onclick="toggleSection('features')">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="form-check-input section-toggle me-3" name="sections[features][enabled]" id="features_enabled" value="1" {{ !empty($sections['features']['enabled']) ? 'checked' : '' }}>
                                <div>
                                    <h3 class="card-title mb-0">⭐ Features / Keunggulan</h3>
                                    <small class="text-muted">Daftar fitur/keunggulan dalam bentuk cards</small>
                                </div>
                            </div>
                            <span class="badge badge-light-primary">Opsional</span>
                        </div>
                        <div class="card-body section-body" style="display: {{ !empty($sections['features']['enabled']) ? 'block' : 'none' }};">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label">Heading Section</label>
                                    <input type="text" name="sections[features][heading]" class="form-control" value="{{ $sections['features']['heading'] ?? '' }}" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Subheading</label>
                                    <input type="text" name="sections[features][subheading]" class="form-control" value="{{ $sections['features']['subheading'] ?? '' }}" />
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Style Tampilan</label>
                                <select name="sections[features][style]" class="form-select w-auto">
                                    <option value="cards" {{ ($sections['features']['style'] ?? 'cards') === 'cards' ? 'selected' : '' }}>🃏 Cards dengan Shadow</option>
                                    <option value="icons" {{ ($sections['features']['style'] ?? '') === 'icons' ? 'selected' : '' }}>🎯 Icon Besar + Teks</option>
                                    <option value="list" {{ ($sections['features']['style'] ?? '') === 'list' ? 'selected' : '' }}>📋 List dengan Bullet</option>
                                    <option value="grid" {{ ($sections['features']['style'] ?? '') === 'grid' ? 'selected' : '' }}>📊 Grid Minimalis</option>
                                </select>
                            </div>

                            <label class="form-label">Daftar Fitur</label>
                            <div id="features-repeater">
                                @if(!empty($sections['features']['items']))
                                    @foreach($sections['features']['items'] as $key => $item)
                                    <div class="repeater-item" id="feature-{{ $key }}">
                                        <button type="button" class="btn btn-sm btn-light-danger remove-btn" onclick="removeItem('feature-{{ $key }}')">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        <div class="row">
                                            <div class="col-md-2 mb-3">
                                                <label class="form-label">Icon</label>
                                                <select name="sections[features][items][{{ $key }}][icon]" class="form-select">
                                                    @foreach(['star' => '⭐ Star', 'check' => '✅ Check', 'heart' => '❤️ Heart', 'rocket' => '🚀 Rocket', 'trophy' => '🏆 Trophy', 'lightbulb' => '💡 Idea', 'users' => '👥 Users', 'chart' => '📈 Growth', 'shield' => '🛡️ Shield', 'clock' => '⏰ Clock', 'target' => '🎯 Target', 'globe' => '🌐 Globe'] as $icon => $label)
                                                        <option value="{{ $icon }}" {{ ($item['icon'] ?? '') === $icon ? 'selected' : '' }}>{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Judul Fitur</label>
                                                <input type="text" name="sections[features][items][{{ $key }}][title]" class="form-control" value="{{ $item['title'] ?? '' }}" />
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Deskripsi</label>
                                                <textarea name="sections[features][items][{{ $key }}][text]" class="form-control" rows="2">{{ $item['text'] ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                            <button type="button" class="btn btn-light-primary btn-sm" onclick="addFeatureItem()">
                                <i class="fas fa-plus me-1"></i> Tambah Fitur
                            </button>
                        </div>
                    </div>

                    <!-- ========== SECTION 4: STATS ========== -->
                    <div class="section-card card mb-5 {{ !empty($sections['stats']['enabled']) ? 'active' : '' }}" id="section-stats">
                        <div class="card-header d-flex align-items-center justify-content-between py-4" onclick="toggleSection('stats')">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="form-check-input section-toggle me-3" name="sections[stats][enabled]" id="stats_enabled" value="1" {{ !empty($sections['stats']['enabled']) ? 'checked' : '' }}>
                                <div>
                                    <h3 class="card-title mb-0">📊 Stats / Angka-Angka</h3>
                                    <small class="text-muted">Tampilkan statistik dalam angka</small>
                                </div>
                            </div>
                            <span class="badge badge-light-primary">Opsional</span>
                        </div>
                        <div class="card-body section-body" style="display: {{ !empty($sections['stats']['enabled']) ? 'block' : 'none' }};">
                            <div class="mb-4">
                                <label class="form-label">Background Style</label>
                                <select name="sections[stats][bg_style]" class="form-select w-auto">
                                    <option value="light" {{ ($sections['stats']['bg_style'] ?? 'light') === 'light' ? 'selected' : '' }}>🔲 Light Background</option>
                                    <option value="colored" {{ ($sections['stats']['bg_style'] ?? '') === 'colored' ? 'selected' : '' }}>🎨 Colored Background</option>
                                    <option value="dark" {{ ($sections['stats']['bg_style'] ?? '') === 'dark' ? 'selected' : '' }}>⬛ Dark Background</option>
                                </select>
                            </div>

                            <label class="form-label">Daftar Statistik</label>
                            <div id="stats-repeater">
                                @if(!empty($sections['stats']['items']))
                                    @foreach($sections['stats']['items'] as $key => $item)
                                    <div class="repeater-item" id="stat-{{ $key }}">
                                        <button type="button" class="btn btn-sm btn-light-danger remove-btn" onclick="removeItem('stat-{{ $key }}')">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Angka</label>
                                                <input type="text" name="sections[stats][items][{{ $key }}][number]" class="form-control" value="{{ $item['number'] ?? '' }}" />
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Label</label>
                                                <input type="text" name="sections[stats][items][{{ $key }}][label]" class="form-control" value="{{ $item['label'] ?? '' }}" />
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Icon</label>
                                                <select name="sections[stats][items][{{ $key }}][icon]" class="form-select">
                                                    <option value="">Tanpa Icon</option>
                                                    @foreach(['users' => '👥 Users', 'graduation' => '🎓 Graduation', 'trophy' => '🏆 Trophy', 'calendar' => '📅 Calendar', 'building' => '🏢 Building', 'star' => '⭐ Star'] as $icon => $label)
                                                        <option value="{{ $icon }}" {{ ($item['icon'] ?? '') === $icon ? 'selected' : '' }}>{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                            <button type="button" class="btn btn-light-primary btn-sm" onclick="addStatItem()">
                                <i class="fas fa-plus me-1"></i> Tambah Statistik
                            </button>
                        </div>
                    </div>

                    <!-- ========== SECTION 5: FAQ ========== -->
                    <div class="section-card card mb-5 {{ !empty($sections['faq']['enabled']) ? 'active' : '' }}" id="section-faq">
                        <div class="card-header d-flex align-items-center justify-content-between py-4" onclick="toggleSection('faq')">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="form-check-input section-toggle me-3" name="sections[faq][enabled]" id="faq_enabled" value="1" {{ !empty($sections['faq']['enabled']) ? 'checked' : '' }}>
                                <div>
                                    <h3 class="card-title mb-0">❓ FAQ / Pertanyaan Umum</h3>
                                    <small class="text-muted">Daftar pertanyaan dan jawaban</small>
                                </div>
                            </div>
                            <span class="badge badge-light-primary">Opsional</span>
                        </div>
                        <div class="card-body section-body" style="display: {{ !empty($sections['faq']['enabled']) ? 'block' : 'none' }};">
                            <div class="mb-4">
                                <label class="form-label">Heading Section</label>
                                <input type="text" name="sections[faq][heading]" class="form-control" value="{{ $sections['faq']['heading'] ?? '' }}" />
                            </div>

                            <label class="form-label">Daftar FAQ</label>
                            <div id="faq-repeater">
                                @if(!empty($sections['faq']['items']))
                                    @foreach($sections['faq']['items'] as $key => $item)
                                    <div class="repeater-item" id="faq-{{ $key }}">
                                        <button type="button" class="btn btn-sm btn-light-danger remove-btn" onclick="removeItem('faq-{{ $key }}')">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        <div class="mb-3">
                                            <label class="form-label">Pertanyaan</label>
                                            <input type="text" name="sections[faq][items][{{ $key }}][question]" class="form-control" value="{{ $item['question'] ?? '' }}" />
                                        </div>
                                        <div class="mb-0">
                                            <label class="form-label">Jawaban</label>
                                            <textarea name="sections[faq][items][{{ $key }}][answer]" class="form-control" rows="3">{{ $item['answer'] ?? '' }}</textarea>
                                        </div>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                            <button type="button" class="btn btn-light-primary btn-sm" onclick="addFaqItem()">
                                <i class="fas fa-plus me-1"></i> Tambah FAQ
                            </button>
                        </div>
                    </div>

                    <!-- ========== SECTION 6: CTA ========== -->
                    <div class="section-card card mb-5 {{ !empty($sections['cta']['enabled']) ? 'active' : '' }}" id="section-cta">
                        <div class="card-header d-flex align-items-center justify-content-between py-4" onclick="toggleSection('cta')">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="form-check-input section-toggle me-3" name="sections[cta][enabled]" id="cta_enabled" value="1" {{ !empty($sections['cta']['enabled']) ? 'checked' : '' }}>
                                <div>
                                    <h3 class="card-title mb-0">🔘 CTA Banner</h3>
                                    <small class="text-muted">Banner call-to-action di bagian bawah</small>
                                </div>
                            </div>
                            <span class="badge badge-light-primary">Opsional</span>
                        </div>
                        <div class="card-body section-body" style="display: {{ !empty($sections['cta']['enabled']) ? 'block' : 'none' }};">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label">Heading CTA</label>
                                    <input type="text" name="sections[cta][heading]" class="form-control" value="{{ $sections['cta']['heading'] ?? '' }}" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Subheading</label>
                                    <input type="text" name="sections[cta][subheading]" class="form-control" value="{{ $sections['cta']['subheading'] ?? '' }}" />
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label">Tombol Utama</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">Teks</span>
                                        <input type="text" name="sections[cta][btn1_text]" class="form-control" value="{{ $sections['cta']['btn1_text'] ?? '' }}" />
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-text">Link</span>
                                        <input type="text" name="sections[cta][btn1_link]" class="form-control" value="{{ $sections['cta']['btn1_link'] ?? '' }}" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Tombol Sekunder <span class="text-muted">(Opsional)</span></label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">Teks</span>
                                        <input type="text" name="sections[cta][btn2_text]" class="form-control" value="{{ $sections['cta']['btn2_text'] ?? '' }}" />
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-text">Link</span>
                                        <input type="text" name="sections[cta][btn2_link]" class="form-control" value="{{ $sections['cta']['btn2_link'] ?? '' }}" />
                                    </div>
                                </div>
                            </div>

                            <div class="mb-0">
                                <label class="form-label">Background Style</label>
                                <select name="sections[cta][bg_style]" class="form-select w-auto">
                                    <option value="gradient" {{ ($sections['cta']['bg_style'] ?? 'gradient') === 'gradient' ? 'selected' : '' }}>🎨 Gradient</option>
                                    <option value="solid" {{ ($sections['cta']['bg_style'] ?? '') === 'solid' ? 'selected' : '' }}>🔲 Solid Color</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Publish Settings -->
                    <div class="card mb-5 sticky-top" style="top: 20px; z-index: 100;">
                        <div class="card-header">
                            <h3 class="card-title">⚙️ Pengaturan</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-5">
                                <label class="form-label required">Status</label>
                                <select name="status" class="form-select">
                                    <option value="draft" {{ $page->status === 'draft' ? 'selected' : '' }}>📝 Draft</option>
                                    <option value="published" {{ $page->status === 'published' ? 'selected' : '' }}>✅ Published</option>
                                </select>
                            </div>

                            @php $currentLayout = $page->layout ?? 'modern'; @endphp
                            <div class="mb-5">
                                <label class="form-label required">Pilih Layout</label>
                                <div class="row g-3">
                                    <div class="col-6">
                                        <input type="radio" name="layout" value="modern" id="layout_modern" class="btn-check" {{ $currentLayout === 'modern' ? 'checked' : '' }} />
                                        <label class="btn btn-outline-secondary w-100 p-3 text-start" for="layout_modern">
                                            <strong class="d-block">🎨 Modern</strong>
                                            <small class="text-muted">Clean & minimalis</small>
                                        </label>
                                    </div>
                                    <div class="col-6">
                                        <input type="radio" name="layout" value="classic" id="layout_classic" class="btn-check" {{ $currentLayout === 'classic' ? 'checked' : '' }} />
                                        <label class="btn btn-outline-secondary w-100 p-3 text-start" for="layout_classic">
                                            <strong class="d-block">📰 Classic</strong>
                                            <small class="text-muted">Tradisional & formal</small>
                                        </label>
                                    </div>
                                    <div class="col-6">
                                        <input type="radio" name="layout" value="bold" id="layout_bold" class="btn-check" {{ $currentLayout === 'bold' ? 'checked' : '' }} />
                                        <label class="btn btn-outline-secondary w-100 p-3 text-start" for="layout_bold">
                                            <strong class="d-block">💪 Bold</strong>
                                            <small class="text-muted">Warna & font besar</small>
                                        </label>
                                    </div>
                                    <div class="col-6">
                                        <input type="radio" name="layout" value="elegant" id="layout_elegant" class="btn-check" {{ $currentLayout === 'elegant' ? 'checked' : '' }} />
                                        <label class="btn btn-outline-secondary w-100 p-3 text-start" for="layout_elegant">
                                            <strong class="d-block">✨ Elegant</strong>
                                            <small class="text-muted">Mewah & premium</small>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between py-4">
                            <button type="button" class="btn btn-light-danger delete-page" data-id="{{ $page->id }}">
                                <i class="fas fa-trash"></i>
                            </button>
                            <div>
                                <a href="{{ route('pages.index') }}" class="btn btn-light me-2">Batal</a>
                                <button type="submit" class="btn btn-primary">
                                    <span class="indicator-label"><i class="fas fa-save me-1"></i> Update</span>
                                    <span class="indicator-progress">Menyimpan...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Color Settings -->
                    <div class="card mb-5">
                        <div class="card-header">
                            <h3 class="card-title">🎨 Warna Tema</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-4">
                                <label class="form-label">Warna Utama (Primary)</label>
                                <input type="color" name="accent_color" value="{{ $page->accent_color ?? '#1e3a8a' }}" class="form-control form-control-color w-100" style="height: 45px;">
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Warna Background</label>
                                <input type="color" name="bg_color" value="{{ $page->bg_color ?? '#ffffff' }}" class="form-control form-control-color w-100" style="height: 45px;">
                            </div>
                            <div class="mb-0">
                                <label class="form-label">Warna Teks</label>
                                <input type="color" name="text_color" value="{{ $page->text_color ?? '#333333' }}" class="form-control form-control-color w-100" style="height: 45px;">
                            </div>
                        </div>
                    </div>

                    <!-- SEO Settings -->
                    <div class="card mb-5">
                        <div class="card-header">
                            <h3 class="card-title">🔍 SEO (Opsional)</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-4">
                                <label class="form-label">Meta Title</label>
                                <input type="text" name="meta_title" class="form-control" value="{{ $page->meta_title }}" />
                            </div>
                            <div class="mb-0">
                                <label class="form-label">Meta Description</label>
                                <textarea name="meta_description" class="form-control" rows="3">{{ $page->meta_description }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Page Info -->
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted">Created by</span>
                                <span class="fw-bold">{{ $page->user->name ?? 'Unknown' }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted">Created</span>
                                <span>{{ $page->created_at->format('d M Y') }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Last Updated</span>
                                <span>{{ $page->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
@endsection

@push('scripts')
<script>
// Initialize counters based on existing items
let featureCount = {{ !empty($sections['features']['items']) ? max(array_keys($sections['features']['items'])) + 1 : 0 }};
let statCount = {{ !empty($sections['stats']['items']) ? max(array_keys($sections['stats']['items'])) + 1 : 0 }};
let faqCount = {{ !empty($sections['faq']['items']) ? max(array_keys($sections['faq']['items'])) + 1 : 0 }};

// Toggle section visibility
function toggleSection(section) {
    const checkbox = document.getElementById(section + '_enabled');
    const card = document.getElementById('section-' + section);
    const body = card.querySelector('.section-body');
    
    checkbox.checked = !checkbox.checked;
    
    if (checkbox.checked) {
        card.classList.add('active');
        body.style.display = 'block';
    } else {
        card.classList.remove('active');
        body.style.display = 'none';
    }
}

// Toggle Hero background type
function toggleHeroBg() {
    const bgType = document.querySelector('input[name="sections[hero][bg_type]"]:checked').value;
    document.getElementById('hero_bg_color').disabled = bgType !== 'color';
    document.getElementById('hero_gradient').disabled = bgType !== 'gradient';
    document.getElementById('hero_bg_image').disabled = bgType !== 'image';
}

// Add feature item
function addFeatureItem() {
    featureCount++;
    const html = `
        <div class="repeater-item" id="feature-${featureCount}">
            <button type="button" class="btn btn-sm btn-light-danger remove-btn" onclick="removeItem('feature-${featureCount}')">
                <i class="fas fa-times"></i>
            </button>
            <div class="row">
                <div class="col-md-2 mb-3">
                    <label class="form-label">Icon</label>
                    <select name="sections[features][items][${featureCount}][icon]" class="form-select">
                        <option value="star">⭐ Star</option>
                        <option value="check">✅ Check</option>
                        <option value="heart">❤️ Heart</option>
                        <option value="rocket">🚀 Rocket</option>
                        <option value="trophy">🏆 Trophy</option>
                        <option value="lightbulb">💡 Idea</option>
                        <option value="users">👥 Users</option>
                        <option value="chart">📈 Growth</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Judul Fitur</label>
                    <input type="text" name="sections[features][items][${featureCount}][title]" class="form-control" />
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="sections[features][items][${featureCount}][text]" class="form-control" rows="2"></textarea>
                </div>
            </div>
        </div>
    `;
    document.getElementById('features-repeater').insertAdjacentHTML('beforeend', html);
}

// Add stat item
function addStatItem() {
    statCount++;
    const html = `
        <div class="repeater-item" id="stat-${statCount}">
            <button type="button" class="btn btn-sm btn-light-danger remove-btn" onclick="removeItem('stat-${statCount}')">
                <i class="fas fa-times"></i>
            </button>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Angka</label>
                    <input type="text" name="sections[stats][items][${statCount}][number]" class="form-control" />
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Label</label>
                    <input type="text" name="sections[stats][items][${statCount}][label]" class="form-control" />
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Icon</label>
                    <select name="sections[stats][items][${statCount}][icon]" class="form-select">
                        <option value="">Tanpa Icon</option>
                        <option value="users">👥 Users</option>
                        <option value="graduation">🎓 Graduation</option>
                        <option value="trophy">🏆 Trophy</option>
                    </select>
                </div>
            </div>
        </div>
    `;
    document.getElementById('stats-repeater').insertAdjacentHTML('beforeend', html);
}

// Add FAQ item
function addFaqItem() {
    faqCount++;
    const html = `
        <div class="repeater-item" id="faq-${faqCount}">
            <button type="button" class="btn btn-sm btn-light-danger remove-btn" onclick="removeItem('faq-${faqCount}')">
                <i class="fas fa-times"></i>
            </button>
            <div class="mb-3">
                <label class="form-label">Pertanyaan</label>
                <input type="text" name="sections[faq][items][${faqCount}][question]" class="form-control" />
            </div>
            <div class="mb-0">
                <label class="form-label">Jawaban</label>
                <textarea name="sections[faq][items][${faqCount}][answer]" class="form-control" rows="3"></textarea>
            </div>
        </div>
    `;
    document.getElementById('faq-repeater').insertAdjacentHTML('beforeend', html);
}

// Remove repeater item
function removeItem(id) {
    document.getElementById(id).remove();
}

$(document).ready(function() {
    // Form submission
    $('#pageForm').on('submit', function(e) {
        e.preventDefault();
        const form = $(this);
        const btn = form.find('button[type="submit"]');
        
        btn.attr('data-kt-indicator', 'on').prop('disabled', true);
        
        const formData = new FormData(this);
        
        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message,
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.reload();
                    });
                }
            },
            error: function(xhr) {
                btn.removeAttr('data-kt-indicator').prop('disabled', false);
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    let errorMsg = '';
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        errorMsg += value[0] + '\n';
                    });
                    Swal.fire('Error Validasi', errorMsg, 'error');
                } else {
                    Swal.fire('Error', 'Gagal menyimpan halaman', 'error');
                }
            }
        });
    });

    // Delete page
    $('.delete-page').on('click', function() {
        const id = $(this).data('id');
        
        Swal.fire({
            title: 'Hapus Halaman?',
            text: "Tindakan ini tidak dapat dibatalkan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/pages/${id}`,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire('Terhapus!', response.message, 'success').then(() => {
                                window.location = '{{ route("pages.index") }}';
                            });
                        }
                    },
                    error: function() {
                        Swal.fire('Error!', 'Gagal menghapus halaman', 'error');
                    }
                });
            }
        });
    });
    
    // Initialize hero bg toggle
    toggleHeroBg();
});
</script>
@endpush
