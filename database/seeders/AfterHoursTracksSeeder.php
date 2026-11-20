<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\Track;
use Illuminate\Database\Seeder;

class AfterHoursTracksSeeder extends Seeder
{
    public function run(): void
    {
        $album = Album::where('slug', 'after-hours')->firstOrFail();

        $tracks = [
            'Alone Again',
            'Too Late',
            'Hardest To Love',
            'Scared To Live',
            'Snowchild',
            'Escape From LA',
            'Heartless',
            'Faith',
            'Blinding Lights',
            'In Your Eyes',
            'Save Your Tears',
            'Repeat After Me (Interlude)',
            'After Hours',
            'Until I Bleed Out',
        ];

        foreach ($tracks as $index => $title) {
            Track::updateOrCreate(
                [
                    'album_id' => $album->id,
                    'track_number' => $index + 1,
                ],
                [
                    'title' => $title,
                    'duration_seconds' => null,
                    'is_explicit' => false,
                ]
            );
        }

        $this->command->info('14 canciones de After Hours registradas correctamente.');
    }
}