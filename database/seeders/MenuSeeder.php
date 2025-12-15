<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\MenuItem;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        // Disable foreign key checks to allow truncate
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Clear existing menus
        MenuItem::truncate();
        Menu::truncate();
        
        // Re-enable foreign key checks
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        // Create Main Navigation Menu (location: 'main' to match frontend.blade.php query)
        $headerMenu = Menu::create([
            'name' => 'Main Navigation',
            'location' => 'main',
            'is_active' => true,
        ]);

        // Create Menu Items based on actual campus menu structure
        $menuItems = [
            [
                'title' => 'Beranda',
                'url' => '/',
                'target' => '_self',
                'order' => 1,
            ],
            [
                'title' => 'Profil',
                'url' => '/profil',
                'target' => '_self',
                'order' => 2,
            ],
            [
                'title' => 'Tri Dharma',
                'url' => '/tri-dharma',
                'target' => '_self',
                'order' => 3,
            ],
            [
                'title' => 'Kemahasiswaan',
                'url' => '/kemahasiswaan',
                'target' => '_self',
                'order' => 4,
            ],
            [
                'title' => 'Fasilitas',
                'url' => '/fasilitas',
                'target' => '_self',
                'order' => 5,
            ],
            [
                'title' => 'Unduh',
                'url' => '/unduh',
                'target' => '_self',
                'order' => 6,
            ],
        ];

        foreach ($menuItems as $itemData) {
            $menuItem = MenuItem::create([
                'menu_id' => $headerMenu->id,
                'title' => $itemData['title'],
                'url' => $itemData['url'],
                'target' => $itemData['target'],
                'icon_class' => $itemData['icon_class'] ?? null,
                'order' => $itemData['order'],
            ]);
            
            // Add submenu for "Profil"
            if ($itemData['title'] === 'Profil') {
                MenuItem::create([
                    'menu_id' => $headerMenu->id,
                    'parent_id' => $menuItem->id,
                    'title' => 'Sejarah',
                    'url' => '/profil/sejarah',
                    'target' => '_self',
                    'order' => 1,
                ]);
                MenuItem::create([
                    'menu_id' => $headerMenu->id,
                    'parent_id' => $menuItem->id,
                    'title' => 'Visi dan Misi',
                    'url' => '/profil/visi-misi',
                    'target' => '_self',
                    'order' => 2,
                ]);
                MenuItem::create([
                    'menu_id' => $headerMenu->id,
                    'parent_id' => $menuItem->id,
                    'title' => 'Tujuan',
                    'url' => '/profil/tujuan',
                    'target' => '_self',
                    'order' => 3,
                ]);
                MenuItem::create([
                    'menu_id' => $headerMenu->id,
                    'parent_id' => $menuItem->id,
                    'title' => 'Dosen',
                    'url' => '/profil/dosen',
                    'target' => '_self',
                    'order' => 4,
                ]);
                MenuItem::create([
                    'menu_id' => $headerMenu->id,
                    'parent_id' => $menuItem->id,
                    'title' => 'Struktur Organisasi',
                    'url' => '/profil/struktur-organisasi',
                    'target' => '_self',
                    'order' => 5,
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
