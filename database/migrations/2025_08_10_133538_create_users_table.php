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
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('username', 100);
            $table->string('email', 150)->unique();
            $table->string('password');
            $table->string('city', 100)->nullable();
            $table->string('profession', 100)->nullable();
            $table->text('bio')->nullable();
            $table->string('role', 20)->default('user');
            $table->string('profile_picture')->nullable();
            $table->timestamps(); // created_at & updated_at otomatis
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
