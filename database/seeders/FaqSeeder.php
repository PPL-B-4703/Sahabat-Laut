<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'question' => 'Apa itu Sahabat Laut?',
                'Answer' => 'Sahabat Laut adalah platform digital yang memungkinkan masyarakat untuk melaporkan temuan biota laut yang dilindungi dan mendapatkan edukasi mengenai ekosistem laut di Indonesia.',
                'Order' =>  1
            ],
            [
                'question' => 'Bagaimana cara melaporkan temuan biota laut?',
                'Answer' => 'Anda dapat pergi ke halaman "Pelaporan", kemudian mengisi formulir temuan, mengunggah foto bukti, dan menandai lokasi temuan pada peta interaktif yang sudah disediakan.',
                'Order' =>  2
            ],
        ];

        foreach ($data as $item) {
            Faq::create($item);
        }
    }
}
