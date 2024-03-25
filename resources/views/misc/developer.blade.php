@extends('layouts.main')

@section('content')
    <header>
        <main class="container-fluid">
            <section id="data-page" class="d-flex gap-5 flex-wrap justify-content-center my-5 mx-1">
                <div class="p-4 bg-white shadow-lg rounded-4 mx-auto" style='width: 100%;'>
                    <div class="d-flex flex-column gap-3">
                        <div class="border-bottom pb-2 mb-2">
                            <h1 class="fs-3 mt-3 fw-bold"><i class="fa-solid fa-book"></i>&nbsp;&nbsp;{{ $page_title }}
                            </h1>
                        </div>

                        {{-- EDIT FROM HERE --}}

                        <div class="row justify-content-center">
                                <div class="card  me-3" style="max-width: 18rem;">
                                <img src="{{asset('assets/images/ahmad.jpg')}}" class="card-img-top mt-2" alt="Pengembang 1">
                                <div class="card-body">
                                    <h5 class="card-title">Ahmad Khotibul Umam</h5>
                                    <p class="card-text">20330047</p>
                                </div>
                                </div>
                                <div class="card  me-3" style="max-width: 18rem;">
                                <img src="{{asset('assets/images/marlin.jpg')}}" class="card-img-top mt-2" alt="Pembimbing">
                                <div class="card-body">
                                    <h5 class="card-title">Yumarlin MZ., S.Kom., M.Pd., M.Kom.</h5>
                                    <p class="card-text">Dosen Pembimbing</p>
                                </div>
                                </div>
                                <div class="card  me-3" style="max-width: 18rem;">
                                <img src="{{asset('assets/images/sabila.png')}}" class="card-img-top mt-2" alt="Pengembang 2">
                                <div class="card-body">
                                    <h5 class="card-title">Sabila Nafisah Amallia</h5>
                                    <p class="card-text">20330045</p>
                                </div>
                                </div>
                        </div>



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
