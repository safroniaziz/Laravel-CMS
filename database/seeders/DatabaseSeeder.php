<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class,
            DefaultUserSeeder::class,
            LanguageSeeder::class,
            SettingSeeder::class,
            AdditionalThemeSettingsSeeder::class, // Dynamic UI settings
            CompleteHardcodeFixSeeder::class, // Complete color settings
            CategorySeeder::class,
            MediaSeeder::class, // Sample media images
            TagSeeder::class, // Tags for posts
            PostSeeder::class, // UNIB blog posts with rich content
            PageSeeder::class, // Static pages
            SliderSeeder::class,
            KenaliSettingSeeder::class,
            KenaliInfoSeeder::class, // Kenali Lebih Dekat info items
            KenaliStatSeeder::class, // Kenali Lebih Dekat stats
            AlumniSettingSeeder::class, // Ikatan Alumni settings
            AlumniStatSeeder::class, // Ikatan Alumni stats
            AlumniTestimonialSeeder::class, // Ikatan Alumni testimonials
            TeacherSeeder::class,
            TeacherSettingSeeder::class, // Teacher page settings
            MenuSeeder::class, // Dynamic menu system
            InfoCardSettingSeeder::class, // Info Card settings
            CTASettingSeeder::class, // CTA section settings
            FooterSettingSeeder::class, // Dynamic footer settings with footer_show
            VideoSettingsSeeder::class, // Dynamic video settings
            GallerySeeder::class, // Gallery items
            BlogSettingSeeder::class, // Blog dynamic settings
        ]);
    }
}
