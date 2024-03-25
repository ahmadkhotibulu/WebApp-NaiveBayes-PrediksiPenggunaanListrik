<?php

namespace App\Models;

use App\Enums\DayaListrik;
use App\Enums\JumlahTanggungan;
use App\Enums\LuasRumah;
use App\Enums\Pendapatan;
use App\Enums\PenggunaanListrik;
use App\Enums\Perlengkapan;
use App\Models\Helpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TrainingData extends Model
{
    use HasFactory;

    protected $table = 'training_data';

    protected $primaryKey = 'id_training_data';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'jumlah_tanggungan',
        'luas_rumah',
        'pendapatan',
        'daya_listrik',
        'perlengkapan',
        'penggunaan_listrik',
    ];

    public static function getTrainingData($limit, $offset)
    {
        $builder = DB::table('training_data');
        $data = ['data' => $builder->limit($limit)->offset($offset)->orderByDesc('id_training_data')->get()];
        $builder = $builder->newQuery();
        $data['limit'] = (int) $limit;
        $data['offset'] = (int) $offset;
        $data['total'] = $builder->select()->from('training_data')->count();
        return $data;
    }

    public function predict()
    {
        // Konversi nilai inputan
        if ($this->jumlah_tanggungan == 1) {
            $this->jumlah_tanggungan = JumlahTanggungan::SEDIKIT;
        } else if ($this->jumlah_tanggungan == 2) {
            $this->jumlah_tanggungan = JumlahTanggungan::SEDANG;
        } else if ($this->jumlah_tanggungan == 3) {
            $this->jumlah_tanggungan = JumlahTanggungan::BANYAK;
        } else return false;

        if ($this->luas_rumah == 1) {
            $this->luas_rumah = LuasRumah::KECIL;
        } else if ($this->luas_rumah == 2) {
            $this->luas_rumah = LuasRumah::STANDAR;
        } else if ($this->luas_rumah == 3) {
            $this->luas_rumah = LuasRumah::BESAR;
        } else return false;

        if ($this->pendapatan == 1) {
            $this->pendapatan = Pendapatan::KECIL;
        } else if ($this->pendapatan == 2) {
            $this->pendapatan = Pendapatan::SEDANG;
        } else if ($this->pendapatan == 3) {
            $this->pendapatan = Pendapatan::BESAR;
        } else return false;

        if ($this->daya_listrik == 1) {
            $this->daya_listrik = DayaListrik::RENDAH;
        } else if ($this->daya_listrik == 2) {
            $this->daya_listrik = DayaListrik::SEDANG;
        } else if ($this->daya_listrik == 3) {
            $this->daya_listrik = DayaListrik::TINGGI;
        } else return false;

        if ($this->perlengkapan == 1) {
            $this->perlengkapan = Perlengkapan::SEDIKIT;
        } else if ($this->perlengkapan == 2) {
            $this->perlengkapan = Perlengkapan::SEDANG;
        } else if ($this->perlengkapan == 3) {
            $this->perlengkapan = Perlengkapan::BANYAK;
        } else return false;

        // Ambil data dari database
        $builder = DB::table('training_data');
        $data = $builder
            ->selectRaw('COUNT(id_training_data) AS jml_data')
            ->selectRaw('SUM(penggunaan_listrik = ?) AS jml_penggunaan_sedang', [PenggunaanListrik::SEDANG])
            ->selectRaw('SUM(penggunaan_listrik = ?) AS jml_penggunaan_tinggi', [PenggunaanListrik::TINGGI])
            ->selectRaw('SUM(jumlah_tanggungan = ? AND penggunaan_listrik = ?) AS jml_pg_sedang_jumlah_tanggungan', [$this->jumlah_tanggungan, PenggunaanListrik::SEDANG])
            ->selectRaw('SUM(jumlah_tanggungan = ? AND penggunaan_listrik = ?) AS jml_pg_tinggi_jumlah_tanggungan', [$this->jumlah_tanggungan, PenggunaanListrik::TINGGI])
            ->selectRaw('SUM(luas_rumah = ? AND penggunaan_listrik = ?) AS jml_pg_sedang_luas_rumah', [$this->luas_rumah, PenggunaanListrik::SEDANG])
            ->selectRaw('SUM(luas_rumah = ? AND penggunaan_listrik = ?) AS jml_pg_tinggi_luas_rumah', [$this->luas_rumah, PenggunaanListrik::TINGGI])
            ->selectRaw('SUM(pendapatan = ? AND penggunaan_listrik = ?) AS jml_pg_sedang_pendapatan', [$this->pendapatan, PenggunaanListrik::SEDANG])
            ->selectRaw('SUM(pendapatan = ? AND penggunaan_listrik = ?) AS jml_pg_tinggi_pendapatan', [$this->pendapatan, PenggunaanListrik::TINGGI])
            ->selectRaw('SUM(daya_listrik = ? AND penggunaan_listrik = ?) AS jml_pg_sedang_daya_listrik', [$this->daya_listrik, PenggunaanListrik::SEDANG])
            ->selectRaw('SUM(daya_listrik = ? AND penggunaan_listrik = ?) AS jml_pg_tinggi_daya_listrik', [$this->daya_listrik, PenggunaanListrik::TINGGI])
            ->selectRaw('SUM(perlengkapan = ? AND penggunaan_listrik = ?) AS jml_pg_sedang_perlengkapan', [$this->perlengkapan, PenggunaanListrik::SEDANG])
            ->selectRaw('SUM(perlengkapan = ? AND penggunaan_listrik = ?) AS jml_pg_tinggi_perlengkapan', [$this->perlengkapan, PenggunaanListrik::TINGGI])->first();

        $data->jumlah_tanggungan_konversi = $this->jumlah_tanggungan;
        $data->luas_rumah_konversi = $this->luas_rumah;
        $data->pendapatan_konversi = $this->pendapatan;
        $data->daya_listrik_konversi = $this->daya_listrik;
        $data->perlengkapan_konversi = $this->perlengkapan;

        // Hitung berdasarkan metode Naive Bayes

        // - Probabilitas tiap class
        $data->p_penggunaan_sedang = Helpers::numberPrecision($data->jml_penggunaan_sedang / $data->jml_data, 3);
        $data->p_penggunaan_tinggi = Helpers::numberPrecision($data->jml_penggunaan_tinggi / $data->jml_data, 3);

        // -  Probabilitas tiap kriteria
        $data->p_pg_sedang_jumlah_tanggungan = Helpers::numberPrecision($data->jml_pg_sedang_jumlah_tanggungan / $data->jml_penggunaan_sedang, 3);
        $data->p_pg_tinggi_jumlah_tanggungan = Helpers::numberPrecision($data->jml_pg_tinggi_jumlah_tanggungan / $data->jml_penggunaan_tinggi, 3);
        $data->p_pg_sedang_luas_rumah = Helpers::numberPrecision($data->jml_pg_sedang_luas_rumah / $data->jml_penggunaan_sedang, 3);
        $data->p_pg_tinggi_luas_rumah = Helpers::numberPrecision($data->jml_pg_tinggi_luas_rumah / $data->jml_penggunaan_tinggi, 3);
        $data->p_pg_sedang_pendapatan = Helpers::numberPrecision($data->jml_pg_sedang_pendapatan / $data->jml_penggunaan_sedang, 3);
        $data->p_pg_tinggi_pendapatan = Helpers::numberPrecision($data->jml_pg_tinggi_pendapatan / $data->jml_penggunaan_tinggi, 3);
        $data->p_pg_sedang_daya_listrik = Helpers::numberPrecision($data->jml_pg_sedang_daya_listrik / $data->jml_penggunaan_sedang, 3);
        $data->p_pg_tinggi_daya_listrik = Helpers::numberPrecision($data->jml_pg_tinggi_daya_listrik / $data->jml_penggunaan_tinggi, 3);
        $data->p_pg_sedang_perlengkapan = Helpers::numberPrecision($data->jml_pg_sedang_perlengkapan / $data->jml_penggunaan_sedang, 3);
        $data->p_pg_tinggi_perlengkapan = Helpers::numberPrecision($data->jml_pg_tinggi_perlengkapan / $data->jml_penggunaan_tinggi, 3);

        // -  Hitung total probabilitas
        $data->p_hasil_penggunaan_sedang = Helpers::numberPrecision($data->p_pg_sedang_jumlah_tanggungan * $data->p_pg_sedang_luas_rumah * $data->p_pg_sedang_pendapatan * $data->p_pg_sedang_daya_listrik * $data->p_pg_sedang_perlengkapan * $data->p_penggunaan_sedang, 3);
        $data->p_hasil_penggunaan_tinggi = Helpers::numberPrecision($data->p_pg_tinggi_jumlah_tanggungan * $data->p_pg_tinggi_luas_rumah * $data->p_pg_tinggi_pendapatan * $data->p_pg_tinggi_daya_listrik * $data->p_pg_tinggi_perlengkapan * $data->p_penggunaan_tinggi, 3);

        // - Tentukan hasil dan ambil tips
        $data->hasil = $data->p_hasil_penggunaan_sedang > $data->p_hasil_penggunaan_tinggi ? PenggunaanListrik::SEDANG : PenggunaanListrik::TINGGI;
        $data->tips = static::getTips($data->hasil, $data->perlengkapan_konversi);

        return $data;
    }

    public static function convert_back_value($data) {
        if (isset($data['jumlah_tanggungan']) && $data['jumlah_tanggungan'] == 1) {
            $data['jumlah_tanggungan'] = '< 3 orang';
        } else if (isset($data['jumlah_tanggungan']) && $data['jumlah_tanggungan'] == 2) {
            $data['jumlah_tanggungan'] = '3 - 5 orang';
        } else if (isset($data['jumlah_tanggungan']) && $data['jumlah_tanggungan'] == 3) {
            $data['jumlah_tanggungan'] = '> 5 orang';
        }

        if (isset($data['luas_rumah']) && $data['luas_rumah'] == 1) {
            $data['luas_rumah'] = '< 10 m2';
        } else if (isset($data['luas_rumah']) && $data['luas_rumah'] == 2) {
            $data['luas_rumah'] = '10 - 20 m2';
        } else if (isset($data['luas_rumah']) && $data['luas_rumah'] == 3) {
            $data['luas_rumah'] = '> 20 m2';
        }

        if (isset($data['pendapatan']) && $data['pendapatan'] == 1) {
            $data['pendapatan'] = '< 500.000';
        } else if (isset($data['pendapatan']) && $data['pendapatan'] == 2) {
            $data['pendapatan'] = '500.000 - 800.000';
        } else if (isset($data['pendapatan']) && $data['pendapatan'] == 3) {
            $data['pendapatan'] = '> 800.000';
        }

        if (isset($data['daya_listrik']) && $data['daya_listrik'] == 1) {
            $data['daya_listrik'] = '< 900 VA';
        } else if (isset($data['daya_listrik']) && $data['daya_listrik'] == 2) {
            $data['daya_listrik'] = '900 - 1300 VA';
        } else if (isset($data['daya_listrik']) && $data['daya_listrik'] == 3) {
            $data['daya_listrik'] = '> 1300 VA';
        }

        if (isset($data['perlengkapan']) && $data['perlengkapan'] == 1) {
            $data['perlengkapan'] = '< 2 buah';
        } else if (isset($data['perlengkapan']) && $data['perlengkapan'] == 2) {
            $data['perlengkapan'] = '2 - 5 buah';
        } else if (isset($data['perlengkapan']) && $data['perlengkapan'] == 3) {
            $data['perlengkapan'] = '> 5 buah';
        }

        return $data;
    }

    public static function getTips($penggunaan_listrik, $perlengkapan_konversi) {
        $tips_pg_listrik = '';
        $tips_perlengkapan = '';

        if ($penggunaan_listrik == PenggunaanListrik::TINGGI) {
            $tips_pg_listrik = "
                <li>Pilih penerangan efisien: Gantilah lampu pijar tradisional dengan lampu
                LED yang lebih efisien. Lampu LED menggunakan lebih sedikit energi dan
                memiliki umur yang lebih lama. Gunakan pencahayaan alami sebanyak mungkin
                dengan memanfaatkan cahaya matahari.</li>
                <li>Gunakan pengatur waktu dan sensor: Pasanglah pengatur waktu pada
                peralatan seperti pemanas air, pemanas ruangan, atau pompa kolam renang agar
                hanya beroperasi saat diperlukan. Gunakan juga sensor gerak atau sensor
                cahaya untuk mengontrol pencahayaan secara otomatis, sehingga tidak ada
                lampu yang terus menyala tanpa alasan.</li>
                <li>Tingkatkan isolasi dan pengelolaan energi: Pastikan rumah Anda
                terisolasi dengan baik untuk mencegah kebocoran udara. Perbaiki celah dan
                retakan di jendela, pintu, dan dinding. Gunakan tirai atau penutup jendela
                yang tepat untuk mengurangi panas matahari yang masuk atau kebocoran panas
                dari dalam ruangan.</li>
            ";

            if ($perlengkapan_konversi == Perlengkapan::BANYAK) {
                $tips_perlengkapan = "
                    Anda memiliki banyak perlengkapan.
                    Kurangi penggunaan peralatan listrik secara bersamaan: Hindari
                    mengoperasikan banyak peralatan listrik berat seperti oven, mesin cuci,
                    pengering pakaian, dan AC pada saat yang bersamaan. Distribusikan penggunaan
                    peralatan tersebut secara merata sehingga beban listrik tidak terlalu tinggi
                    pada satu waktu.
                ";
            } else if ($perlengkapan_konversi == Perlengkapan::SEDANG) {
                $tips_perlengkapan = "
                    Anda memiliki cukup banyak perlengkapan.
                    Gunakan peralatan listrik secara efisien: Ketika menggunakan peralatan
                    elektronik seperti oven, kompor, atau ketel listrik, pastikan untuk
                    mengoptimalkan penggunaannya. Misalnya, saat memasak, tutup panci atau
                    penggunaan tutup pada oven untuk mempertahankan suhu dan menghemat energi.
                ";
            } else if ($perlengkapan_konversi == Perlengkapan::SEDIKIT) {
                $tips_perlengkapan = "
                    Anda memiliki sedikit perlengkapan.
                    Pilih peralatan hemat energi: Gantilah peralatan elektronik Anda dengan
                    yang memiliki label hemat energi, seperti kulkas, AC, mesin cuci, oven, dan
                    televisi. Pilihlah peralatan dengan rating bintang energi yang tinggi untuk
                    mengurangi konsumsi listrik.
                ";
            }

        } else if ($penggunaan_listrik == PenggunaanListrik::SEDANG) {
            $tips_pg_listrik = "
                <li>Ganti lampu dengan LED: Lampu pijar tradisional lebih boros energi
                dibandingkan dengan lampu LED. Gantilah semua lampu di rumah Anda dengan
                lampu LED yang lebih efisien. Ini akan membantu mengurangi konsumsi listrik
                dan memperpanjang umur lampu.</li>
                <li>Isolasi termal: Pastikan rumah Anda terisolasi dengan baik agar tidak
                ada kebocoran panas atau dingin. Dengan melakukan isolasi yang efisien, Anda
                dapat mengurangi penggunaan AC atau pemanas, sehingga menghemat energi.</li>
                <li>Manfaatkan cahaya alami: Manfaatkan sebanyak mungkin cahaya alami di
                dalam rumah. Buka tirai atau jendela saat ada cukup cahaya matahari agar
                Anda tidak perlu mengandalkan lampu listrik pada siang hari. </li>
                <li>Selalu lakukan perawatan dan perbaikan: Pastikan agar peralatan
                listrik dan instalasi listrik di rumah Anda selalu dalam kondisi baik.
                Perawatan dan perbaikan rutin dapat membantu mencegah kebocoran daya dan
                memastikan efisiensi penggunaan listrik.</li>
            ";

            if ($perlengkapan_konversi == Perlengkapan::BANYAK) {
                $tips_perlengkapan = "
                    Anda memiliki banyak perlengkapan.
                    Kurangi penggunaan peralatan listrik secara bersamaan: Hindari
                    mengoperasikan banyak peralatan listrik berat seperti oven, mesin cuci,
                    pengering pakaian, dan AC pada saat yang bersamaan. Distribusikan penggunaan
                    peralatan tersebut secara merata sehingga beban listrik tidak terlalu tinggi
                    pada satu waktu.
                ";
            } else if ($perlengkapan_konversi == Perlengkapan::SEDANG) {
                $tips_perlengkapan = "
                    Anda memiliki cukup banyak perlengkapan.
                    Gunakan peralatan listrik secara efisien: Ketika menggunakan peralatan
                    elektronik seperti oven, kompor, atau ketel listrik, pastikan untuk
                    mengoptimalkan penggunaannya. Misalnya, saat memasak, tutup panci atau
                    penggunaan tutup pada oven untuk mempertahankan suhu dan menghemat energi.
                ";
            } else if ($perlengkapan_konversi == Perlengkapan::SEDIKIT) {
                $tips_perlengkapan = "
                    Anda memiliki sedikit perlengkapan.
                    Pilih peralatan hemat energi: Gantilah peralatan elektronik Anda dengan
                    yang memiliki label hemat energi, seperti kulkas, AC, mesin cuci, oven, dan
                    televisi. Pilihlah peralatan dengan rating bintang energi yang tinggi untuk
                    mengurangi konsumsi listrik.
                ";
            }

        } else if ($penggunaan_listrik == PenggunaanListrik::RENDAH) {
            $tips_pg_listrik = "
                <li>Bagus! Penggunaan listrik Anda tergolong rendah.</li>
            ";
        }

        return ['tips_pg_listrik' => $tips_pg_listrik, 'tips_perlengkapan' => $tips_perlengkapan];
    }
}
