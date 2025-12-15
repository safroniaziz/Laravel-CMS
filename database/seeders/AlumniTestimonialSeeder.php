<?php

namespace Database\Seeders;

use App\Models\AlumniTestimonial;
use Illuminate\Database\Seeder;

class AlumniTestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'order' => 1,
                'name' => 'Bagus Satria, S.Kom.',
                'graduation_year' => '2020',
                'position' => 'Branch Supervisor',
                'company' => 'Biznet',
                'testimonial' => 'Fasilitas lengkap sangat mendukung kegiatan akademik dan non-akademik, bahkan saya berkesempatan keluar negeri untuk program pertukaran pelajar.',
                'rating' => 5,
                'photo_url' => null,
                'linkedin_url' => null,
                'active' => true,
            ],
            [
                'order' => 2,
                'name' => 'Devi Anggraini Rahayu, S.Kom.',
                'graduation_year' => '2019',
                'position' => 'Admin Umum',
                'company' => 'PT. Batu Bara',
                'testimonial' => 'Pengalaman kuliah yang luar biasa! Dosen-dosen sangat kompeten dan selalu siap membantu mahasiswa berkembang.',
                'rating' => 5,
                'photo_url' => null,
                'linkedin_url' => null,
                'active' => true,
            ],
            [
                'order' => 3,
                'name' => 'Rizky Ananda, S.Kom.',
                'graduation_year' => '2021',
                'position' => 'Software Engineer',
                'company' => 'Tokopedia',
                'testimonial' => 'Kurikulum yang up-to-date dengan kebutuhan industri membuat saya siap terjun ke dunia kerja. Terima kasih SI UNIB!',
                'rating' => 5,
                'photo_url' => null,
                'linkedin_url' => null,
                'active' => true,
            ],
            [
                'order' => 4,
                'name' => 'Putri Maharani, S.Kom.',
                'graduation_year' => '2020',
                'position' => 'Data Analyst',
                'company' => 'Gojek',
                'testimonial' => 'Pembelajaran yang praktikal dan project-based sangat membantu dalam mengasah skill teknis. Alumni SI UNIB sangat kompetitif!',
                'rating' => 5,
                'photo_url' => null,
                'linkedin_url' => null,
                'active' => true,
            ],
            [
                'order' => 5,
                'name' => 'Ahmad Fauzi, S.Kom.',
                'graduation_year' => '2018',
                'position' => 'IT Manager',
                'company' => 'Bank Mandiri',
                'testimonial' => 'Networking dengan alumni yang kuat membuka banyak peluang karir. Bangga menjadi bagian dari keluarga besar SI UNIB!',
                'rating' => 5,
                'photo_url' => null,
                'linkedin_url' => null,
                'active' => true,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            AlumniTestimonial::updateOrCreate(
                ['name' => $testimonial['name']],
                $testimonial
            );
        }
    }
}
