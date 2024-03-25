<?php

use App\Enums\TipeUser;
use App\Models\User;
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
            $table->id('id_user');
            $table->enum('tipe_user', array_column(TipeUser::cases(), 'value'));
            $table->string('username', 18)->unique();
            $table->string('password', 255);
            $table->string('foto_user', 125)->nullable();
            $table->string('nama_depan', 24)->fulltext();
            $table->string('nama_belakang', 64)->fulltext();
            $table->string('provinsi', 48);
            $table->string('kabupaten', 64);
            $table->string('kecamatan', 64);
            $table->string('kelurahan', 80);
            $table->string('alamat', 128)->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        (new User([
            'tipe_user' => TipeUser::ADMIN,
            'username' => 'admin',
            'password' => password_hash('admin', PASSWORD_ARGON2ID),
            'nama_depan' => 'Administrator',
            'nama_belakang' => '',
            'provinsi' => '34,DI YOGYAKARTA',
            'kabupaten' => '3404,KABUPATEN SLEMAN',
            'kecamatan' => '3404080,BERBAH',
            'kelurahan' => '3404080001,SENDANG TIRTO',
        ]))->save();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
