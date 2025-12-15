<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // General Settings
            ['key' => 'site_name', 'value' => 'My CMS', 'type' => 'string', 'group' => 'general'],
            ['key' => 'site_tagline', 'value' => 'Custom Content Management System', 'type' => 'string', 'group' => 'general'],
            ['key' => 'site_description', 'value' => 'A powerful custom CMS built with Laravel', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_logo', 'value' => '', 'type' => 'image', 'group' => 'general'],
            ['key' => 'site_favicon', 'value' => '', 'type' => 'image', 'group' => 'general'],

            // Contact Information
            ['key' => 'contact_email', 'value' => 'info@example.com', 'type' => 'string', 'group' => 'contact'],
            ['key' => 'contact_phone', 'value' => '+62 123 456 7890', 'type' => 'string', 'group' => 'contact'],
            ['key' => 'contact_address', 'value' => 'Jakarta, Indonesia', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_map_embed', 'value' => '', 'type' => 'text', 'group' => 'contact'],

            // Social Media
            ['key' => 'social_facebook', 'value' => '', 'type' => 'string', 'group' => 'social'],
            ['key' => 'social_twitter', 'value' => '', 'type' => 'string', 'group' => 'social'],
            ['key' => 'social_instagram', 'value' => '', 'type' => 'string', 'group' => 'social'],
            ['key' => 'social_linkedin', 'value' => '', 'type' => 'string', 'group' => 'social'],
            ['key' => 'social_youtube', 'value' => '', 'type' => 'string', 'group' => 'social'],

            // SEO Settings
            ['key' => 'seo_meta_title', 'value' => 'My CMS', 'type' => 'string', 'group' => 'seo'],
            ['key' => 'seo_meta_description', 'value' => 'A powerful custom CMS', 'type' => 'text', 'group' => 'seo'],
            ['key' => 'seo_meta_keywords', 'value' => 'cms, laravel, content management', 'type' => 'text', 'group' => 'seo'],
            ['key' => 'seo_google_analytics', 'value' => '', 'type' => 'text', 'group' => 'seo'],

            // Theme Settings
            ['key' => 'active_theme', 'value' => 'default', 'type' => 'string', 'group' => 'theme'],
            ['key' => 'posts_per_page', 'value' => '10', 'type' => 'number', 'group' => 'theme'],

            // Homepage Sections - Berita Terbaru
            ['key' => 'news_section_title', 'value' => 'Berita Terbaru', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'news_section_subtitle', 'value' => 'Informasi dan Berita Terbaru Program Studi Sistem Informasi', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'news_section_show_subtitle', 'value' => '0', 'type' => 'boolean', 'group' => 'homepage'],
            ['key' => 'news_section_accent_color', 'value' => '#f97316', 'type' => 'string', 'group' => 'homepage'],

            // Legacy keys (keep for backward compatibility)
            ['key' => 'home_news_title', 'value' => 'BERITA TERKINI', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'home_news_subtitle', 'value' => 'Informasi dan Berita Terbaru Program Studi Sistem Informasi', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'home_news_show_subtitle', 'value' => '1', 'type' => 'boolean', 'group' => 'homepage'],

            ['key' => 'home_hero_title', 'value' => 'PROFIL LULUSAN', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'home_hero_subtitle', 'value' => 'Selamat datang di platform kami! Kami adalah program studi terkemuka yang menghasilkan lulusan berkualitas dengan kompetensi tinggi di bidangnya.', 'type' => 'text', 'group' => 'homepage'],

            // Academic Section Header
            ['key' => 'academic_section_badge_text', 'value' => 'INFORMASI AKADEMIK', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'academic_section_icon', 'value' => '', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'academic_section_title', 'value' => 'Kegiatan & Program Akademik', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'academic_section_subtitle', 'value' => 'Informasi terkini seputar kegiatan akademik, program mahasiswa, dan pencapaian yang membanggakan Program Studi Sistem Informasi', 'type' => 'text', 'group' => 'homepage'],
            
            // Academic Section Colors
            ['key' => 'academic_section_primary_color', 'value' => '#1a246a', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'academic_section_accent_color', 'value' => '#f59e0b', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'academic_section_bg_start', 'value' => '#f8fafc', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'academic_section_bg_end', 'value' => '#ffffff', 'type' => 'string', 'group' => 'homepage'],

            ['key' => 'home_alumni_title', 'value' => 'Informasi Akademik', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'home_dosen_title', 'value' => 'DOSEN SISTEM INFORMASI', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'home_video_title', 'value' => 'KENALI SISTEM INFORMASI LEBIH DEKAT!', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'home_program_title', 'value' => 'Informasi Program Studi', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'home_requirements_title', 'value' => 'Persyaratan Masuk', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'home_testimonial_title', 'value' => 'Apa Kata Alumni Kami', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'home_cta_title', 'value' => 'Siap Bergabung Bersama Kami?', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'home_cta_subtitle', 'value' => 'Daftar sekarang dan raih masa depan cemerlang di bidang Sistem Informasi', 'type' => 'string', 'group' => 'homepage'],

            // Dosen Section Layout
            ['key' => 'dosen_layout_style', 'value' => 'slider', 'type' => 'select', 'group' => 'homepage', 'options' => json_encode(['slider' => 'Current Slider Design', 'stats_cards' => 'Modern Stats Cards', 'featured_grid' => 'Featured + Grid Hybrid'])],

            // Dosen Section Header
            ['key' => 'dosen_section_badge_text', 'value' => 'TIM PENGAJAR', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'dosen_section_icon', 'value' => 'fa-chalkboard-teacher', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'dosen_section_title', 'value' => 'Dosen', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'dosen_section_title_highlight', 'value' => 'Sistem Informasi', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'dosen_section_subtitle', 'value' => 'Tim pengajar profesional berpengalaman dengan keahlian di bidang teknologi informasi, sistem bisnis, dan transformasi digital', 'type' => 'text', 'group' => 'homepage'],
            
            // Dosen Section Colors
            ['key' => 'dosen_section_primary_color', 'value' => '#1a246a', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'dosen_section_highlight_color', 'value' => '#f59e0b', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'dosen_section_bg_start', 'value' => '#f0f4ff', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'dosen_section_bg_end', 'value' => '#fafbff', 'type' => 'string', 'group' => 'homepage'],

            // Kenali Section Layout
            ['key' => 'kenali_layout_style', 'value' => 'current', 'type' => 'select', 'group' => 'homepage', 'options' => json_encode(['current' => 'Current Design (Video + Cards)', 'minimalist' => 'Minimalist Focus Layout', 'dual_column' => 'Dual-Column Interactive'])],

            // Kenali Section - Info 1 (Apa itu SI?)
            ['key' => 'kenali_info_1_icon', 'value' => 'fa-lightbulb', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'kenali_info_1_title', 'value' => 'Apa itu SI?', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'kenali_info_1_desc', 'value' => 'Disiplin ilmu yang mempelajari interaksi antara Teknologi Informasi dengan Sistem Sosial untuk menciptakan solusi digital yang efektif.', 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'kenali_info_1_color', 'value' => '#fbbf24', 'type' => 'string', 'group' => 'homepage'],

            // Kenali Section - Info 2 (Prospek Karir)
            ['key' => 'kenali_info_2_icon', 'value' => 'fa-rocket', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'kenali_info_2_title', 'value' => 'Prospek Karir', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'kenali_info_2_desc', 'value' => 'IS Developer, Technopreneur, Konsultan e-Business, Akademisi SI. Lulusan siap menghadapi tantangan industri 4.0 dan era digital.', 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'kenali_info_2_color', 'value' => '#10b981', 'type' => 'string', 'group' => 'homepage'],

            // Kenali Section - Info 3 (Keunggulan)
            ['key' => 'kenali_info_3_icon', 'value' => 'fa-award', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'kenali_info_3_title', 'value' => 'Keunggulan', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'kenali_info_3_desc', 'value' => 'Terakreditasi A oleh BAN-PT dan terakreditasi internasional ACQUIN. Sertifikasi pelatihan internasional untuk mahasiswa.', 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'kenali_info_3_color', 'value' => '#8b5cf6', 'type' => 'string', 'group' => 'homepage'],

            // Kenali Section - Stat 1 (Alumni Sukses)
            ['key' => 'kenali_stat_1_icon', 'value' => 'fa-users', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'kenali_stat_1_number', 'value' => '150+', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'kenali_stat_1_label', 'value' => 'Alumni Sukses', 'type' => 'string', 'group' => 'homepage'],

            // Kenali Section - Stat 2 (Job Placement)
            ['key' => 'kenali_stat_2_icon', 'value' => 'fa-briefcase', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'kenali_stat_2_number', 'value' => '95+', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'kenali_stat_2_label', 'value' => 'Job Placement (%)', 'type' => 'string', 'group' => 'homepage'],

            // Kenali Section - Stat 3 (Partner Industri)
            ['key' => 'kenali_stat_3_icon', 'value' => 'fa-handshake', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'kenali_stat_3_number', 'value' => '20+', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'kenali_stat_3_label', 'value' => 'Partner Industri', 'type' => 'string', 'group' => 'homepage'],

            // Kenali Section - Stat 4 (Akreditasi)
            ['key' => 'kenali_stat_4_icon', 'value' => 'fa-certificate', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'kenali_stat_4_number', 'value' => 'A', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'kenali_stat_4_label', 'value' => 'Akreditasi', 'type' => 'string', 'group' => 'homepage'],

            // Kenali Section - CTA
            ['key' => 'kenali_cta_text', 'value' => 'Pelajari Lebih Lanjut', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'kenali_cta_link', 'value' => '/about', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'kenali_cta_icon', 'value' => 'fa-arrow-right', 'type' => 'string', 'group' => 'homepage'],

            // Mail Settings
            ['key' => 'mail_from_name', 'value' => 'My CMS', 'type' => 'string', 'group' => 'mail'],
            ['key' => 'mail_from_address', 'value' => 'noreply@example.com', 'type' => 'string', 'group' => 'mail'],
        ];

        foreach ($settings as $setting) {
            Setting::firstOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}

