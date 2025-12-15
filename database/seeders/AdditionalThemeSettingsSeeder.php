<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class AdditionalThemeSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $additionalSettings = [
            // ===== NAVIGATION MENU SETTINGS =====
            ['key' => 'nav_menu_beranda_id', 'value' => 'Beranda', 'type' => 'string', 'group' => 'navigation'],
            ['key' => 'nav_menu_beranda_en', 'value' => 'Homepage', 'type' => 'string', 'group' => 'navigation'],
            ['key' => 'nav_menu_profil_id', 'value' => 'Profil', 'type' => 'string', 'group' => 'navigation'],
            ['key' => 'nav_menu_profil_en', 'value' => 'Profile', 'type' => 'string', 'group' => 'navigation'],
            ['key' => 'nav_menu_tridharma_id', 'value' => 'Tri Dharma', 'type' => 'string', 'group' => 'navigation'],
            ['key' => 'nav_menu_tridarma_en', 'value' => 'Three Roles', 'type' => 'string', 'group' => 'navigation'],
            ['key' => 'nav_menu_kemahasiswaan_id', 'value' => 'Kemahasiswaan', 'type' => 'string', 'group' => 'navigation'],
            ['key' => 'nav_menu_kemahasiswaan_en', 'value' => 'Student Center', 'type' => 'string', 'group' => 'navigation'],
            ['key' => 'nav_menu_fasilitas_id', 'value' => 'Fasilitas', 'type' => 'string', 'group' => 'navigation'],
            ['key' => 'nav_menu_fasilitas_en', 'value' => 'Facility', 'type' => 'string', 'group' => 'navigation'],
            ['key' => 'nav_menu_unduh_id', 'value' => 'Unduh', 'type' => 'string', 'group' => 'navigation'],
            ['key' => 'nav_menu_unduh_en', 'value' => 'Download', 'type' => 'string', 'group' => 'navigation'],

            // Navigation Dropdown Items
            ['key' => 'nav_dropdown_sejarah', 'value' => 'Sejarah', 'type' => 'string', 'group' => 'navigation'],
            ['key' => 'nav_dropdown_visi_misi', 'value' => 'Visi dan Misi', 'type' => 'string', 'group' => 'navigation'],
            ['key' => 'nav_dropdown_tujuan', 'value' => 'Tujuan', 'type' => 'string', 'group' => 'navigation'],
            ['key' => 'nav_dropdown_dosen', 'value' => 'Dosen', 'type' => 'string', 'group' => 'navigation'],
            ['key' => 'nav_dropdown_struktur', 'value' => 'Struktur Organisasi', 'type' => 'string', 'group' => 'navigation'],

            // ===== LAYOUT COLORS (yang masih hardcode) =====
            ['key' => 'layout_header_bg', 'value' => '#1a246a', 'type' => 'string', 'group' => 'layout'],
            ['key' => 'layout_nav_hover_bg', 'value' => 'rgba(255,255,255,0.1)', 'type' => 'string', 'group' => 'layout'],
            ['key' => 'layout_hero_gradient_start', 'value' => '#1e3a8a', 'type' => 'string', 'group' => 'layout'],
            ['key' => 'layout_hero_gradient_end', 'value' => '#2563eb', 'type' => 'string', 'group' => 'layout'],
            ['key' => 'layout_hero_accent', 'value' => '#f97316', 'type' => 'string', 'group' => 'layout'],
            ['key' => 'layout_news_date_color', 'value' => '#1e3a8a', 'type' => 'string', 'group' => 'layout'],
            ['key' => 'layout_news_hover_color', 'value' => '#f97316', 'type' => 'string', 'group' => 'layout'],
            ['key' => 'layout_team_gradient_start', 'value' => '#1e3a8a', 'type' => 'string', 'group' => 'layout'],
            ['key' => 'layout_team_gradient_end', 'value' => '#2563eb', 'type' => 'string', 'group' => 'layout'],

            // ===== COMPONENT COLORS (inline styles yang hardcode) =====
            ['key' => 'component_white_bg', 'value' => '#ffffff', 'type' => 'string', 'group' => 'components'],
            ['key' => 'component_location_badge_bg', 'value' => '#fef3c7', 'type' => 'string', 'group' => 'components'],
            ['key' => 'component_location_badge_text', 'value' => '#92400e', 'type' => 'string', 'group' => 'components'],
            ['key' => 'component_tag_bg', 'value' => '#e8eaf6', 'type' => 'string', 'group' => 'components'],
            ['key' => 'component_tag_text', 'value' => '#1a246a', 'type' => 'string', 'group' => 'components'],
            ['key' => 'component_border_light', 'value' => '#e5e7eb', 'type' => 'string', 'group' => 'components'],
            ['key' => 'component_shadow_light', 'value' => 'rgba(0,0,0,0.06)', 'type' => 'string', 'group' => 'components'],

            // ===== EMOJI & SYMBOLS =====
            ['key' => 'emoji_calendar', 'value' => '📅', 'type' => 'string', 'group' => 'symbols'],
            ['key' => 'emoji_star', 'value' => '⭐', 'type' => 'string', 'group' => 'symbols'],
            ['key' => 'status_icon_open', 'value' => '🟢', 'type' => 'string', 'group' => 'symbols'],
            ['key' => 'status_icon_ongoing', 'value' => '🔵', 'type' => 'string', 'group' => 'symbols'],
            ['key' => 'status_icon_completed', 'value' => '⚪', 'type' => 'string', 'group' => 'symbols'],

            // ===== TYPOGRAPHY SETTINGS =====
            ['key' => 'typography_primary_font', 'value' => 'Outfit', 'type' => 'string', 'group' => 'typography'],
            ['key' => 'typography_secondary_font', 'value' => 'Roboto', 'type' => 'string', 'group' => 'typography'],
            ['key' => 'typography_google_fonts_url', 'value' => 'https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&family=Outfit:wght@300;400;500;600;700;800;900&display=swap', 'type' => 'text', 'group' => 'typography'],
            ['key' => 'typography_fontawesome_url', 'value' => 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css', 'type' => 'text', 'group' => 'typography'],

            // ===== LAYOUT DIMENSIONS =====
            ['key' => 'layout_container_max_width', 'value' => '1300px', 'type' => 'string', 'group' => 'layout'],
            ['key' => 'layout_featured_post_width', 'value' => '453px', 'type' => 'string', 'group' => 'layout'],
            ['key' => 'layout_featured_post_height', 'value' => '309px', 'type' => 'string', 'group' => 'layout'],

            // ===== ANIMATION & TRANSITIONS =====
            ['key' => 'animation_transition_duration', 'value' => '0.3s', 'type' => 'string', 'group' => 'animation'],
            ['key' => 'animation_hover_transform', 'value' => 'translateY(-4px)', 'type' => 'string', 'group' => 'animation'],
            ['key' => 'animation_cubic_bezier', 'value' => 'cubic-bezier(0.4, 0, 0.2, 1)', 'type' => 'string', 'group' => 'animation'],

            // ===== CARD STYLING =====
            ['key' => 'card_border_radius', 'value' => '20px', 'type' => 'string', 'group' => 'cards'],
            ['key' => 'card_shadow_default', 'value' => '0 4px 20px rgba(0,0,0,0.06)', 'type' => 'string', 'group' => 'cards'],
            ['key' => 'card_shadow_hover', 'value' => '0 8px 32px rgba(26, 36, 106, 0.15)', 'type' => 'string', 'group' => 'cards'],
            ['key' => 'card_transition', 'value' => 'all 0.4s cubic-bezier(0.4, 0, 0.2, 1)', 'type' => 'string', 'group' => 'cards'],

            // ===== RESPONSIVE BREAKPOINTS =====
            ['key' => 'responsive_mobile_breakpoint', 'value' => '768px', 'type' => 'string', 'group' => 'responsive'],
            ['key' => 'responsive_tablet_breakpoint', 'value' => '1024px', 'type' => 'string', 'group' => 'responsive'],
            ['key' => 'responsive_desktop_breakpoint', 'value' => '1200px', 'type' => 'string', 'group' => 'responsive'],
        ];

        foreach ($additionalSettings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                [
                    'value' => $setting['value'],
                    'type' => $setting['type'],
                    'group' => $setting['group'],
                    'options' => $setting['options'] ?? null,
                ]
            );
        }

        $this->command->info('Additional theme settings seeded successfully!');
    }
}