@extends('layouts.main')

@section('content')
    <main class="container-fluid">
        <section id="login-page" class="d-flex align-items-center justify-content-center min-vh-100 mx-1">
            <div class="p-4 my-5 shadow-lg rounded-3 bg-white fw-bold w-100" style="max-width: 48rem;">
                <form action="/register" method="post" accept-charset="utf-8">
                    @csrf
                    <div class="d-flex flex-column gap-3">
                        <div class="border-bottom pb-2 mb-2">
                            <h1 class="fs-3 mt-3 fw-bold"><i class="fa-solid fa-address-card"></i>&nbsp;&nbsp;Register Akun
                            </h1>
                        </div>
                        <div>
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control mt-2 px-3 py-2 rounded-4"
                                id="username" required>
                        </div>
                        <div>
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control mt-2 px-3 py-2 rounded-4"
                                id="password" required>
                        </div>
                        <div>
                            <label for="password_confirmation">Ulangi Password</label>
                            <input type="password" name="password_confirmation"
                                class="form-control mt-2 px-3 py-2 rounded-4" id="password_confirmation" required>
                        </div>
                        <div>
                            <label for="nama_depan">Nama Depan</label>
                            <input type="text" name="nama_depan" class="form-control mt-2 px-3 py-2 rounded-4"
                                id="nama_depan" required>
                        </div>
                        <div>
                            <label for="nama_belakang">Nama Belakang</label>
                            <input type="text" name="nama_belakang" class="form-control mt-2 px-3 py-2 rounded-4"
                                id="nama_belakang">
                        </div>
                        <div>
                            <label for="provinsi">Provinsi</label>
                            <select name="provinsi" id="provinsi" class="form-select rounded-4 mt-2" required>
                                <option value="">Pilih Provinsi...</option>
                            </select>
                        </div>
                        <div>
                            <label for="kabupaten">Kabupaten</label>
                            <select name="kabupaten" id="kabupaten" class="form-select rounded-4 mt-2" required>
                                <option value="">Pilih Kabupaten...</option>
                            </select>
                        </div>
                        <div>
                            <label for="kecamatan">Kecamatan</label>
                            <select name="kecamatan" id="kecamatan" class="form-select rounded-4 mt-2" required>
                                <option value="">Pilih Kecamatan...</option>
                            </select>
                        </div>
                        <div>
                            <label for="kelurahan">Kelurahan</label>
                            <select name="kelurahan" id="kelurahan" class="form-select rounded-4 mt-2" required>
                                <option value="">Pilih Kelurahan...</option>
                            </select>
                        </div>
                        <div>
                            <label for="alamat">Alamat <span class="opacity-75"
                                    style="font-size:.85em;">(opsional)</span></label>
                            <textarea name="alamat" id="alamat" class="form-control mt-2 px-3 py-2 rounded-4"
                                style="resize:none;min-height:6rem;"></textarea>
                        </div>
                        <input type="submit" class="btn btn-primary w-100 fw-bold mt-1 px-3 py-2 rounded-4 shadow-sm"
                            value="Register">
                        <p class="text-center" style="font-size: 0.85em;">Sudah memiliki akun? <a href="/login">Login</a>
                            disini.</p>
                    </div>
                </form>
            </div>
        </section>
    </main>
    <script src="{{ URL::asset('assets/js/dselect.js') }}"></script>
    <script src="{{ URL::asset('assets/js/dselect-address.js') }}"></script>
@endsection
