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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->integer('api_id')->unique();
            $table->foreignId('competition_id')->constrained('competitions');
            $table->string('home_team', 100);
            $table->string('away_team', 100);
            $table->string('home_team_logo', 255)->nullable();
            $table->string('away_team_logo', 255)->nullable();
            $table->string('status', 50);
            $table->dateTime('kickoff_at');
            $table->integer('home_score')->nullable();
            $table->integer('away_score')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
