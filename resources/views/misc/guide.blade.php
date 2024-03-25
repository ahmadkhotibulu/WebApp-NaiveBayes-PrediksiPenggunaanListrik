@extends('layouts.main')

@section('content')
    <header>
        <main class="container-fluid">
            <section id="data-page" class="d-flex gap-5 flex-wrap justify-content-center my-5 mx-1">
                <div class="p-4 bg-white shadow-lg rounded-4 mx-auto" style='max-width: 80rem;'>
                    <div class="d-flex flex-column gap-3">
                        <div class="border-bottom pb-2 mb-2">
                            <h1 class="fs-3 mt-3 fw-bold"><i class="fa-solid fa-book"></i>&nbsp;&nbsp;{{ $page_title }}
                            </h1>
                        </div>

                        {{-- EDIT FROM HERE --}}

                        {{-- Sub Title --}}
                        <h4 class='fw-bold fs-5 mb-2 mt-2'>
                            Berikut adalah petunjuk penggunaan aplikasi website kami:
                        </h4>

                        {{-- Paragraphs --}}
                        <p  class="mb-1 text-dark" style="text-indent: 2%;">
                            <ol>
                                <li class="mb-3">Login Terlebih Dahulu</li>
                                <p  class="mb-3 text-dark">Inputkan Username dan Password</p>
                                {{-- Image (max-width, aspect-ratio, source/src) --}}
                                <img class="w-100 rounded mb-5" style='object-fit: cover; max-width:40rem;' src="{{ asset('assets/images/login.PNG') }}" alt="">      
                                
                                <li class="mb-3">Apabila belum memiliki akun, pengguna diminta untuk melakukan registrasi dengan menginputkan data-data di bawah ini:</li>
                                {{-- Image (max-width, aspect-ratio, source/src) --}}
                                <img class="w-100 mx-auto rounded mb-1" style='object-fit: cover; max-width:40rem; ' src="{{ asset('assets/images/register1.PNG') }}" alt="">
                                <img class="w-100 mx-auto rounded mb-5" style='object-fit: cover; max-width:40rem; ' src="{{ asset('assets/images/register2.PNG') }}" alt="">       
                                
                                <li class="mb-3">Setelah berhasil login akan keluar notifikasi dan sapaan sesuai dengan nama depan dan belakang yang telah diinputkan</li>
                                <img class="w-100 mx-auto rounded mb-5" style='object-fit: cover; max-width:20rem; aspect-ratio:3/2;' src="{{ asset('assets/images/berhasil.png') }}" alt="">

                                <li class="mb-3">Setelah login, pengguna dapat membuat prediksi dengan klik button "Buat Prediksi" lalu inputkan data-data yang diminta</li>
                                {{-- Image (max-width, aspect-ratio, source/src) --}}
                                <img class="w-100 mx-auto rounded mb-5" style='object-fit: cover; max-width:40rem; ' src="{{ asset('assets/images/prediksi.PNG') }}" alt="">

                                <li class="mb-3">Pengguna juga dapat mengedit profil dengan mengklik button "Profil Saya" pada pojok kanan atas. Berikut tampilannya: </li>
                                <img class="w-100 mx-auto rounded mb-1" style='object-fit: cover; max-width:40rem;' src="{{ asset('assets/images/edit2.PNG') }}" alt="">
                                <img class="w-100 mx-auto rounded mb-1" style='object-fit: cover; max-width:40rem; ' src="{{ asset('assets/images/edit3.PNG') }}" alt="">
                                <img class="w-100 mx-auto rounded mb-5" style='object-fit: cover; max-width:40rem; ' src="{{ asset('assets/images/edit4.PNG') }}" alt="">

                                <li class="mb-3">Jika telah selesai menggunakan aplikasi pengguna dapat keluar dan akan muncul notifikasi pemberitahuan berikut:</li>
                                <img class="w-100 mx-auto rounded mb-5" style='object-fit: cover; max-width:20rem; aspect-ratio:3/2;' src="{{ asset('assets/images/berhasil2.png') }}" alt="">
                            </ol>


                        </p>


                        {{-- END OF EDIT --}}

                    </div>
                </div>
                <div class="d-flex p-3 bg-white position-fixed bottom-0 end-0 rounded-4 rounded-end shadow-lg mb-4 gap-2">
                    <a class="btn btn-primary fw-bold rounded-5 mt-1 shadow-sm text-white d-flex py-2" href="/login"><i class="fa-solid fa-circle-left fs-2"></i><span class="d-none d-md-inline h-100 mt-1">&nbsp;&nbsp;Kembali</span></a>
                </div>
            </section>
        </main>
    </header>
@endsection
