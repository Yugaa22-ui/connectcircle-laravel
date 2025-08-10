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
        Schema::create('friend_requests', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('sender_id');
            $table->integer('receiver_id')->index('receiver_id');
            $table->enum('status', ['pending', 'accepted', 'rejected'])->nullable()->default('pending');
            $table->timestamp('created_at')->useCurrent();

            $table->unique(['sender_id', 'receiver_id'], 'unique_friendship');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('friend_requests');
    }
};
