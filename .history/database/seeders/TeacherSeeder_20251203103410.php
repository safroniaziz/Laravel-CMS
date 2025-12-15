<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Teacher;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teachers = [
            [
                'name' => 'Dr. Yudi Setiawan, S.T., M.Eng.',
                'role' => 'kaprodi',
                'title' => 'Kepala Program Studi Sistem Informasi',
                'expertise' => ['Software Engineering', 'AI'],
                'publications' => 45,
                'projects' => 12,
                'gradient' => 'linear-gradient(135deg, #1a246a, #151945)',
                'icon' => 'fa-user-tie',
                'badge_color' => '#fbbf24',
                'order' => 1,
            ],
            [
                'name' => 'Niska Ramadhani, M.Kom.',
                'role' => 'dosen',
                'title' => 'Dosen Sistem Informasi',
                'expertise' => ['Data Science', 'Machine Learning'],
                'publications' => 32,
                'projects' => 8,
                'gradient' => 'linear-gradient(135deg, #f59e0b, #d97706)',
                'icon' => 'fa-user-graduate',
                'badge_color' => null,
                'order' => 2,
            ],
            [
                'name' => 'Aan Erlanshari, S.T., M.Eng.',
                'role' => 'dosen',
                'title' => 'Dosen Sistem Informasi',
                'expertise' => ['Network Security', 'Cloud Computing'],
                'publications' => 28,
                'projects' => 10,
                'gradient' => 'linear-gradient(135deg, #1d4ed8, #151945)',
                'icon' => 'fa-user-cog',
                'badge_color' => null,
                'order' => 3,
            ],
            [
                'name' => 'Soni Ayi Purnama, M.Kom.',
                'role' => 'dosen',
                'title' => 'Dosen Sistem Informasi',
                'expertise' => ['Database', 'Business Intelligence'],
                'publications' => 24,
                'projects' => 6,
                'gradient' => 'linear-gradient(135deg, #059669, #047857)',
                'icon' => 'fa-user-check',
                'badge_color' => null,
                'order' => 4,
            ],
            [
                'name' => 'Yusran Panca Putra, M.Kom.',
                'role' => 'dosen',
                'title' => 'Dosen Sistem Informasi',
                'expertise' => ['Web Development', 'UI/UX'],
                'publications' => 20,
                'projects' => 14,
                'gradient' => 'linear-gradient(135deg, #ef4444, #dc2626)',
                'icon' => 'fa-user-edit',
                'badge_color' => null,
                'order' => 5,
            ],
            [
                'name' => 'Julia Purnama Sari, S.T., M.Kom.',
                'role' => 'dosen',
                'title' => 'Dosen Sistem Informasi',
                'expertise' => ['Cyber Security', 'Blockchain'],
                'publications' => 18,
                'projects' => 9,
                'gradient' => 'linear-gradient(135deg, #8b5cf6, #7c3aed)',
                'icon' => 'fa-user-shield',
                'badge_color' => null,
                'order' => 6,
            ],
            [
                'name' => 'Ahmad Taufik, S.Kom., M.T.',
                'role' => 'dosen',
                'title' => 'Dosen Sistem Informasi',
                'expertise' => ['Mobile Development', 'IoT'],
                'publications' => 16,
                'projects' => 11,
                'gradient' => 'linear-gradient(135deg, #06b6d4, #0891b2)',
                'icon' => 'fa-user-code',
                'badge_color' => null,
                'order' => 7,
            ],
            [
                'name' => 'Rina Wati, S.Kom., M.Kom.',
                'role' => 'dosen',
                'title' => 'Dosen Sistem Informasi',
                'expertise' => ['Data Mining', 'Big Data'],
                'publications' => 22,
                'projects' => 7,
                'gradient' => 'linear-gradient(135deg, #f97316, #ea580c)',
                'icon' => 'fa-user-tie',
                'badge_color' => null,
                'order' => 8,
            ],
        ];

        foreach ($teachers as $teacher) {
            Teacher::updateOrCreate(
                ['name' => $teacher['name']],
                $teacher
            );
        }
    }
}
