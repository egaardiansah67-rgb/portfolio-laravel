<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('visitor_analytics', function (Blueprint $table) {
            $table->id();
            $table->date('visit_date');
            $table->integer('visitor_count')->default(0);
            $table->integer('page_views')->default(0);
            $table->timestamps();
            $table->unique('visit_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visitor_analytics');
    }
};