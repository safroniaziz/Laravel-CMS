<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\MenuItem;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        // Create Main Navigation Menu
        $mainMenu = Menu::create([
            'name' => 'Main Navigation',
            'location' => 'main',
            'is_active' => true,
        ]);

        // Create Menu Items
        $menuItems = [
            [
                'title' => 'Beranda',
                'url' => '/',
                'route' => 'home',
                'icon_class' => 'fas fa-home',
                'order' => 1,
            ],
            [
                'title' => 'Profil',
                'url' => '#',
                'icon_class' => 'fas fa-building',
                'order' => 2,
                'children' => [
                    [
                        'title' => 'Sejarah',
                        'url' => '/page/about',
                        'route' => 'page.show',
                        'parameters' => json_encode(['slug' => 'about']),
                        'order' => 1,
                    ],
                    [
                        'title' => 'Visi dan Misi',
                        'url' => '/page/visi-misi',
                        'route' => 'page.show',
                        'parameters' => json_encode(['slug' => 'visi-misi']),
                        'order' => 2,
                    ],
                    [
                        'title' => 'Tujuan',
                        'url' => '/page/tujuan',
                        'route' => 'page.show',
                        'parameters' => json_encode(['slug' => 'tujuan']),
                        'order' => 3,
                    ],
                    [
                        'title' => 'Dosen',
                        'url' => '/page/dosen',
                        'route' => 'page.show',
                        'parameters' => json_encode(['slug' => 'dosen']),
                        'order' => 4,
                    ],
                    [
                        'title' => 'Struktur Organisasi',
                        'url' => '/page/struktur',
                        'route' => 'page.show',
                        'parameters' => json_encode(['slug' => 'struktur']),
                        'order' => 5,
                    ],
                ]
            ],
            [
                'title' => 'Tri Dharma',
                'url' => '/services',
                'route' => 'services.index',
                'icon_class' => 'fas fa-graduation-cap',
                'order' => 3,
            ],
            [
                'title' => 'Kemahasiswaan',
                'url' => '/portfolio',
                'route' => 'portfolio.index',
                'icon_class' => 'fas fa-users',
                'order' => 4,
            ],
            [
                'title' => 'Fasilitas',
                'url' => '/contact',
                'route' => 'contact.index',
                'icon_class' => 'fas fa-building',
                'order' => 5,
            ],
            [
                'title' => 'Unduh',
                'url' => '/blog',
                'route' => 'blog.index',
                'icon_class' => 'fas fa-download',
                'order' => 6,
            ],
        ];

        foreach ($menuItems as $itemData) {
            $children = $itemData['children'] ?? [];
            unset($itemData['children']);

            $menuItem = MenuItem::create([
                'menu_id' => $mainMenu->id,
                'title' => $itemData['title'],
                'url' => $itemData['url'],
                'route' => $itemData['route'] ?? null,
                'parameters' => $itemData['parameters'] ?? null,
                'icon_class' => $itemData['icon_class'] ?? null,
                'order' => $itemData['order'],
            ]);

            // Create children if exists
            foreach ($children as $childData) {
                MenuItem::create([
                    'menu_id' => $mainMenu->id,
                    'parent_id' => $menuItem->id,
                    'title' => $childData['title'],
                    'url' => $childData['url'],
                    'route' => $childData['route'] ?? null,
                    'parameters' => $childData['parameters'] ?? null,
                    'order' => $childData['order'],
                ]);
            }
        }

        // Create Footer Menu
        $footerMenu = Menu::create([
            'name' => 'Footer Menu',
            'location' => 'footer',
            'is_active' => true,
        ]);

        $footerItems = [
            [
                'title' => 'Tentang Kami',
                'url' => '/page/about',
                'route' => 'page.show',
                'parameters' => json_encode(['slug' => 'about']),
                'order' => 1,
            ],
            [
                'title' => 'Kontak',
                'url' => '/contact',
                'route' => 'contact.index',
                'order' => 2,
            ],
            [
                'title' => 'Privacy Policy',
                'url' => '/page/privacy',
                'route' => 'page.show',
                'parameters' => json_encode(['slug' => 'privacy']),
                'order' => 3,
            ],
        ];

        foreach ($footerItems as $itemData) {
            MenuItem::create([
                'menu_id' => $footerMenu->id,
                'title' => $itemData['title'],
                'url' => $itemData['url'],
                'route' => $itemData['route'] ?? null,
                'parameters' => $itemData['parameters'] ?? null,
                'order' => $itemData['order'],
            ]);
        }

        $this->command->info('Menu seeded successfully!');
        $this->command->info('Created menus: Main Navigation, Footer Menu');
    }
}
