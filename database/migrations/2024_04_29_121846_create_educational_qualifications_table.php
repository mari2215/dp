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
        Schema::create('educational_qualifications', function (Blueprint $table) {
            $table->id();
            $table->string('degree', 100);
            $table->string('institution', 200);
            $table->date('start_date');
            $table->date('graduation_date');
            $table->boolean('status')->default(true);
            $table->integer('position')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educational_qualifications');
    }
};
