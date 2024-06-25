<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('main_pages', function (Blueprint $table) {
            $table->id();
            $table->text('intro')->nullable();
            $table->string('hero_image_title')->nullable();

            $table->string('title');
            $table->timestamp('publishing_begins_at')
                ->nullable()
                ->default(Carbon::now()->addWeek());
            $table->timestamp('publishing_ends_at')
                ->nullable()
                ->default(null);
            $table->index('publishing_begins_at');
            $table->index('publishing_ends_at');

            $table->json('content_blocks');

            //Slug:
            $table->string('slug');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
