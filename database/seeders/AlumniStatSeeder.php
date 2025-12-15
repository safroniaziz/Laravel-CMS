<?php

namespace Database\Seeders;

use App\Models\AlumniStat;
use Illuminate\Database\Seeder;

class AlumniStatSeeder extends Seeder
{
    public function run(): void
    {
        $stats = [
            [
                'order' => 1,
                'icon' => 'fa-users',
                'number' => '500+',
                'label' => 'Alumni Aktif',
                'active' => true,
            ],
            [
                'order' => 2,
                'icon' => 'fa-briefcase',
                'number' => '95%',
                'label' => 'Terserap Kerja',
                'active' => true,
            ],
            [
                'order' => 3,
                'icon' => 'fa-building',
                'number' => '50+',
                'label' => 'Perusahaan Mitra',
                'active' => true,
            ],
            [
                'order' => 4,
                'icon' => 'fa-chart-line',
                'number' => '4.5',
                'label' => 'Rata-rata IPK',
                'active' => true,
            ],
        ];

        foreach ($stats as $stat) {
            AlumniStat::updateOrCreate(
                ['label' => $stat['label']],
                $stat
            );
        }
    }
}
