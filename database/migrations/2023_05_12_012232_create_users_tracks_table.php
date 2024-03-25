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
        Schema::create('users_tracks', function (Blueprint $table) {
            $table->id('id_user_track');
            $table->bigInteger('id_user')->index()->unsigned();
            $table->string('address_type', 32)->nullable();
            $table->string('address', 32)->nullable();
            $table->string('method', 8)->nullable();
            $table->string('prompt', 32)->nullable();
            $table->timestamps();
            $table->foreign('id_user')->references('id_user')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_tracks');
    }
};
