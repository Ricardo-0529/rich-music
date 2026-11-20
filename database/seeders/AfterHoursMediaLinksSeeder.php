<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\MediaLink;
use Illuminate\Database\Seeder;

class AfterHoursMediaLinksSeeder extends Seeder
{
    public function run(): void
    {
        $album = Album::where('slug', 'after-hours')->firstOrFail();

        $links = [
            [
                'platform' => 'spotify',
                'type' => 'streaming',
                'label' => 'Escuchar en Spotify',
                'url' => 'https://open.spotify.com/album/4yP0hdKOZPNshxUOjY0cZj',
            ],
            [
                'platform' => 'apple_music',
                'type' => 'streaming',
                'label' => 'Escuchar en Apple Music',
                'url' => 'https://music.apple.com/us/album/after-hours/1499378108',
            ],
            [
                'platform' => 'youtube',
                'type' => 'video',
                'label' => 'Ver After Hours en YouTube',
                'url' => 'https://www.youtube.com/watch?v=EzMXwVUU-yc',
            ],
        ];

        foreach ($links as $index => $link) {
            MediaLink::updateOrCreate(
                [
                    'album_id' => $album->id,
                    'track_id' => null,
                    'platform' => $link['platform'],
                    'type' => $link['type'],
                ],
                [
                    'label' => $link['label'],
                    'url' => $link['url'],
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ]
            );
        }

        $this->command->info(
            'Tres enlaces musicales registrados para After Hours.'
        );
    }
}