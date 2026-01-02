@extends('layouts.frontend')

@section('content')
    {{-- Hero Slider Section --}}
    @include('frontend.partials.home.hero-slider')

    {{-- Custom Sections - After Hero Position --}}
    @include('frontend.partials.home.home-blocks', ['position' => 'after_hero'])

    {{-- Berita Terbaru Section - Current Style --}}
    @include('frontend.partials.home.berita-terbaru')

    {{-- Custom Sections - After News Position --}}
    @include('frontend.partials.home.home-blocks', ['position' => 'after_news'])

    {{-- Category Sections (Pendidikan, Prestasi, Penelitian) --}}
    @include('frontend.partials.home.category-sections')

    {{-- Custom Sections - After About/Categories Position --}}
    @include('frontend.partials.home.home-blocks', ['position' => 'after_about'])

    {{-- Other Sections (Academic Info, Dosen, Alumni, etc) --}}
    @include('frontend.partials.home.other-sections')
@endsection

{{-- Scripts --}}
@include('frontend.partials.home.scripts')

{{-- Styles --}}
@include('frontend.partials.home.styles')
