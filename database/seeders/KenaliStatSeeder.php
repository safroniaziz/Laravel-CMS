<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KenaliStat;

class KenaliStatSeeder extends Seeder
{
    public function run(): void
    {
        $stats = [
            [
                'order' => 1,
                'icon' => 'fa-users',
                'number' => '150+',
                'label' => 'Alumni Sukses',
                'active' => true,
            ],
            [
                'order' => 2,
                'icon' => 'fa-briefcase',
                'number' => '95+',
                'label' => 'Job Placement (%)',
                'active' => true,
            ],
            [
                'order' => 3,
                'icon' => 'fa-handshake',
                'number' => '20+',
                'label' => 'Partner Industri',
                'active' => true,
            ],
            [
                'order' => 4,
                'icon' => 'fa-certificate',
                'number' => 'A',
                'label' => 'Akreditasi',
                'active' => true,
            ],
        ];

        foreach ($stats as $stat) {
            KenaliStat::updateOrCreate(
                ['label' => $stat['label']],
                $stat
            );
        }
    }
}
