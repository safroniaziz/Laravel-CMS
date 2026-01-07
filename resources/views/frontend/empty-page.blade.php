@extends('layouts.frontend')

@section('content')
<div style="min-height: 60vh; display: flex; align-items: center; justify-content: center; padding: 60px 0;">
    <div class="container">
        <div style="max-width: 600px; margin: 0 auto; text-align: center;">
            <div style="width: 120px; height: 120px; background: linear-gradient(135deg, #1e3a8a, #2563eb); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 30px;">
                <i class="fas fa-file-alt" style="font-size: 50px; color: #fff;"></i>
            </div>
            
            <h1 style="font-size: 32px; font-weight: 900; color: #1e3a8a; margin-bottom: 15px;">
                Halaman Belum Tersedia
            </h1>
            
            <p style="font-size: 18px; color: #666; margin-bottom: 30px; line-height: 1.6;">
                Konten untuk halaman <strong>{{ $pageUrl }}</strong> sedang dalam proses pengembangan oleh administrator.
            </p>
            
            <div style="background: #f0f9ff; border-left: 4px solid #2563eb; padding: 20px; border-radius: 8px; margin-bottom: 30px; text-align: left;">
                <p style="margin: 0; color: #1e3a8a; font-size: 14px;">
                    <i class="fas fa-info-circle" style="margin-right: 8px;"></i>
                    <strong>Informasi:</strong> Administrator sedang menyiapkan konten untuk halaman ini. Silakan kembali lagi nanti atau hubungi kami jika membutuhkan informasi lebih lanjut.
                </p>
            </div>
            
            <a href="{{ url('/') }}" style="display: inline-block; padding: 12px 30px; background: linear-gradient(135deg, #1e3a8a, #2563eb); color: #fff; text-decoration: none; border-radius: 8px; font-weight: 600; transition: transform 0.3s;">
                <i class="fas fa-home" style="margin-right: 8px;"></i>
                Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
@endsection
