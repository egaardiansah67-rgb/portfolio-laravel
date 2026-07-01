<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('portfolio_category_id')->constrained('portfolio_categories')->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('full_description')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('client_name')->nullable();
            $table->text('technologies')->nullable();
            $table->string('github_url')->nullable();
            $table->string('live_url')->nullable();
            $table->date('project_date')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};