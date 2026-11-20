
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media_links', function (Blueprint $table) {
            $table->id();

            $table->foreignId('album_id')
                ->nullable()
                ->constrained('albums')
                ->cascadeOnDelete();

            $table->foreignId('track_id')
                ->nullable()
                ->constrained('tracks')
                ->cascadeOnDelete();

            $table->string('platform');
            $table->string('type')->default('streaming');
            $table->string('label')->nullable();
            $table->text('url');
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media_links');
    }
};
