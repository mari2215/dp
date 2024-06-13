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

            //Intro:
            $table->text('intro')->nullable();

            //Hero image:
            $table->string('hero_image_copyright')->nullable();
            $table->string('hero_image_title')->nullable();

            //Publishing:
            $table->timestamp('publishing_begins_at')->nullable();
            $table->timestamp('publishing_ends_at')->nullable();
            $table->index('publishing_begins_at');
            $table->index('publishing_ends_at');

            //Overview:
            $table->string('overview_title')->nullable();
            $table->text('overview_description')->nullable();

            //Content blocks:
            $table->json('content_blocks');

            //Slug:
            $table->string('slug');

            //Author:
            $table->unsignedBigInteger('author_id')->nullable();
            $table->foreign('author_id')
                ->references('id')->on('users')->onDelete('set null');

            $table->unsignedBigInteger('event_id')->nullable();
            $table->foreign('event_id')
                ->references('id')->on('events')->onDelete('set null');

            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')
                ->references('id')->on('categories')->onDelete('set null');

            $table->unsignedBigInteger('activity_id')->nullable();
            $table->foreign('activity_id')
                ->references('id')->on('activities')->onDelete('set null');

            $table->timestamps();
        });
    }
};
