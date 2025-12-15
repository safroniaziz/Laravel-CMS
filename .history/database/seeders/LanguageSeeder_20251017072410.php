<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Language;

class LanguageSeeder extends Seeder
{
    public function run(): void
    {
        $languages = [
            [
                'name' => 'English',
                'code' => 'en',
                'locale' => 'en_US',
                'flag' => '🇬🇧',
                'is_default' => true,
                'is_active' => true,
                'direction' => 'ltr'
            ],
            [
                'name' => 'Indonesia',
                'code' => 'id',
                'locale' => 'id_ID',
                'flag' => '🇮🇩',
                'is_default' => false,
                'is_active' => true,
                'direction' => 'ltr'
            ],
        ];

        foreach ($languages as $language) {
            Language::firstOrCreate(
                ['code' => $language['code']],
                $language
            );
        }
    }
}

