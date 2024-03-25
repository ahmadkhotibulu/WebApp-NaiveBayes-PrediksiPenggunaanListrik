@extends('layouts.main')

@section('content')
    <main class="container-fluid">
        <section id="login-page" class="d-flex align-items-center justify-content-center min-vh-100 mx-1">
            <div class="p-4 my-5 shadow-lg rounded-4 bg-white fw-bold w-100" style="max-width: 32rem;">
                <form action="/login" method="post" accept-charset="utf-8">
                    @csrf
                    <div class="d-flex flex-column gap-3">
                        <div class="border-bottom pb-2 mb-2">
                            <h1 class="fs-3 mt-3 fw-bold text-center"><i
                                    class="fa-solid fa-right-to-bracket"></i>&nbsp;&nbsp;Selamat Datang di Aplikasi Prediksi Penggunaan Listrik Rumah Tangga</h1>
                        </div>
                        <div>
                            <label for="username"><i class="fa-solid fa-user"></i>&nbsp;&nbsp;Username</label>
                            <input type="text" name="username" class="form-control mt-2 rounded-4 px-3 py-2"
                                id="username" required>
                        </div>
                        <div>
                            <label for="password"><i class="fa-solid fa-key"></i>&nbsp;&nbsp;Password</label>
                            <input type="password" name="password" class="form-control mt-2 rounded-4 px-3 py-2"
                                id="password" required>
                        </div>
                        <input type="submit" class="btn btn-primary w-100 fw-bold rounded-4 mt-1 px-3 py-2 shadow-sm"
                            value="Login">
                        <p class="text-center" style="font-size: 0.85em;">Belum memiliki akun? <a
                                href="/register">Register</a> disini.</p>
                    </div>
                </form>
            </div>
            <div class="d-flex p-3 bg-white position-absolute bottom-0 end-0 rounded-4 rounded-end shadow-lg mb-4 gap-2">
                <a class="btn btn-primary fw-bold rounded-5 mt-1 shadow-sm text-white d-flex py-2" href="/guide"><i class="fa-solid fa-circle-question fs-2"></i><span class="d-none d-md-inline h-100 mt-1">&nbsp;&nbsp;Petunjuk Penggunaan</span></a>
                <a class="btn btn-primary fw-bold rounded-5 mt-1 shadow-sm text-white d-flex py-2" href="/developer"><i class="fa-solid fa-circle-info fs-2"></i><span class="d-none d-md-inline h-100 mt-1">&nbsp;&nbsp;Pengembang</span></a>
            </div>
        </section>
    </main>
@endsection
