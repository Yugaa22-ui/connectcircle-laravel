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
        Schema::create('circles', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name', 100)->unique('name');
            $table->text('description')->nullable();
            $table->boolean('is_private')->default(false);
            $table->integer('creator_id')->index('creator_id');
            $table->timestamp('created_at')->useCurrent();
            $table->text('rules')->nullable();
            $table->integer('interest_id')->index('fk_circle_interest');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('circles');
    }
};
