<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            //Publishing:
            $table->timestamp('publishing_begins_at')->nullable();
            $table->timestamp('publishing_ends_at')->nullable();
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
