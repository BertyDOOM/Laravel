<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Publication;

class PublicationsTableSeeder extends Seeder
{
    public function run(): void
    {
        // Примерни публикации
        $publications = [
            [
                'title' => 'Връзката между серумния α1-AGP и хроничното бъбречно заболяване',
                'authors' => 'Иван Иванов',
                'type' => 'journal',
                'theme' => 'biology',
                'image' => 'publications/ai_book.jpg'
            ],
            [
                'title' => 'История на литературата',
                'authors' => 'Мария Петрова',
                'type' => 'encyclopedia',
                'theme' => 'literature',
                'image' => 'publications/literature.jpg'
            ],
            [
                'title' => 'Връзката между броя на лимфоцитите и смъртността при пациенти с дисфагия',
                'authors' => 'Мин Уей',
                'type' => 'monograph',
                'theme' => 'biology',
                'image' => 'publications/philosophybiology2.jpg'
            ],
            [
                'title' => 'Математическо моделиране на въздействието на пчелите',
                'authors' => 'Петър Петров',
                'type' => 'journal',
                'theme' => 'math',
                'image' => 'publications/math.jpg'
            ],
            [
                'title' => 'Технологични трансформации',
                'authors' => 'Димитър Димитров',
                'type' => 'book',
                'theme' => 'cs',
                'image' => 'publications/cs_book.jpg'
            ],
        ];

        foreach ($publications as $pub) {
            Publication::create($pub);
        }
    }
}
