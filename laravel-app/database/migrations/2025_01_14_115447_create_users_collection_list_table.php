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
        Schema::create('users_collection_list', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userID')->constrained('users')->onDelete('cascade');
            $table->string('imdbID');
            $table->string('type');
            $table->integer('series')->nullable();
            $table->integer('season')->nullable();
            $table->integer('episode')->nullable();
            $table->boolean('favorite')->default(false);
            $table->boolean('watchlist')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
