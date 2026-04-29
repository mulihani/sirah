<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('language', 10)->unique()->comment('One profile per language (ar, en, fr, ...)');
            $table->string('title')->nullable()->comment('Display name in hero section');
            $table->string('hero_title')->nullable()->comment('e.g. Full Stack Developer');
            $table->string('hero_subtitle')->nullable()->comment('Short catchy tagline shown in hero');
            $table->string('about_title')->nullable()->comment('Display title for about section');
            $table->text('about_me')->nullable()->comment('Biographical text for the About section on homepage');
            $table->string('profile_photo')->nullable()->comment('Path to hero profile image');
            $table->string('about_photo')->nullable()->comment('Path to about section image');
            $table->json('stats')->nullable()->comment('[{"label":"Projects","value":"20+"},...]');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
