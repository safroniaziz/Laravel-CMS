<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            ['name' => 'Akademik', 'slug' => 'akademik'],
            ['name' => 'Penelitian', 'slug' => 'penelitian'],
            ['name' => 'Pengabdian', 'slug' => 'pengabdian'],
            ['name' => 'Seminar', 'slug' => 'seminar'],
            ['name' => 'Workshop', 'slug' => 'workshop'],
            ['name' => 'Kompetisi', 'slug' => 'kompetisi'],
            ['name' => 'Prestasi', 'slug' => 'prestasi'],
            ['name' => 'Mahasiswa', 'slug' => 'mahasiswa'],
            ['name' => 'Dosen', 'slug' => 'dosen'],
            ['name' => 'Alumni', 'slug' => 'alumni'],
            ['name' => 'Teknologi', 'slug' => 'teknologi'],
            ['name' => 'Informatika', 'slug' => 'informatika'],
            ['name' => 'Sistem Informasi', 'slug' => 'sistem-informasi'],
            ['name' => 'Web Development', 'slug' => 'web-development'],
            ['name' => 'Mobile Apps', 'slug' => 'mobile-apps'],
            ['name' => 'Data Science', 'slug' => 'data-science'],
            ['name' => 'AI & Machine Learning', 'slug' => 'ai-machine-learning'],
            ['name' => 'Cyber Security', 'slug' => 'cyber-security'],
            ['name' => 'Cloud Computing', 'slug' => 'cloud-computing'],
            ['name' => 'IoT', 'slug' => 'iot'],
            ['name' => 'Beasiswa', 'slug' => 'beasiswa'],
            ['name' => 'Wisuda', 'slug' => 'wisuda'],
            ['name' => 'KKN', 'slug' => 'kkn'],
            ['name' => 'PKL', 'slug' => 'pkl'],
            ['name' => 'Kerja Praktik', 'slug' => 'kerja-praktik'],
        ];

        foreach ($tags as $tag) {
            Tag::firstOrCreate(
                ['slug' => $tag['slug']],
                $tag
            );
        }

        $this->command->info('Tags seeded successfully with ' . count($tags) . ' items!');
    }
}
