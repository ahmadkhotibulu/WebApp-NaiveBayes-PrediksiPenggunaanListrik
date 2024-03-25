@extends('layouts.main')

@section('content')
    <header>
        @include('partials.navbar')
        <main class="container-fluid">
            <section id="data-page" class="d-flex gap-5 flex-wrap justify-content-center my-5 mx-1">
                <div class="p-4 bg-white shadow-lg rounded-4">
                    <div class="d-flex flex-column gap-3">
                        <div class="border-bottom pb-2 mb-2">
                            <h1 class="fs-3 mt-3 fw-bold"><i class="fa-solid fa-book"></i>&nbsp;&nbsp;{{ $page_title }}
                            </h1>
                        </div>
                        @isset($result)
                            <div class="p-3 rounded-4 border mb-3 mx-3 fw-bold opacity-75 fs-6" style='max-width:45rem;'>
                                <h5 class="fs-5 text-black fw-bold">Data diri Anda</h5>
                                <p class='fs-6 fw-bold mb-0'>Nama &nbsp;&nbsp;&nbsp;&nbsp;: {{ session('loggedIn')['nama_depan'] . ' ' . session('loggedIn')['nama_belakang'] }}</p>
                                <p class='fs-6 fw-bold mb-0'>Alamat &nbsp;&nbsp;: {{ $profile->alamat . (($profile->alamat == NULL || $profile->alamat == '') ? '' : ',') }} {{ explode(',', $profile->kelurahan)[1] }}, {{ explode(',', $profile->kecamatan)[1] }}, {{ explode(',', $profile->kabupaten)[1] }}, {{ explode(',', $profile->provinsi)[1] }}</p>
                            </div>
                            <div class="fs-3 fw-bold text-center mb-2">
                                Prediksi penggunaan listrik Anda:
                                <span
                                    class='border-bottom pb-1 {{ $result->hasil == \App\Enums\PenggunaanListrik::SEDANG ? 'text-warning' : 'text-danger' }}'>
                                    {{ $result->hasil }}</span>
                            </div>
                            <div class="p-3 rounded-4 border mb-4 mx-3 fw-bold opacity-75 fs-6" style='max-width:45rem;'>
                                <h5 class="fs-5 text-black fw-bold text-center">Tips</h5>
                                <p>{{ $result->tips['tips_perlengkapan'] }}</p>
                                <p>Tips lainnya mengenai penggunaan listrik {{ strtolower($result->hasil->value) }} :</p>
                                <ul>
                                    <?= $result->tips['tips_pg_listrik'] ?>
                                </ul>
                            </div>
                            <div class="p-3 rounded-4 border mb-4 mx-3 fw-bold opacity-75 fs-6">
                                <h5 class="fs-5 text-black fw-bold mb-3">Data yang Anda masukkan</h5>
                                <div class="overflow-x-scroll"
                                    style="max-width: min(60rem, calc(100vw - 6rem)); overflow-x: scroll;">
                                    <table style='min-width: 29rem;'>
                                        <tr>
                                            <td>Tanggungan Keluarga</td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp; {{ $default_value['jumlah_tanggungan'] }}</td>
                                            <td>&nbsp;&nbsp;-> {{ $result->jumlah_tanggungan_konversi }}</td>
                                        </tr>
                                        <tr>
                                            <td>Luas Rumah</td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp; {{ $default_value['luas_rumah'] }}</td>
                                            <td>&nbsp;&nbsp;-> {{ $result->luas_rumah_konversi }}</td>
                                        </tr>
                                        <tr>
                                            <td>Pendapatan per bulan</td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp; {{ $default_value['pendapatan'] }}</td>
                                            <td>&nbsp;&nbsp;-> {{ $result->pendapatan_konversi }}</td>
                                        </tr>
                                        <tr>
                                            <td>Daya Listrik</td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp; {{ $default_value['daya_listrik'] }}</td>
                                            <td>&nbsp;&nbsp;-> {{ $result->daya_listrik_konversi }}</td>
                                        </tr>
                                        <tr>
                                            <td>Perlengkapan dimiliki</td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp; {{ $default_value['perlengkapan'] }}</td>
                                            <td>&nbsp;&nbsp;-> {{ $result->perlengkapan_konversi }}</td>
                                        </tr>
                                        <tr class="d-sm-none">
                                            <td colspan="9"><p class='mt-3 mb-0 fst-italic opacity-50'>Geser selengkapnya >></p></td>
                                        </tr>
                                    </table>
                                    {{-- <hr>
                                    <table>
                                        <tr>
                                            <td>P(penggunaan_listrik="SEDANG")</td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;=&nbsp; {{ $result->jml_penggunaan_sedang }} /
                                                {{ $result->jml_data }}</td>
                                            <td>&nbsp;=&nbsp; {{ $result->p_penggunaan_sedang }}</td>
                                        </tr>
                                        <tr>
                                            <td>P(penggunaan_listrik="TINGGI")</td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;=&nbsp; {{ $result->jml_penggunaan_tinggi }} /
                                                {{ $result->jml_data }}</td>
                                            <td>&nbsp;=&nbsp; {{ $result->p_penggunaan_tinggi }}</td>
                                        </tr>
                                    </table>
                                    <hr>
                                    <table>
                                        <tr>
                                            <td>P(jumlah_tanggungan_keluarga="{{ $result->jumlah_tanggungan_konversi }}" |
                                                penggunaan_listrik="SEDANG")
                                            </td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;=&nbsp; {{ $result->jml_pg_sedang_jumlah_tanggungan }}
                                                / {{ $result->jml_penggunaan_sedang }}
                                            </td>
                                            <td>&nbsp;=&nbsp; {{ $result->p_pg_sedang_jumlah_tanggungan }}</td>
                                        </tr>
                                        <tr>
                                            <td>P(jumlah_tanggungan_keluarga="{{ $result->jumlah_tanggungan_konversi }}" |
                                                penggunaan_listrik="TINGGI")</td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;=&nbsp; {{ $result->jml_pg_tinggi_jumlah_tanggungan }}
                                                / {{ $result->jml_penggunaan_tinggi }}
                                            </td>
                                            <td>&nbsp;=&nbsp; {{ $result->p_pg_tinggi_jumlah_tanggungan }}</td>
                                        </tr>
                                        <tr>
                                            <td class='pt-2'>P(luas_rumah="{{ $result->luas_rumah_konversi }}" |
                                                penggunaan_listrik="SEDANG")
                                            </td>
                                            <td class='pt-2'>&nbsp;&nbsp;&nbsp;&nbsp;=&nbsp;
                                                {{ $result->jml_pg_sedang_luas_rumah }} / {{ $result->jml_penggunaan_sedang }}
                                            </td>
                                            <td>&nbsp;=&nbsp; {{ $result->p_pg_sedang_luas_rumah }}</td>
                                        </tr>
                                        <tr>
                                            <td>P(luas_rumah="{{ $result->luas_rumah_konversi }}" |
                                                penggunaan_listrik="TINGGI")</td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;=&nbsp; {{ $result->jml_pg_tinggi_luas_rumah }} /
                                                {{ $result->jml_penggunaan_tinggi }}
                                            </td>
                                            <td>&nbsp;=&nbsp; {{ $result->p_pg_tinggi_luas_rumah }}</td>
                                        </tr>
                                        <tr>
                                            <td class='pt-2'>P(pendapatan="{{ $result->pendapatan_konversi }}" |
                                                penggunaan_listrik="SEDANG")
                                            </td>
                                            <td class='pt-2'>&nbsp;&nbsp;&nbsp;&nbsp;=&nbsp;
                                                {{ $result->jml_pg_sedang_pendapatan }} / {{ $result->jml_penggunaan_sedang }}
                                            </td>
                                            <td>&nbsp;=&nbsp; {{ $result->p_pg_sedang_pendapatan }}</td>
                                        </tr>
                                        <tr>
                                            <td>P(pendapatan="{{ $result->pendapatan_konversi }}" |
                                                penggunaan_listrik="TINGGI")</td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;=&nbsp; {{ $result->jml_pg_tinggi_pendapatan }} /
                                                {{ $result->jml_penggunaan_tinggi }}
                                            </td>
                                            <td>&nbsp;=&nbsp; {{ $result->p_pg_tinggi_pendapatan }}</td>
                                        </tr>
                                        <tr>
                                            <td class='pt-2'>P(daya_listrik="{{ $result->daya_listrik_konversi }}" |
                                                penggunaan_listrik="SEDANG")
                                            </td>
                                            <td class='pt-2'>&nbsp;&nbsp;&nbsp;&nbsp;=&nbsp;
                                                {{ $result->jml_pg_sedang_daya_listrik }} /
                                                {{ $result->jml_penggunaan_sedang }}
                                            </td>
                                            <td>&nbsp;=&nbsp; {{ $result->p_pg_sedang_daya_listrik }}</td>
                                        </tr>
                                        <tr>
                                            <td>P(daya_listrik="{{ $result->daya_listrik_konversi }}" |
                                                penggunaan_listrik="TINGGI")</td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;=&nbsp; {{ $result->jml_pg_tinggi_daya_listrik }} /
                                                {{ $result->jml_penggunaan_tinggi }}
                                            </td>
                                            <td>&nbsp;=&nbsp; {{ $result->p_pg_tinggi_daya_listrik }}</td>
                                        </tr>
                                        <tr>
                                            <td class='pt-2'>P(perlengkapan="{{ $result->perlengkapan_konversi }}" |
                                                penggunaan_listrik="SEDANG")
                                            </td>
                                            <td class='pt-2'>&nbsp;&nbsp;&nbsp;&nbsp;=&nbsp;
                                                {{ $result->jml_pg_sedang_perlengkapan }} /
                                                {{ $result->jml_penggunaan_sedang }}
                                            </td>
                                            <td>&nbsp;=&nbsp; {{ $result->p_pg_sedang_perlengkapan }}</td>
                                        </tr>
                                        <tr>
                                            <td>P(perlengkapan="{{ $result->perlengkapan_konversi }}" |
                                                penggunaan_listrik="TINGGI")</td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;=&nbsp; {{ $result->jml_pg_tinggi_perlengkapan }} /
                                                {{ $result->jml_penggunaan_tinggi }}
                                            </td>
                                            <td>&nbsp;=&nbsp; {{ $result->p_pg_tinggi_perlengkapan }}</td>
                                        </tr>
                                    </table>
                                    <hr>
                                    <table>
                                        <tr>
                                            <td>P(X | penggunaan_listrik="SEDANG") &times; P(penggunaan_listrik="SEDANG")</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;=&nbsp; {{ $result->p_pg_sedang_jumlah_tanggungan }} *
                                                {{ $result->p_pg_sedang_luas_rumah }} * {{ $result->p_pg_sedang_pendapatan }}
                                                * {{ $result->p_pg_sedang_daya_listrik }} *
                                                {{ $result->p_pg_sedang_perlengkapan }}
                                            </td>
                                            <td>&nbsp;&nbsp;&nbsp;=&nbsp; {{ $result->p_hasil_penggunaan_sedang }}</td>
                                        </tr>
                                        <tr>
                                            <td>P(X | penggunaan_listrik="TINGGI") &times; P(penggunaan_listrik="TINGGI")</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;=&nbsp; {{ $result->p_pg_tinggi_jumlah_tanggungan }} *
                                                {{ $result->p_pg_tinggi_luas_rumah }} * {{ $result->p_pg_tinggi_pendapatan }}
                                                * {{ $result->p_pg_tinggi_daya_listrik }} *
                                                {{ $result->p_pg_tinggi_perlengkapan }}
                                            </td>
                                            <td>&nbsp;&nbsp;&nbsp;=&nbsp; {{ $result->p_hasil_penggunaan_tinggi }}</td>
                                        </tr>
                                    </table> --}}
                                </div>
                            </div>
                            <hr class="text-secondary">
                        @endisset
                        <form action="/predicts" method="post" accept-charset="utf-8" class="fw-bold">
                            @csrf
                            <h2 class="fs-4 fw-bold text-center mb-4">Masukkan Data Untuk Diprediksi</h2>
                            <div class="d-flex flex-wrap flex-md-nowrap gap-3">
                                <div class="w-100 d-flex flex-column gap-3">
                                    <div>
                                        <label for="jumlah_tanggungan">Jumlah Tanggungan</label>
                                        {{-- <input type="text" name="jumlah_tanggungan"
                                            class="form-control rounded-4 mt-2 px-3 py-2" id="jumlah_tanggungan"
                                            value="{{ $default_value['jumlah_tanggungan'] ?? null }}" required> --}}
                                        <select required class="form-select rounded-4 mt-2 px-3 py-2" name="jumlah_tanggungan">
                                            <option value="" hidden>-- Pilih --</option>
                                            <option value="1">< 3 orang</option>
                                            <option value="2">3 - 5 orang</option>
                                            <option value="3">> 5 orang</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="luas_rumah">Luas Rumah (m<sup>2</sup>)</label>
                                        {{-- <input type="text" name="luas_rumah"
                                            class="form-control rounded-4 mt-2 px-3 py-2" id="luas_rumah"
                                            value="{{ $default_value['luas_rumah'] ?? null }}" required> --}}
                                        <select required class="form-select rounded-4 mt-2 px-3 py-2" name="luas_rumah">
                                            <option value="" hidden>-- Pilih --</option>
                                            <option value="1">< 10 m<sup>2</sup></option>
                                            <option value="2">10 - 20 m<sup>2</sup></option>
                                            <option value="3">> 20 m<sup>2</sup></option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="pendapatan">Besar Pendapatan per bulan (Rp)</label>
                                        {{-- <input type="text" name="pendapatan"
                                            class="form-control rounded-4 mt-2 px-3 py-2" id="pendapatan"
                                            value="{{ $default_value['pendapatan'] ?? null }}" required> --}}
                                        <select required class="form-select rounded-4 mt-2 px-3 py-2" name="pendapatan">
                                            <option value="" hidden>-- Pilih --</option>
                                            <option value="1">< 500.000</option>
                                            <option value="2">500.000 - 800.000</option>
                                            <option value="3">> 800.000</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="w-100 d-flex flex-column gap-3">
                                    <div>
                                        <label for="daya_listrik">Daya Listrik (VA)</label>
                                        {{-- <input type="text" name="daya_listrik"
                                            class="form-control rounded-4 mt-2 px-3 py-2" id="daya_listrik"
                                            value="{{ $default_value['daya_listrik'] ?? null }}" required> --}}
                                        <select required class="form-select rounded-4 mt-2 px-3 py-2" name="daya_listrik">
                                            <option value="" hidden>-- Pilih --</option>
                                            <option value="1">< 900 VA</option>
                                            <option value="2">900 - 1300 VA</option>
                                            <option value="3">> 1300 VA</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="perlengkapan">Jumlah Perlengkapan</label>
                                        {{-- <input type="text" name="perlengkapan"
                                            class="form-control rounded-4 mt-2 px-3 py-2" id="perlengkapan"
                                            value="{{ $default_value['perlengkapan'] ?? null }}" required> --}}
                                        <select required class="form-select rounded-4 mt-2 px-3 py-2" name="perlengkapan">
                                            <option value="" hidden>-- Pilih --</option>
                                            <option value="1">< 2 buah</option>
                                            <option value="2">2 - 5 buah</option>
                                            <option value="3">> 5 buah</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <input type="submit"
                                class="btn btn-primary w-100 fw-bold rounded-4 mt-1 px-3 py-2 shadow-sm mb-4 mt-4"
                                value="Mulai Prediksi!">
                        </form>
                    </div>
                </div>
            </section>
        </main>
    </header>
@endsection
