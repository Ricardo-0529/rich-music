<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Era extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'start_year',
        'end_year',
        'cover_image',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'start_year' => 'integer',
            'end_year' => 'integer',
        ];
    }

    public function albums(): HasMany
    {
        return $this->hasMany(Album::class);
    }
}
