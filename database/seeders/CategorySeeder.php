<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Berita', 'slug' => 'berita'],
            ['name' => 'Prestasi', 'slug' => 'prestasi'],
            ['name' => 'Akademik', 'slug' => 'akademik'],
            ['name' => 'Penelitian', 'slug' => 'penelitian'],
            ['name' => 'Kegiatan', 'slug' => 'kegiatan'],
            ['name' => 'Pengumuman', 'slug' => 'pengumuman'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['slug' => $category['slug']],
                ['name' => $category['name']]
            );
        }
    }
}
