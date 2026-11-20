
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('album_genres', function (Blueprint $table) {
            $table->id();

            $table->foreignId('album_id')
                ->constrained('albums')
                ->cascadeOnDelete();

            $table->foreignId('genre_id')
                ->constrained('genres')
                ->cascadeOnDelete();

            $table->timestamps();

            $table->unique(['album_id', 'genre_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('album_genres');
    }
};
