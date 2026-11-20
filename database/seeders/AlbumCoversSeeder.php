<?php

namespace Database\Seeders;

use App\Models\Album;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class AlbumCoversSeeder extends Seeder
{
    public function run(): void
    {
        $albums = [
            'Kiss Land',
            'Beauty Behind the Madness',
            'Starboy',
            'After Hours',
            'Dawn FM',
            'Hurry Up Tomorrow',
        ];

        foreach ($albums as $title) {

            $response = Http::timeout(20)->get(
                'https://itunes.apple.com/search',
                [
                    'term' => 'The Weeknd ' . $title,
                    'entity' => 'album',
                    'limit' => 10,
                ]
            )->throw();

            $results = collect($response->json('results', []));

            $result = $results->first(
                fn ($item) =>
                    strcasecmp($item['collectionName'] ?? '', $title) === 0
            );

            if (!$result || empty($result['artworkUrl100'])) {
                throw new RuntimeException(
                    "No se encontró la portada de: {$title}"
                );
            }

            $coverUrl = str_replace(
                '100x100bb',
                '600x600bb',
                $result['artworkUrl100']
            );

            Album::where('title', $title)->update([
                'cover_image' => $coverUrl,
            ]);

            $this->command->info(
                "Portada registrada: {$title}"
            );
        }
    }
}