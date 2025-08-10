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
        Schema::table('post_views', function (Blueprint $table) {
            $table->foreign(['post_id'], 'post_views_ibfk_1')->references(['id'])->on('posts')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['user_id'], 'post_views_ibfk_2')->references(['id'])->on('users')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('post_views', function (Blueprint $table) {
            $table->dropForeign('post_views_ibfk_1');
            $table->dropForeign('post_views_ibfk_2');
        });
    }
};
