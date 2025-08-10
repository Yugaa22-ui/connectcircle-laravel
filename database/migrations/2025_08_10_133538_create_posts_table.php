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
        Schema::create('posts', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('circle_id')->index('circle_id');
            $table->integer('user_id')->index('user_id');
            $table->text('content');
            $table->timestamp('created_at')->useCurrent();
            $table->dateTime('updated_at')->nullable();
            $table->boolean('deleted')->nullable()->default(false);
            $table->string('image_path')->nullable();
            $table->enum('media_type', ['image', 'video', 'audio', 'voice'])->nullable();
            $table->string('media_path')->nullable();
            $table->integer('media_duration')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
