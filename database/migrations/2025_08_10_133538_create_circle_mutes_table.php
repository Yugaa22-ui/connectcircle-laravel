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
        Schema::create('circle_mutes', function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('circle_id')->index('circle_mutes_ibfk_2');
            $table->dateTime('until_time');

            $table->primary(['user_id', 'circle_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('circle_mutes');
    }
};
