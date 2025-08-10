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
        Schema::table('circle_mutes', function (Blueprint $table) {
            $table->foreign(['user_id'], 'circle_mutes_ibfk_1')->references(['id'])->on('users')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['circle_id'], 'circle_mutes_ibfk_2')->references(['id'])->on('circles')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('circle_mutes', function (Blueprint $table) {
            $table->dropForeign('circle_mutes_ibfk_1');
            $table->dropForeign('circle_mutes_ibfk_2');
        });
    }
};
