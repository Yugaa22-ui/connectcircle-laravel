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
        Schema::create('post_views', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('post_id');
            $table->integer('user_id')->index('user_id');
            $table->dateTime('viewed_at')->nullable()->useCurrent();

            $table->unique(['post_id', 'user_id'], 'post_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_views');
    }
};
