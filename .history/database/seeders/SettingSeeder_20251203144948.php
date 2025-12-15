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

            // Global Theme Colors
            ['key' => 'theme_primary_color', 'value' => '#1a246a', 'type' => 'string', 'group' => 'theme'],
            ['key' => 'theme_secondary_color', 'value' => '#151945', 'type' => 'string', 'group' => 'theme'],
            ['key' => 'theme_accent_color', 'value' => '#f59e0b', 'type' => 'string', 'group' => 'theme'],
            ['key' => 'theme_accent_color_2', 'value' => '#f97316', 'type' => 'string', 'group' => 'theme'],
            ['key' => 'theme_accent_color_3', 'value' => '#fbbf24', 'type' => 'string', 'group' => 'theme'],
            ['key' => 'theme_text_primary', 'value' => '#1e293b', 'type' => 'string', 'group' => 'theme'],
            ['key' => 'theme_text_secondary', 'value' => '#64748b', 'type' => 'string', 'group' => 'theme'],
            ['key' => 'theme_bg_light', 'value' => '#f8fafc', 'type' => 'string', 'group' => 'theme'],
            ['key' => 'theme_bg_white', 'value' => '#ffffff', 'type' => 'string', 'group' => 'theme'],

            // Homepage Sections - Berita Terbaru
            ['key' => 'news_section_title', 'value' => 'Berita Terbaru', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'news_section_subtitle', 'value' => 'Informasi dan Berita Terbaru Program Studi Sistem Informasi', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'news_section_show_subtitle', 'value' => '0', 'type' => 'boolean', 'group' => 'homepage'],
            ['key' => 'news_section_primary_color', 'value' => '#1a246a', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'news_section_accent_color', 'value' => '#f97316', 'type' => 'string', 'group' => 'homepage'],

            // News Section Layout
            ['key' => 'news_layout_style', 'value' => 'current', 'type' => 'select', 'group' => 'homepage', 'options' => json_encode(['current' => 'Current UGM Style', 'academic_grid' => 'Academic Grid Cards', 'featured_list' => 'Featured List View', 'magazine' => 'Magazine Style'])],

            // Hero Slider Layout
            ['key' => 'hero_layout_style', 'value' => 'current', 'type' => 'select', 'group' => 'homepage', 'options' => json_encode(['current' => 'Current Split Layout', 'centered' => 'Centered Layout', 'minimal' => 'Minimal Layout', 'fullscreen' => 'Fullscreen Layout'])],

            // Hero Slider Badge
            ['key' => 'hero_badge_text', 'value' => 'UNGGUL', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'hero_badge_subtext', 'value' => 'Terakreditasi', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'hero_badge_show', 'value' => '1', 'type' => 'boolean', 'group' => 'homepage'],

            // Hero Slider Colors
            ['key' => 'hero_primary_color', 'value' => '#1a246a', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'hero_accent_color', 'value' => '#fbbf24', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'hero_secondary_color', 'value' => '#f97316', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'hero_gradient_start', 'value' => '#0f172a', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'hero_gradient_mid', 'value' => '#1a246a', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'hero_gradient_end', 'value' => '#151945', 'type' => 'string', 'group' => 'homepage'],

            // Hero Slider Secondary Button
            ['key' => 'hero_secondary_button_text', 'value' => 'Pelajari Lebih Lanjut', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'hero_secondary_button_link', 'value' => '/page/about', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'hero_secondary_button_show', 'value' => '1', 'type' => 'boolean', 'group' => 'homepage'],

            // Category Sections Layout
            ['key' => 'category_layout_style', 'value' => 'current', 'type' => 'select', 'group' => 'homepage', 'options' => json_encode(['current' => 'Current 3-Column', 'grid' => 'Grid Cards', 'list' => 'List View', 'tabs' => 'Tabs View'])],

            // Category Sections Settings
            ['key' => 'category_section_title_1', 'value' => 'Pendidikan', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'category_section_slug_1', 'value' => 'akademik', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'category_section_title_2', 'value' => 'Prestasi', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'category_section_slug_2', 'value' => 'prestasi', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'category_section_title_3', 'value' => 'Penelitian dan Inovasi', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'category_section_slug_3', 'value' => 'penelitian', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'category_accent_color', 'value' => '#f97316', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'category_primary_color', 'value' => '#1a246a', 'type' => 'string', 'group' => 'homepage'],

            // Legacy keys (keep for backward compatibility)
            ['key' => 'home_news_title', 'value' => 'BERITA TERKINI', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'home_news_subtitle', 'value' => 'Informasi dan Berita Terbaru Program Studi Sistem Informasi', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'home_news_show_subtitle', 'value' => '1', 'type' => 'boolean', 'group' => 'homepage'],

            ['key' => 'home_hero_title', 'value' => 'PROFIL LULUSAN', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'home_hero_subtitle', 'value' => 'Selamat datang di platform kami! Kami adalah program studi terkemuka yang menghasilkan lulusan berkualitas dengan kompetensi tinggi di bidangnya.', 'type' => 'text', 'group' => 'homepage'],

            // Academic Section Layout
            ['key' => 'academic_layout_style', 'value' => 'featured_stack', 'type' => 'select', 'group' => 'homepage', 'options' => json_encode(['featured_stack' => 'Featured + Stack (Current)', 'timeline' => 'Timeline Akademis', 'agenda' => 'Agenda View', 'schedule' => 'Schedule View'])],

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
            // CTA Section
            ['key' => 'cta_layout_style', 'value' => 'current', 'type' => 'select', 'group' => 'homepage', 'options' => json_encode(['current' => 'Current Modern Design', 'minimal' => 'Minimal Clean', 'split' => 'Split Content', 'centered' => 'Centered Simple'])],
            ['key' => 'cta_badge_text', 'value' => 'PROGRAM STUDI SISTEM INFORMASI UNIB', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'cta_badge_show', 'value' => '1', 'type' => 'boolean', 'group' => 'homepage'],
            ['key' => 'cta_title', 'value' => 'Siap Kuliah di Sistem Informasi UNIB?', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'cta_subtitle', 'value' => 'Daftar dan bergabung dengan keluarga besar Program Studi Sistem Informasi Universitas Bengkulu', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'cta_bg_gradient_start', 'value' => '#0f172a', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'cta_bg_gradient_mid', 'value' => '#1a246a', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'cta_bg_gradient_end', 'value' => '#1a246a', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'cta_accent_color', 'value' => '#fbbf24', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'cta_accent_color_2', 'value' => '#f97316', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'cta_primary_button_text', 'value' => 'Mulai Sekarang', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'cta_primary_button_link', 'value' => '/contact', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'cta_primary_button_icon', 'value' => 'fa-rocket', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'cta_secondary_button_text', 'value' => 'Jelajahi Program', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'cta_secondary_button_link', 'value' => '/about', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'cta_secondary_button_icon', 'value' => 'fa-compass', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'cta_feature_1_icon', 'value' => 'fa-graduation-cap', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'cta_feature_1_title', 'value' => 'Pendidikan Berkualitas', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'cta_feature_1_description', 'value' => 'Kurikulum modern dan relevan dengan industri', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'cta_feature_2_icon', 'value' => 'fa-laptop-code', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'cta_feature_2_title', 'value' => 'Praktik Terbaik', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'cta_feature_2_description', 'value' => 'Pembelajaran berbasis proyek dan kasus nyata', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'cta_feature_3_icon', 'value' => 'fa-briefcase', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'cta_feature_3_title', 'value' => 'Karir Cemerlang', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'cta_feature_3_description', 'value' => 'Jaringan alumni dan peluang kerja luas', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'cta_features_show', 'value' => '1', 'type' => 'boolean', 'group' => 'homepage'],

            // Info PMB Banner Section
            ['key' => 'pmb_layout_style', 'value' => 'current', 'type' => 'select', 'group' => 'homepage', 'options' => json_encode(['current' => 'Current Banner', 'compact' => 'Compact Banner'])],
            ['key' => 'pmb_badge_text', 'value' => 'PENERIMAAN MAHASISWA BARU', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'pmb_badge_icon', 'value' => 'fa-circle', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'pmb_title', 'value' => 'Informasi PMB Tahun {{year}}', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'pmb_subtitle', 'value' => 'Program Studi Sistem Informasi Universitas Bengkulu', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'pmb_button_text', 'value' => 'Info Selengkapnya', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'pmb_button_link', 'value' => '/contact', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'pmb_button_icon', 'value' => 'fa-arrow-right', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'pmb_bg_color', 'value' => '#f8fafc', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'pmb_border_color', 'value' => '#e5e7eb', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'pmb_badge_bg', 'value' => '#f1f5f9', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'pmb_badge_dot_color', 'value' => '#f59e0b', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'pmb_title_color', 'value' => '#1e293b', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'pmb_subtitle_color', 'value' => '#64748b', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'pmb_button_bg', 'value' => '#1a246a', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'pmb_button_text_color', 'value' => '#ffffff', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'pmb_button_border_color', 'value' => '#1a246a', 'type' => 'string', 'group' => 'homepage'],

            // Global theme neutrals for functional colors/icons
            ['key' => 'theme_muted_text_color', 'value' => '#64748b', 'type' => 'string', 'group' => 'theme'],
            ['key' => 'theme_border_color', 'value' => '#e2e8f0', 'type' => 'string', 'group' => 'theme'],
            ['key' => 'theme_muted_bg', 'value' => '#f8fafc', 'type' => 'string', 'group' => 'theme'],
            ['key' => 'theme_icon_primary', 'value' => '#1a246a', 'type' => 'string', 'group' => 'theme'],
            ['key' => 'theme_icon_muted', 'value' => '#94a3b8', 'type' => 'string', 'group' => 'theme'],

            // Global functional icons (meta/info)
            ['key' => 'icon_calendar', 'value' => 'far fa-calendar', 'type' => 'string', 'group' => 'icons'],
            ['key' => 'icon_users', 'value' => 'fas fa-users', 'type' => 'string', 'group' => 'icons'],
            ['key' => 'icon_location', 'value' => 'fas fa-map-marker-alt', 'type' => 'string', 'group' => 'icons'],
            ['key' => 'icon_arrow_right', 'value' => 'fas fa-arrow-right', 'type' => 'string', 'group' => 'icons'],
            ['key' => 'icon_image_fallback', 'value' => 'fas fa-image', 'type' => 'string', 'group' => 'icons'],
            ['key' => 'icon_news_fallback', 'value' => 'fas fa-newspaper', 'type' => 'string', 'group' => 'icons'],

            // Empty state texts
            ['key' => 'news_empty_text', 'value' => 'Belum ada berita terbaru.', 'type' => 'string', 'group' => 'homepage'],
            ['key' => 'category_empty_text', 'value' => 'Belum ada berita untuk kategori ini.', 'type' => 'string', 'group' => 'homepage'],

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

