<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Track extends Model
{
    protected $fillable = [
        'album_id',
        'title',
        'track_number',
        'duration_seconds',
        'is_explicit',
    ];

    protected function casts(): array
    {
        return [
            'track_number' => 'integer',
            'duration_seconds' => 'integer',
            'is_explicit' => 'boolean',
        ];
    }

    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }

    public function mediaLinks(): HasMany
    {
        return $this->hasMany(MediaLink::class);
    }
}
