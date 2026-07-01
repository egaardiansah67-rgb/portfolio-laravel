<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('heroes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('profession');
            $table->text('description')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('background_image')->nullable();
            $table->string('cv_file')->nullable();
            $table->string('button_hire_text')->default('Hire Me');
            $table->string('button_cv_text')->default('Download CV');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('heroes');
    }
};