<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\Era;
use Illuminate\Database\Seeder;

class RichMusicSeeder extends Seeder
{
    public function run(): void
    {
        $albums = [
            [
                'title' => 'Kiss Land',
                'slug' => 'kiss-land',
                'year' => 2013,
            ],
            [
                'title' => 'Beauty Behind the Madness',
                'slug' => 'beauty-behind-the-madness',
                'year' => 2015,
            ],
            [
                'title' => 'Starboy',
                'slug' => 'starboy',
                'year' => 2016,
            ],
            [
                'title' => 'After Hours',
                'slug' => 'after-hours',
                'year' => 2020,
            ],
            [
                'title' => 'Dawn FM',
                'slug' => 'dawn-fm',
                'year' => 2022,
            ],
            [
                'title' => 'Hurry Up Tomorrow',
                'slug' => 'hurry-up-tomorrow',
                'year' => 2025,
            ],
        ];

        foreach ($albums as $item) {
            $era = Era::firstOrCreate(
                ['slug' => $item['slug']],
                [
                    'name' => $item['title'],
                    'description' => 'Etapa musical correspondiente al álbum '
                        . $item['title'] . '.',
                    'start_year' => $item['year'],
                    'is_active' => true,
                ]
            );

            Album::firstOrCreate(
                ['slug' => $item['slug']],
                [
                    'era_id' => $era->id,
                    'title' => $item['title'],
                    'release_date' => null,
                    'album_type' => 'studio',
                    'is_published' => true,
                ]
            );
        }
    }
}
