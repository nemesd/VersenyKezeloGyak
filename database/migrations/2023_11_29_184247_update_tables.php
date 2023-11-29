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
        });
        Schema::table('rounds', function (Blueprint $table) {
            $table->foreign('race_id')->references('id')->on('races');
        });
        Schema::table('cometitors', function (Blueprint $table) {
            $table->foreign('users_id')->references('id')->on('users');
            $table->foreign('rounds_id')->references('id')->on('rounds');
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
