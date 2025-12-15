<?php

namespace Database\Seeders;

use App\Models\BlogSetting;
use Illuminate\Database\Seeder;

class BlogSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // Layout Settings
            ['key' => 'blog_layout_style', 'value' => 'grid', 'type' => 'text', 'group' => 'layout'],
            ['key' => 'blog_posts_per_page', 'value' => '9', 'type' => 'number', 'group' => 'layout'],
            ['key' => 'blog_sidebar_enabled', 'value' => '1', 'type' => 'boolean', 'group' => 'layout'],

            // Hero Section Settings
            ['key' => 'blog_hero_enabled', 'value' => '1', 'type' => 'boolean', 'group' => 'hero'],
            ['key' => 'blog_hero_gradient_start', 'value' => '#1e3a8a', 'type' => 'color', 'group' => 'hero'],
            ['key' => 'blog_hero_gradient_end', 'value' => '#60a5fa', 'type' => 'color', 'group' => 'hero'],
            ['key' => 'blog_hero_badge_enabled', 'value' => '1', 'type' => 'boolean', 'group' => 'hero'],
            ['key' => 'blog_hero_badge_text', 'value' => 'BERITA & ARTIKEL', 'type' => 'text', 'group' => 'hero'],
            ['key' => 'blog_hero_badge_icon', 'value' => 'fa-newspaper', 'type' => 'text', 'group' => 'hero'],
            ['key' => 'blog_hero_title', 'value' => 'Informasi Terkini', 'type' => 'text', 'group' => 'hero'],
            ['key' => 'blog_hero_subtitle', 'value' => 'Dapatkan berita terbaru, artikel menarik, dan update penting dari kami', 'type' => 'text', 'group' => 'hero'],

            // Card Styling Settings
            ['key' => 'blog_card_primary_color', 'value' => '#3b82f6', 'type' => 'color', 'group' => 'cards'],
            ['key' => 'blog_card_accent_color', 'value' => '#f59e0b', 'type' => 'color', 'group' => 'cards'],
            ['key' => 'blog_card_bg_color', 'value' => '#ffffff', 'type' => 'color', 'group' => 'cards'],
            ['key' => 'blog_card_border_radius', 'value' => '16', 'type' => 'number', 'group' => 'cards'],
            ['key' => 'blog_card_shadow', 'value' => '0 4px 20px rgba(0,0,0,0.06)', 'type' => 'text', 'group' => 'cards'],
            ['key' => 'blog_card_hover_shadow', 'value' => '0 12px 35px rgba(0,0,0,0.12)', 'type' => 'text', 'group' => 'cards'],

            // Sidebar Settings
            ['key' => 'blog_sidebar_bg_color', 'value' => '#ffffff', 'type' => 'color', 'group' => 'sidebar'],
            ['key' => 'blog_sidebar_border_color', 'value' => '#e5e7eb', 'type' => 'color', 'group' => 'sidebar'],
            ['key' => 'blog_sidebar_accent_color', 'value' => '#3b82f6', 'type' => 'color', 'group' => 'sidebar'],
            ['key' => 'blog_sidebar_popular_bg_start', 'value' => '#fef3c7', 'type' => 'color', 'group' => 'sidebar'],
            ['key' => 'blog_sidebar_popular_bg_end', 'value' => '#fde68a', 'type' => 'color', 'group' => 'sidebar'],

            // Typography Settings
            ['key' => 'blog_heading_font_family', 'value' => 'inherit', 'type' => 'text', 'group' => 'typography'],
            ['key' => 'blog_body_font_family', 'value' => 'inherit', 'type' => 'text', 'group' => 'typography'],
            ['key' => 'blog_card_title_size', 'value' => '20', 'type' => 'number', 'group' => 'typography'],
            ['key' => 'blog_card_title_color', 'value' => '#1e293b', 'type' => 'color', 'group' => 'typography'],
            ['key' => 'blog_card_excerpt_color', 'value' => '#64748b', 'type' => 'color', 'group' => 'typography'],

            // Pagination Settings
            ['key' => 'blog_pagination_active_bg', 'value' => 'linear-gradient(135deg, #3b82f6, #2563eb)', 'type' => 'text', 'group' => 'pagination'],
            ['key' => 'blog_pagination_hover_bg', 'value' => 'linear-gradient(135deg, #3b82f6, #2563eb)', 'type' => 'text', 'group' => 'pagination'],
            ['key' => 'blog_pagination_border_radius', 'value' => '10', 'type' => 'number', 'group' => 'pagination'],

            // General Settings (Blog Index)
            ['key' => 'blog_bg_color', 'value' => 'linear-gradient(180deg, #f8fafc 0%, #fff 100%)', 'type' => 'text', 'group' => 'general'],
            ['key' => 'blog_show_sidebar', 'value' => '1', 'type' => 'boolean', 'group' => 'general'],
            
            // ===== BLOG DETAIL PAGE SETTINGS =====
            
            // Detail Layout Style
            ['key' => 'blog_detail_layout_style', 'value' => 'modern', 'type' => 'select', 'group' => 'detail_general'],
            
            // Detail Hero Section
            ['key' => 'blog_detail_hero_gradient_start', 'value' => '#0f172a', 'type' => 'color', 'group' => 'detail_hero'],
            ['key' => 'blog_detail_hero_gradient_middle', 'value' => '#1e293b', 'type' => 'color', 'group' => 'detail_hero'],
            ['key' => 'blog_detail_hero_gradient_end', 'value' => '#334155', 'type' => 'color', 'group' => 'detail_hero'],
            ['key' => 'blog_detail_hero_text_color', 'value' => '#ffffff', 'type' => 'color', 'group' => 'detail_hero'],
            ['key' => 'blog_detail_hero_meta_color', 'value' => 'rgba(255,255,255,0.7)', 'type' => 'color', 'group' => 'detail_hero'],
            
            // Detail Content Styling
            ['key' => 'blog_detail_content_h2_size', 'value' => '32', 'type' => 'number', 'group' => 'detail_content'],
            ['key' => 'blog_detail_content_h2_color', 'value' => '#1e293b', 'type' => 'color', 'group' => 'detail_content'],
            ['key' => 'blog_detail_content_h2_border_color', 'value' => '#3b82f6', 'type' => 'color', 'group' => 'detail_content'],
            ['key' => 'blog_detail_content_h3_size', 'value' => '24', 'type' => 'number', 'group' => 'detail_content'],
            ['key' => 'blog_detail_content_h3_color', 'value' => '#1e293b', 'type' => 'color', 'group' => 'detail_content'],
            ['key' => 'blog_detail_content_text_color', 'value' => '#334155', 'type' => 'color', 'group' => 'detail_content'],
            ['key' => 'blog_detail_content_link_color', 'value' => '#3b82f6', 'type' => 'color', 'group' => 'detail_content'],
            
            // Blockquote Styling
            ['key' => 'blog_detail_blockquote_bg_start', 'value' => '#eff6ff', 'type' => 'color', 'group' => 'detail_content'],
            ['key' => 'blog_detail_blockquote_bg_end', 'value' => '#dbeafe', 'type' => 'color', 'group' => 'detail_content'],
            ['key' => 'blog_detail_blockquote_border_color', 'value' => '#3b82f6', 'type' => 'color', 'group' => 'detail_content'],
            ['key' => 'blog_detail_blockquote_text_color', 'value' => '#1e40af', 'type' => 'color', 'group' => 'detail_content'],
            
            // Code Block Styling
            ['key' => 'blog_detail_code_bg', 'value' => '#f1f5f9', 'type' => 'color', 'group' => 'detail_content'],
            ['key' => 'blog_detail_code_text_color', 'value' => '#ec4899', 'type' => 'color', 'group' => 'detail_content'],
            ['key' => 'blog_detail_code_block_bg', 'value' => '#1e293b', 'type' => 'color', 'group' => 'detail_content'],
            ['key' => 'blog_detail_code_block_text_color', 'value' => '#60a5fa', 'type' => 'color', 'group' => 'detail_content'],
            
            // Detail Author Card
            ['key' => 'blog_detail_author_gradient_start', 'value' => '#fef3c7', 'type' => 'color', 'group' => 'detail_author'],
            ['key' => 'blog_detail_author_gradient_end', 'value' => '#fde68a', 'type' => 'color', 'group' => 'detail_author'],
            ['key' => 'blog_detail_author_text_color', 'value' => '#92400e', 'type' => 'color', 'group' => 'detail_author'],
            ['key' => 'blog_detail_author_avatar_gradient_start', 'value' => '#f59e0b', 'type' => 'color', 'group' => 'detail_author'],
            ['key' => 'blog_detail_author_avatar_gradient_end', 'value' => '#fbbf24', 'type' => 'color', 'group' => 'detail_author'],
            
            // Detail Social Share
            ['key' => 'blog_detail_share_bg_start', 'value' => '#eff6ff', 'type' => 'color', 'group' => 'detail_social'],
            ['key' => 'blog_detail_share_bg_end', 'value' => '#dbeafe', 'type' => 'color', 'group' => 'detail_social'],
            ['key' => 'blog_detail_share_border_color', 'value' => '#bfdbfe', 'type' => 'color', 'group' => 'detail_social'],
        ];

        foreach ($settings as $setting) {
            BlogSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
