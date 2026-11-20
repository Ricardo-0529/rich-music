<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Genre extends Model
{
    protected $fillable = [
        'name',
        'slug',
    ];

    public function albums(): BelongsToMany
    {
        return $this->belongsToMany(Album::class)
            ->withTimestamps();
    }
}
