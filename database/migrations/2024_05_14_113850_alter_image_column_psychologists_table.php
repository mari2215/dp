<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('psychologists', function (Blueprint $table) {
            $table->text('image')->change();
            $table->text('title')->change();
            $table->text('subtitle')->change();
            $table->text('youtube_title')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('psychologists', function (Blueprint $table) {
            $table->string('image')->change();
            $table->string('title')->change();
            $table->string('subtitle')->change();
            $table->string('youtube_title')->change();
        });
    }
};
