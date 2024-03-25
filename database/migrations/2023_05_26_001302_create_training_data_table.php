<?php

use App\Enums\DayaListrik;
use App\Enums\JumlahTanggungan;
use App\Enums\LuasRumah;
use App\Enums\Pendapatan;
use App\Enums\PenggunaanListrik;
use App\Enums\Perlengkapan;
use App\Models\TrainingData;
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
        Schema::create('training_data', function (Blueprint $table) {
            $table->id('id_training_data');
            $table->enum('jumlah_tanggungan', array_column(JumlahTanggungan::cases(), 'value'));
            $table->enum('luas_rumah', array_column(LuasRumah::cases(), 'value'));
            $table->enum('pendapatan', array_column(Pendapatan::cases(), 'value'));
            $table->enum('daya_listrik', array_column(DayaListrik::cases(), 'value'));
            $table->enum('perlengkapan', array_column(Perlengkapan::cases(), 'value'));
            $table->enum('penggunaan_listrik', array_column(PenggunaanListrik::cases(), 'value'));
            $table->timestamps();
        });

        (new TrainingData(
            [ // 2
                'jumlah_tanggungan' => JumlahTanggungan::BANYAK,
                'luas_rumah' => LuasRumah::BESAR,
                'pendapatan' => Pendapatan::BESAR,
                'daya_listrik' => DayaListrik::SEDANG,
                'perlengkapan' => Perlengkapan::BANYAK,
                'penggunaan_listrik' => PenggunaanListrik::TINGGI,
            ]
        ))->save();
        (new TrainingData(
            [ // 3
                'jumlah_tanggungan' => JumlahTanggungan::BANYAK,
                'luas_rumah' => LuasRumah::BESAR,
                'pendapatan' => Pendapatan::BESAR,
                'daya_listrik' => DayaListrik::SEDANG,
                'perlengkapan' => Perlengkapan::BANYAK,
                'penggunaan_listrik' => PenggunaanListrik::TINGGI,
            ]
        ))->save();
        (new TrainingData(
            [ // 4
                'jumlah_tanggungan' => JumlahTanggungan::BANYAK,
                'luas_rumah' => LuasRumah::BESAR,
                'pendapatan' => Pendapatan::BESAR,
                'daya_listrik' => DayaListrik::SEDANG,
                'perlengkapan' => Perlengkapan::BANYAK,
                'penggunaan_listrik' => PenggunaanListrik::TINGGI,
            ]
        ))->save();
        (new TrainingData(
            [ // 5
                'jumlah_tanggungan' => JumlahTanggungan::BANYAK,
                'luas_rumah' => LuasRumah::BESAR,
                'pendapatan' => Pendapatan::BESAR,
                'daya_listrik' => DayaListrik::SEDANG,
                'perlengkapan' => Perlengkapan::BANYAK,
                'penggunaan_listrik' => PenggunaanListrik::TINGGI,
            ]
        ))->save();
        (new TrainingData(
            [ // 6
                'jumlah_tanggungan' => JumlahTanggungan::SEDIKIT,
                'luas_rumah' => LuasRumah::STANDAR,
                'pendapatan' => Pendapatan::BESAR,
                'daya_listrik' => DayaListrik::RENDAH,
                'perlengkapan' => Perlengkapan::SEDANG,
                'penggunaan_listrik' => PenggunaanListrik::SEDANG,
            ]
        ))->save();
        (new TrainingData(
            [ // 7
                'jumlah_tanggungan' => JumlahTanggungan::SEDIKIT,
                'luas_rumah' => LuasRumah::BESAR,
                'pendapatan' => Pendapatan::BESAR,
                'daya_listrik' => DayaListrik::SEDANG,
                'perlengkapan' => Perlengkapan::SEDANG,
                'penggunaan_listrik' => PenggunaanListrik::SEDANG,
            ]
        ))->save();
        (new TrainingData(
            [ // 8
                'jumlah_tanggungan' => JumlahTanggungan::SEDIKIT,
                'luas_rumah' => LuasRumah::KECIL,
                'pendapatan' => Pendapatan::BESAR,
                'daya_listrik' => DayaListrik::SEDANG,
                'perlengkapan' => Perlengkapan::SEDANG,
                'penggunaan_listrik' => PenggunaanListrik::SEDANG,
            ]
        ))->save();
        (new TrainingData(
            [ // 9
                'jumlah_tanggungan' => JumlahTanggungan::SEDANG,
                'luas_rumah' => LuasRumah::BESAR,
                'pendapatan' => Pendapatan::BESAR,
                'daya_listrik' => DayaListrik::SEDANG,
                'perlengkapan' => Perlengkapan::BANYAK,
                'penggunaan_listrik' => PenggunaanListrik::SEDANG,
            ]
        ))->save();
        (new TrainingData(
            [ // 10
                'jumlah_tanggungan' => JumlahTanggungan::SEDANG,
                'luas_rumah' => LuasRumah::BESAR,
                'pendapatan' => Pendapatan::BESAR,
                'daya_listrik' => DayaListrik::SEDANG,
                'perlengkapan' => Perlengkapan::BANYAK,
                'penggunaan_listrik' => PenggunaanListrik::SEDANG,
            ]
        ))->save();
        (new TrainingData(
            [ // 11
                'jumlah_tanggungan' => JumlahTanggungan::SEDANG,
                'luas_rumah' => LuasRumah::STANDAR,
                'pendapatan' => Pendapatan::BESAR,
                'daya_listrik' => DayaListrik::SEDANG,
                'perlengkapan' => Perlengkapan::BANYAK,
                'penggunaan_listrik' => PenggunaanListrik::SEDANG,
            ]
        ))->save();
        (new TrainingData(
            [ // 12
                'jumlah_tanggungan' => JumlahTanggungan::SEDANG,
                'luas_rumah' => LuasRumah::STANDAR,
                'pendapatan' => Pendapatan::BESAR,
                'daya_listrik' => DayaListrik::SEDANG,
                'perlengkapan' => Perlengkapan::BANYAK,
                'penggunaan_listrik' => PenggunaanListrik::SEDANG,
            ]
        ))->save();
        (new TrainingData(
            [ // 13
                'jumlah_tanggungan' => JumlahTanggungan::SEDANG,
                'luas_rumah' => LuasRumah::STANDAR,
                'pendapatan' => Pendapatan::BESAR,
                'daya_listrik' => DayaListrik::SEDANG,
                'perlengkapan' => Perlengkapan::BANYAK,
                'penggunaan_listrik' => PenggunaanListrik::TINGGI,
            ]
        ))->save();
        (new TrainingData(
            [ // 14
                'jumlah_tanggungan' => JumlahTanggungan::SEDANG,
                'luas_rumah' => LuasRumah::STANDAR,
                'pendapatan' => Pendapatan::BESAR,
                'daya_listrik' => DayaListrik::SEDANG,
                'perlengkapan' => Perlengkapan::BANYAK,
                'penggunaan_listrik' => PenggunaanListrik::TINGGI,
            ]
        ))->save();
        (new TrainingData(
            [ // 15
                'jumlah_tanggungan' => JumlahTanggungan::SEDANG,
                'luas_rumah' => LuasRumah::STANDAR,
                'pendapatan' => Pendapatan::BESAR,
                'daya_listrik' => DayaListrik::SEDANG,
                'perlengkapan' => Perlengkapan::BANYAK,
                'penggunaan_listrik' => PenggunaanListrik::TINGGI,
            ]
        ))->save();
        (new TrainingData(
            [ // 16
                'jumlah_tanggungan' => JumlahTanggungan::BANYAK,
                'luas_rumah' => LuasRumah::STANDAR,
                'pendapatan' => Pendapatan::KECIL,
                'daya_listrik' => DayaListrik::SEDANG,
                'perlengkapan' => Perlengkapan::BANYAK,
                'penggunaan_listrik' => PenggunaanListrik::SEDANG,
            ]
        ))->save();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_data');
    }
};
