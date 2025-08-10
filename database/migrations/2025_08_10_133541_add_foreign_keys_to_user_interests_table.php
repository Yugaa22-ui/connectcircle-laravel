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
        Schema::table('user_interests', function (Blueprint $table) {
            $table->foreign(['user_id'], 'user_interests_ibfk_1')->references(['id'])->on('users')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['interest_id'], 'user_interests_ibfk_2')->references(['id'])->on('interests')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_interests', function (Blueprint $table) {
            $table->dropForeign('user_interests_ibfk_1');
            $table->dropForeign('user_interests_ibfk_2');
        });
    }
};
