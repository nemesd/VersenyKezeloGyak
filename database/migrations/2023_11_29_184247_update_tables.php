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
        Schema::table('races', function (Blueprint $table) {
            $table->string('category');
            $table->string('description');
            $table->unique(['name', 'year']);
        });
        Schema::table('rounds', function (Blueprint $table) {
            $table->foreign('race_id')->references('id')->on('races');
            $table->unique(['name', 'race_id']);
        });

        Schema::table('competitors', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('round_id')->references('id')->on('rounds');
            $table->unique(['user_id', 'round_id']);
            $table->id();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('races', function (Blueprint $table) {
            $table->dropColumn('category');
            $table->dropColumn('description');
        });
    }
};
