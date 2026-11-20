
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tracks', function (Blueprint $table) {
            $table->id();

            $table->foreignId('album_id')
                ->constrained('albums')
                ->cascadeOnDelete();

            $table->string('title');
            $table->unsignedSmallInteger('track_number');
            $table->unsignedInteger('duration_seconds')->nullable();
            $table->boolean('is_explicit')->default(false);

            $table->timestamps();

            $table->unique(['album_id', 'track_number']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tracks');
    }
};
