<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            [
                'name' => 'POLRI',
                'slug' => 'polri',
                'description' => 'Berita terkait Kepolisian Republik Indonesia'
            ],
            [
                'name' => 'Kriminal',
                'slug' => 'kriminal',
                'description' => 'Berita kejahatan dan kasus kriminal'
            ],
            [
                'name' => 'Bhabin',
                'slug' => 'bhabin',
                'description' => 'Berita terkait Bhabinkamtibmas (Bhayangkara Pembina Keamanan dan Ketertiban Masyarakat)'
            ],
            [
                'name' => 'Lantas',
                'slug' => 'lantas',
                'description' => 'Berita terkait Lalu Lintas'
            ],
            [
                'name' => 'Politik',
                'slug' => 'politik',
                'description' => 'Berita politik dan pemerintahan'
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
