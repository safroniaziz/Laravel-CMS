<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::published()->with('category', 'author', 'tags');

        // Filter by category
        if ($request->filled('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Filter by tag
        if ($request->filled('tag')) {
            $query->whereHas('tags', function($q) use ($request) {
                $q->where('slug', $request->tag);
            });
        }

        // Search
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%')
                  ->orWhere('excerpt', 'like', '%' . $request->search . '%');
            });
        }

        // Get posts per page from settings
        $perPage = \App\Models\BlogSetting::get('blog_posts_per_page', 9);
        $posts = $query->latest('published_at')->paginate($perPage);
        
        $categories = Category::withCount('posts')->get();
        $popularPosts = Post::published()->orderBy('views', 'desc')->take(5)->get();
        $tags = Tag::withCount('posts')->orderBy('posts_count', 'desc')->take(10)->get();
        
        // Load blog settings
        $blogSettings = [
            'layout' => \App\Models\BlogSetting::get('blog_layout_style', 'grid'),
            'sidebar_enabled' => \App\Models\BlogSetting::get('blog_sidebar_enabled', '1') === '1',
            'hero' => [
                'enabled' => \App\Models\BlogSetting::get('blog_hero_enabled', '1') === '1',
                'gradient_start' => \App\Models\BlogSetting::get('blog_hero_gradient_start', '#1e3a8a'),
                'gradient_end' => \App\Models\BlogSetting::get('blog_hero_gradient_end', '#60a5fa'),
                'badge_enabled' => \App\Models\BlogSetting::get('blog_hero_badge_enabled', '1') === '1',
                'badge_text' => \App\Models\BlogSetting::get('blog_hero_badge_text', 'BERITA & ARTIKEL'),
                'badge_icon' => \App\Models\BlogSetting::get('blog_hero_badge_icon', 'fa-newspaper'),
                'title' => \App\Models\BlogSetting::get('blog_hero_title', 'Informasi Terkini'),
                'subtitle' => \App\Models\BlogSetting::get('blog_hero_subtitle', 'Dapatkan berita terbaru, artikel menarik, dan update penting dari kami'),
            ],
            'cards' => [
                'primary_color' => \App\Models\BlogSetting::get('blog_card_primary_color', '#3b82f6'),
                'accent_color' => \App\Models\BlogSetting::get('blog_card_accent_color', '#f59e0b'),
                'bg_color' => \App\Models\BlogSetting::get('blog_card_bg_color', '#ffffff'),
                'border_radius' => \App\Models\BlogSetting::get('blog_card_border_radius', '16'),
                'shadow' => \App\Models\BlogSetting::get('blog_card_shadow', '0 4px 20px rgba(0,0,0,0.06)'),
                'hover_shadow' => \App\Models\BlogSetting::get('blog_card_hover_shadow', '0 12px 35px rgba(0,0,0,0.12)'),
            ],
            'sidebar' => [
                'bg_color' => \App\Models\BlogSetting::get('blog_sidebar_bg_color', '#ffffff'),
                'border_color' => \App\Models\BlogSetting::get('blog_sidebar_border_color', 'rgba(0,0,0,0.05)'),
                'accent_color' => \App\Models\BlogSetting::get('blog_sidebar_accent_color', '#3b82f6'),
                'popular_bg_start' => \App\Models\BlogSetting::get('blog_sidebar_popular_bg_start', '#fef3c7'),
                'popular_bg_end' => \App\Models\BlogSetting::get('blog_sidebar_popular_bg_end', '#fde68a'),
            ],
            'typography' => [
                'card_title_size' => \App\Models\BlogSetting::get('blog_card_title_size', '20'),
                'card_title_color' => \App\Models\BlogSetting::get('blog_card_title_color', '#1e293b'),
                'card_excerpt_color' => \App\Models\BlogSetting::get('blog_card_excerpt_color', '#64748b'),
            ],
            'pagination' => [
                'active_bg' => \App\Models\BlogSetting::get('blog_pagination_active_bg', 'linear-gradient(135deg, #3b82f6, #2563eb)'),
                'hover_bg' => \App\Models\BlogSetting::get('blog_pagination_hover_bg', 'linear-gradient(135deg, #3b82f6, #2563eb)'),
                'border_radius' => \App\Models\BlogSetting::get('blog_pagination_border_radius', '10'),
            ],
            'bg_color' => \App\Models\BlogSetting::get('blog_bg_color', 'linear-gradient(180deg, #f8fafc 0%, #fff 100%)'),
            'show_sidebar' => \App\Models\BlogSetting::get('blog_show_sidebar', '1') === '1',
        ];

        // Determine layout view path
        $layout = $blogSettings['layout'];
        $layoutView = 'frontend.blog.layouts.' . $layout;

        return view('frontend.blog.index', compact('posts', 'categories', 'popularPosts', 'tags', 'blogSettings', 'layoutView'));
    }

    public function show($slug)
    {
        $post = Post::published()->where('slug', $slug)->with('category', 'author', 'tags')->firstOrFail();

        // Increment views
        $post->incrementViews();

        // Related posts
        $relatedPosts = Post::published()
            ->where('id', '!=', $post->id)
            ->where('category_id', $post->category_id)
            ->take(3)
            ->get();

        $categories = Category::withCount('posts')->get();
        $popularPosts = Post::published()->orderBy('views', 'desc')->take(5)->get();

        // Load detail page settings
        $detailSettings = [
            'hero' => [
                'gradient_start' => \App\Models\BlogSetting::get('blog_detail_hero_gradient_start', '#0f172a'),
                'gradient_middle' => \App\Models\BlogSetting::get('blog_detail_hero_gradient_middle', '#1e293b'),
                'gradient_end' => \App\Models\BlogSetting::get('blog_detail_hero_gradient_end', '#334155'),
                'text_color' => \App\Models\BlogSetting::get('blog_detail_hero_text_color', '#ffffff'),
                'meta_color' => \App\Models\BlogSetting::get('blog_detail_hero_meta_color', 'rgba(255,255,255,0.7)'),
            ],
            'content' => [
                'h2_size' => \App\Models\BlogSetting::get('blog_detail_content_h2_size', '32'),
                'h2_color' => \App\Models\BlogSetting::get('blog_detail_content_h2_color', '#1e293b'),
                'h2_border_color' => \App\Models\BlogSetting::get('blog_detail_content_h2_border_color', '#3b82f6'),
                'h3_size' => \App\Models\BlogSetting::get('blog_detail_content_h3_size', '24'),
                'h3_color' => \App\Models\BlogSetting::get('blog_detail_content_h3_color', '#1e293b'),
                'text_color' => \App\Models\BlogSetting::get('blog_detail_content_text_color', '#334155'),
                'link_color' => \App\Models\BlogSetting::get('blog_detail_content_link_color', '#3b82f6'),
            ],
            'blockquote' => [
                'bg_start' => \App\Models\BlogSetting::get('blog_detail_blockquote_bg_start', '#eff6ff'),
                'bg_end' => \App\Models\BlogSetting::get('blog_detail_blockquote_bg_end', '#dbeafe'),
                'border_color' => \App\Models\BlogSetting::get('blog_detail_blockquote_border_color', '#3b82f6'),
                'text_color' => \App\Models\BlogSetting::get('blog_detail_blockquote_text_color', '#1e40af'),
            ],
            'code' => [
                'bg' => \App\Models\BlogSetting::get('blog_detail_code_bg', '#f1f5f9'),
                'text_color' => \App\Models\BlogSetting::get('blog_detail_code_text_color', '#ec4899'),
                'block_bg' => \App\Models\BlogSetting::get('blog_detail_code_block_bg', '#1e293b'),
                'block_text_color' => \App\Models\BlogSetting::get('blog_detail_code_block_text_color', '#60a5fa'),
            ],
            'author' => [
                'gradient_start' => \App\Models\BlogSetting::get('blog_detail_author_gradient_start', '#fef3c7'),
                'gradient_end' => \App\Models\BlogSetting::get('blog_detail_author_gradient_end', '#fde68a'),
                'text_color' => \App\Models\BlogSetting::get('blog_detail_author_text_color', '#92400e'),
                'avatar_gradient_start' => \App\Models\BlogSetting::get('blog_detail_author_avatar_gradient_start', '#f59e0b'),
                'avatar_gradient_end' => \App\Models\BlogSetting::get('blog_detail_author_avatar_gradient_end', '#fbbf24'),
            ],
            'social' => [
                'bg_start' => \App\Models\BlogSetting::get('blog_detail_share_bg_start', '#eff6ff'),
                'bg_end' => \App\Models\BlogSetting::get('blog_detail_share_bg_end', '#dbeafe'),
                'border_color' => \App\Models\BlogSetting::get('blog_detail_share_border_color', '#bfdbfe'),
            ],
        ];

        return view('frontend.blog.show', compact('post', 'relatedPosts', 'categories', 'popularPosts', 'detailSettings'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $posts = Post::published()
            ->where('category_id', $category->id)
            ->with('author', 'tags')
            ->latest('published_at')
            ->paginate(12);

        $categories = Category::withCount('posts')->get();
        $popularPosts = Post::published()->orderBy('views', 'desc')->take(5)->get();

        return view('frontend.blog.category', compact('category', 'posts', 'categories', 'popularPosts'));
    }

    public function tag($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();
        $posts = $tag->posts()
            ->published()
            ->with('category', 'author')
            ->latest('published_at')
            ->paginate(12);

        $categories = Category::withCount('posts')->get();
        $popularPosts = Post::published()->orderBy('views', 'desc')->take(5)->get();

        return view('frontend.blog.tag', compact('tag', 'posts', 'categories', 'popularPosts'));
    }
}

