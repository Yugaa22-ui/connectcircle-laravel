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
        Schema::table('posts', function (Blueprint $table) {
            $table->foreign(['circle_id'], 'posts_ibfk_1')->references(['id'])->on('circles')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['user_id'], 'posts_ibfk_2')->references(['id'])->on('users')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign('posts_ibfk_1');
            $table->dropForeign('posts_ibfk_2');
        });
    }
};
