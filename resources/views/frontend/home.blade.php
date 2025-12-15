@extends('layouts.frontend')

@section('content')
    {{-- Hero Slider Section --}}
    @include('frontend.partials.home.hero-slider')

    {{-- Berita Terbaru Section - UGM Style --}}
    @include('frontend.partials.home.berita-terbaru')

    {{-- Category Sections (Pendidikan, Prestasi, Penelitian) --}}
    @include('frontend.partials.home.category-sections')

    {{-- Other Sections (Academic Info, Dosen, Alumni, etc) --}}
    @include('frontend.partials.home.other-sections')
@endsection

{{-- Scripts --}}
@include('frontend.partials.home.scripts')

{{-- Styles --}}
@include('frontend.partials.home.styles')
