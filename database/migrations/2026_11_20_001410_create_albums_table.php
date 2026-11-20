
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->id();

            $table->foreignId('era_id')
                ->constrained('eras')
                ->cascadeOnDelete();

            $table->string('title');
            $table->string('slug')->unique();
            $table->date('release_date')->nullable();
            $table->string('cover_image')->nullable();
            $table->text('description')->nullable();
            $table->string('album_type')->default('studio');
            $table->boolean('is_published')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('albums');
    }
};
