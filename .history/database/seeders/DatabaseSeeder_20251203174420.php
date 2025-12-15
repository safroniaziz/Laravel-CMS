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
            PostSeeder::class,
            UGMDummySeeder::class, // Add akademik posts
            SliderSeeder::class,
            KenaliSettingSeeder::class,
            TeacherSeeder::class,
            MenuSeeder::class, // Dynamic menu system
            FooterSettingsSeeder::class, // Dynamic footer settings
            VideoSettingsSeeder::class, // Dynamic video settings
        ]);
    }
}
