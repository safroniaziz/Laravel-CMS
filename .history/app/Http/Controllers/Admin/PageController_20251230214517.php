<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $query = Page::with('user', 'template');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }

        $pages = $query->latest()->paginate(15);

        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        $templates = PageTemplate::all();
        return view('admin.pages.create', compact('templates'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'nullable|unique:pages,slug',
            'layout' => 'nullable|in:modern,classic,bold,elegant,default,hero,split,cards,centered',
            'bg_color' => 'nullable|string|max:20',
            'text_color' => 'nullable|string|max:20',
            'accent_color' => 'nullable|string|max:20',
            'status' => 'required|in:draft,published',
            'meta_title' => 'nullable|max:255',
            'meta_description' => 'nullable',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $validated['user_id'] = Auth::id();

        if ($validated['status'] === 'published') {
            $validated['published_at'] = now();
        }

        // Process sections data
        $sections = $request->input('sections', []);
        $processedSections = $this->processSections($sections, $request);
        $validated['page_builder_data'] = $processedSections;

        $page = Page::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Halaman berhasil dibuat',
            'redirect' => route('pages.edit', $page)
        ]);
    }

    public function edit(Page $page)
    {
        $templates = PageTemplate::all();
        return view('admin.pages.edit', compact('page', 'templates'));
    }

    public function update(Request $request, Page $page)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'nullable|unique:pages,slug,' . $page->id,
            'layout' => 'nullable|in:modern,classic,bold,elegant,default,hero,split,cards,centered',
            'bg_color' => 'nullable|string|max:20',
            'text_color' => 'nullable|string|max:20',
            'accent_color' => 'nullable|string|max:20',
            'status' => 'required|in:draft,published',
            'meta_title' => 'nullable|max:255',
            'meta_description' => 'nullable',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($validated['status'] === 'published' && empty($page->published_at)) {
            $validated['published_at'] = now();
        }

        // Process sections data
        $sections = $request->input('sections', []);
        $processedSections = $this->processSections($sections, $request, $page->page_builder_data ?? []);
        $validated['page_builder_data'] = $processedSections;

        $page->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Halaman berhasil diperbarui',
            'redirect' => route('pages.edit', $page)
        ]);
    }

    public function destroy(Page $page)
    {
        // Delete associated images
        if ($page->page_builder_data) {
            $this->deleteOldImages($page->page_builder_data);
        }

        $page->delete();

        return response()->json([
            'success' => true,
            'message' => 'Halaman berhasil dihapus'
        ]);
    }

    /**
     * Process sections data and handle file uploads
     */
    private function processSections(array $sections, Request $request, array $oldSections = []): array
    {
        $processedSections = [];

        foreach ($sections as $sectionKey => $sectionData) {
            if (!is_array($sectionData)) continue;

            $processedSection = $sectionData;

            // Handle hero section
            if ($sectionKey === 'hero') {
                if ($request->hasFile("sections.hero.bg_image")) {
                    // Delete old image if exists
                    if (!empty($oldSections['hero']['bg_image'])) {
                        Storage::disk('public')->delete($oldSections['hero']['bg_image']);
                    }
                    $processedSection['bg_image'] = $request->file("sections.hero.bg_image")->store('pages/hero', 'public');
                } elseif (!empty($oldSections['hero']['bg_image'])) {
                    $processedSection['bg_image'] = $oldSections['hero']['bg_image'];
                }
            }

            // Handle about section
            if ($sectionKey === 'about') {
                if ($request->hasFile("sections.about.image")) {
                    if (!empty($oldSections['about']['image'])) {
                        Storage::disk('public')->delete($oldSections['about']['image']);
                    }
                    $processedSection['image'] = $request->file("sections.about.image")->store('pages/about', 'public');
                } elseif (!empty($oldSections['about']['image'])) {
                    $processedSection['image'] = $oldSections['about']['image'];
                }
            }

            // Handle gallery section
            if ($sectionKey === 'gallery' && $request->hasFile("sections.gallery.images")) {
                $galleryImages = [];
                foreach ($request->file("sections.gallery.images") as $image) {
                    $galleryImages[] = $image->store('pages/gallery', 'public');
                }
                // Keep old images if any
                if (!empty($oldSections['gallery']['images'])) {
                    $processedSection['images'] = array_merge($oldSections['gallery']['images'], $galleryImages);
                } else {
                    $processedSection['images'] = $galleryImages;
                }
            } elseif (!empty($oldSections['gallery']['images'])) {
                $processedSection['images'] = $oldSections['gallery']['images'];
            }

            // Handle team section items
            if ($sectionKey === 'team' && !empty($sectionData['items'])) {
                foreach ($sectionData['items'] as $itemKey => $item) {
                    if ($request->hasFile("sections.team.items.{$itemKey}.photo")) {
                        $processedSection['items'][$itemKey]['photo'] = $request->file("sections.team.items.{$itemKey}.photo")->store('pages/team', 'public');
                    } elseif (!empty($oldSections['team']['items'][$itemKey]['photo'])) {
                        $processedSection['items'][$itemKey]['photo'] = $oldSections['team']['items'][$itemKey]['photo'];
                    }
                }
            }

            // Handle testimonials section items
            if ($sectionKey === 'testimonials' && !empty($sectionData['items'])) {
                foreach ($sectionData['items'] as $itemKey => $item) {
                    if ($request->hasFile("sections.testimonials.items.{$itemKey}.photo")) {
                        $processedSection['items'][$itemKey]['photo'] = $request->file("sections.testimonials.items.{$itemKey}.photo")->store('pages/testimonials', 'public');
                    } elseif (!empty($oldSections['testimonials']['items'][$itemKey]['photo'])) {
                        $processedSection['items'][$itemKey]['photo'] = $oldSections['testimonials']['items'][$itemKey]['photo'];
                    }
                }
            }

            // Handle content blocks section
            if ($sectionKey === 'content' && !empty($sectionData['blocks'])) {
                foreach ($sectionData['blocks'] as $blockKey => $block) {
                    if ($request->hasFile("sections.content.blocks.{$blockKey}.image")) {
                        $processedSection['blocks'][$blockKey]['image'] = $request->file("sections.content.blocks.{$blockKey}.image")->store('pages/content', 'public');
                    } elseif (!empty($oldSections['content']['blocks'][$blockKey]['image'])) {
                        $processedSection['blocks'][$blockKey]['image'] = $oldSections['content']['blocks'][$blockKey]['image'];
                    }
                }
            }

            $processedSections[$sectionKey] = $processedSection;
        }

        return $processedSections;
    }

    /**
     * Delete old images from storage
     */
    private function deleteOldImages(array $sections): void
    {
        // Delete hero bg image
        if (!empty($sections['hero']['bg_image'])) {
            Storage::disk('public')->delete($sections['hero']['bg_image']);
        }

        // Delete about image
        if (!empty($sections['about']['image'])) {
            Storage::disk('public')->delete($sections['about']['image']);
        }

        // Delete gallery images
        if (!empty($sections['gallery']['images'])) {
            foreach ($sections['gallery']['images'] as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        // Delete team photos
        if (!empty($sections['team']['items'])) {
            foreach ($sections['team']['items'] as $item) {
                if (!empty($item['photo'])) {
                    Storage::disk('public')->delete($item['photo']);
                }
            }
        }

        // Delete testimonial photos
        if (!empty($sections['testimonials']['items'])) {
            foreach ($sections['testimonials']['items'] as $item) {
                if (!empty($item['photo'])) {
                    Storage::disk('public')->delete($item['photo']);
                }
            }
        }

        // Delete content block images
        if (!empty($sections['content']['blocks'])) {
            foreach ($sections['content']['blocks'] as $block) {
                if (!empty($block['image'])) {
                    Storage::disk('public')->delete($block['image']);
                }
            }
        }
    }
}
