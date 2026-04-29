<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('work')->index();
            $table->string('name');
            $table->string('slug');
            $table->string('language', 10);
            $table->json('options')->nullable();
            $table->timestamps();

            $table->unique(['slug', 'language']);
            $table->index('language');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
