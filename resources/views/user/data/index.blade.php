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
                        <div class="overflow-x-scroll" style="max-width: min(60rem, calc(100vw - 6rem)); overflow-x: scroll;">
                            <table class="table rounded-4 overflow-hidden table-responsive mb-5" style="font-weight: 400;">
                                <thead class="table-primary">
                                    <th class="p-3 align-top">No.</th>
                                    <th class="p-3 align-top">Tanggungan Keluarga</th>
                                    <th class="p-3 align-top">Luas Rumah</th>
                                    <th class="p-3 align-top">Pendapatan per Bulan</th>
                                    <th class="p-3 align-top">Daya Listrik</th>
                                    <th class="p-3 align-top">Perlengkapan yang dimiliki</th>
                                    <th class="p-3 align-top">Penggunaan Listrik</th>
                                </thead>
                                <tbody>
                                    @php
                                        $i = $data['total'] - $data['offset'] + 1;
                                    @endphp
                                    @if ($data['data']->count() < 1)
                                        <tr>
                                            <td colspan='99' class="p-3 text-uppercase text-center">Tidak ada data</td>
                                        </tr>
                                    @endif
                                    @foreach ($data['data'] as $training_data)
                                        @php
                                            $i--;
                                        @endphp
                                        <tr>
                                            <td class="p-3 text-uppercase">{{ $i }}</td>
                                            <td class="p-3 text-uppercase">{{ $training_data->jumlah_tanggungan }}</td>
                                            <td class="p-3 text-uppercase">{{ $training_data->luas_rumah }}</td>
                                            <td class="p-3 text-uppercase">{{ $training_data->pendapatan }}</td>
                                            <td class="p-3 text-uppercase">{{ $training_data->daya_listrik }}</td>
                                            <td class="p-3 text-uppercase">{{ $training_data->perlengkapan }}</td>
                                            <td
                                                class="p-3 text-uppercase @if ($training_data->penggunaan_listrik == 'TINGGI') text-danger
                                                    @elseif ($training_data->penggunaan_listrik == 'SEDANG')
                                                        text-warning
                                                    @elseif ($training_data->penggunaan_listrik == 'RENDAH')
                                                        text-success @endif">
                                                {{ $training_data->penggunaan_listrik }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="99">
                                            <div class="p-3 d-flex gap-2 justify-content-center">
                                                @if ($data['offset'] >= $data['limit'])
                                                    <a class="btn btn-primary btn-sm rounded-4 px-3 py-2 shadow-sm"
                                                        href="/data/{{ $data['limit'] }}/{{ $data['offset'] - $data['limit'] }}"><i
                                                            class="fa-solid fa-arrow-left"></i>&nbsp;&nbsp;Sebelumnya</a>
                                                @else
                                                    <a class="btn btn-secondary disabled btn-sm rounded-4 px-3 py-2 shadow-sm"
                                                        href="/data/{{ $data['limit'] }}/{{ $data['offset'] - $data['limit'] }}"><i
                                                            class="fa-solid fa-arrow-left"></i>&nbsp;&nbsp;Sebelumnya</a>
                                                @endif
                                                @if (!($data['offset'] + $data['limit'] >= $data['total']))
                                                    <a class="btn btn-primary btn-sm rounded-4 px-3 py-2 shadow-sm"
                                                        href="/data/{{ $data['limit'] }}/{{ $data['offset'] + $data['limit'] }}">Berikutnya&nbsp;&nbsp;<i
                                                            class="fa-solid fa-arrow-right"></i></a>
                                                @else
                                                    <a class="btn btn-secondary disabled btn-sm rounded-4 px-3 py-2 shadow-sm"
                                                        href="/data/{{ $data['limit'] }}/{{ $data['offset'] + $data['limit'] }}">Berikutnya&nbsp;&nbsp;<i
                                                            class="fa-solid fa-arrow-right"></i></a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </header>
@endsection
