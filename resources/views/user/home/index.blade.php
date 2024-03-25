@extends('layouts.main')

@section('content')
    <header>
        @include('partials.navbar')
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
                            Penggunaan Listrik Rumah Tangga
                        </h4>

                        {{-- Paragraphs --}}
                        <div class="row">
                            <div class="col-md-5">
                                <img class="w-100 mx-auto rounded mb-2" style='object-fit: cover; width: 100%; height:100%;aspect-ratio:3/2;' src="{{ asset('assets/images/tower.jpg') }}" alt="">
                            </div>
                            <div class="col-md-7">
                                <p class="mb-2 text-dark" style="text-indent: 5%;">
                                    Kemajuan teknologi di segala bidang begitu pesat sehingga mengakibatkan peningkatan kebutuhan akan tenaga listrik. Listrik merupakan sumber energi yang sangat penting bagi kelangsungan aktivitas manusia, baik perorangan, kelompok masyarakat maupun industri. Dengan kata lain energi listrik dapat digunakan untuk kegiatan yang sangat bermanfaat. Saat ini, energi listrik tergolong sebagai kebutuhan pokok di wilayah yang digunakan oleh empat kelompok konsumen listrik. Kelompok pengguna adalah kelompok rumah tangga, industri, komersial dan umum. Kelompok rumah tangga merupakan pengguna listrik terbesar setiap tahunnya.
                                </p>
                                <p class="mb-2 text-dark" style="text-indent: 5%;">
                                    Menggunakan alat listrik membutuhkan pembangkit listrik dari sumber energi. Penggunaan listrik yang tidak bijak tentunya akan mempengaruhi tingkat konsumsi listrik yang juga akan berdampak pada menipisnya persediaan listrik, karena kebutuhan listrik lebih besar dari pada penyediaan listrik.
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="col-md-7">
                                <p class="mb-2 text-dark" style="text-indent: 5%;">
                                    Dalam beberapa tahun terakhir, dengan meningkatnya kesadaran akan masalah lingkungan dan efisiensi energi, semakin banyak rumah tangga yang melakukan upaya untuk mengurangi konsumsi listrik. Namun, untuk mengoptimalkan penggunaan listrik, diperlukan pemahaman yang lebih baik tentang pola dan faktor yang mempengaruhinya.
                                </p>
                                <p class="mb-2 text-dark" style="text-indent: 5%;">
                                    Dalam konteks ini, metode klasifikasi Naive Bayes telah terbukti menjadi salah satu algoritma yang efektif dalam memprediksi besarnya penggunaan listrik rumah tangga. Metode ini berdasarkan teori probabilitas dan mengasumsikan bahwa semua fitur atau variabel prediktor adalah independen secara kondisional. Dengan mengumpulkan data historis tentang konsumsi listrik dan faktor-faktor yang mempengaruhinya, kita dapat melatih model Naive Bayes untuk mempelajari pola-pola tersebut dan melakukan prediksi yang akurat.
                                </p>
                            </div>
                            <div class="col-md-5">
                                <img class="w-100 mx-auto rounded mb-2" style='object-fit: cover; width: 100%; height:100%;aspect-ratio:3/2;' src="{{ asset('assets/images/pulsa.jpg') }}" alt="">
                            </div>
                        </div>
                        

                        {{-- END OF EDIT --}}

                    </div>
                </div>
            </section>
        </main>
    </header>
@endsection
