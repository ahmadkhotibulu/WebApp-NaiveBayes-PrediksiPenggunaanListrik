@extends('layouts.main')

@section('content')
    <header>
        @include('partials.navbar')
    </header>
    <main class="container-fluid">
        <section id="profile-page" class="d-flex gap-5 flex-wrap justify-content-center my-5 mx-1">
            <div class="">
                <div class="p-4 bg-white shadow-lg rounded-4 d-flex flex-column gap-3">
                    <div class="">
                        <img src="{{ session('loggedIn')['foto_user'] }}" alt="User Profile"
                            class="img-fluid rounded-circle bg-white border border-primary border-5 shadow mt-3"
                            style="width:15rem;height:15rem;object-fit:cover;">
                        <p class="opacity-75 fs-5 text-center my-0 mt-2 fw-bold">{{ '@' . session('loggedIn')['username'] }}
                        </p>
                    </div>
                    <button class="btn btn-primary w-100 fw-bold rounded-4 mt-1 px-3 py-2 shadow-sm mb-4"
                        data-bs-toggle="modal" data-bs-target="#exampleModal">Ubah Foto</button>
                </div>
            </div>
            <div class="w-100 d-flex flex-column gap-5" style="max-width:48rem;">
                <div class="bg-white shadow-lg p-4 rounded-4 fw-bold">
                    <form action="/profile" method="post" accept-charset="utf-8">
                        @csrf
                        <div class="d-flex flex-column gap-3">
                            <div class="border-bottom pb-2 mb-2">
                                <h1 class="fs-3 mt-3 fw-bold">
                                    <i class="fa-solid fa-address-card"></i>&nbsp;&nbsp;{{ $page_title }}
                                </h1>
                            </div>
                            <div>
                                <label for="nama_depan">Nama Depan</label>
                                <input type="text" name="nama_depan" class="form-control rounded-4 mt-2 px-3 py-2"
                                    id="nama_depan" value="{{ session('loggedIn')['nama_depan'] }}" required>
                            </div>
                            <div>
                                <label for="nama_belakang">Nama Belakang</label>
                                <input type="text" name="nama_belakang" class="form-control rounded-4 mt-2 px-3 py-2"
                                    id="nama_belakang" value="{{ session('loggedIn')['nama_belakang'] }}">
                            </div>
                            <div>
                                <label for="provinsi">Provinsi</label>
                                <select name="provinsi" id="provinsi" class="form-select mt-2 rounded-4" required>
                                    <option value="">Pilih Provinsi...</option>
                                    <option value="{{ $profile->provinsi }}"selected>
                                        {{ Str::of($profile->provinsi)->split('/[,]/')[1] }}
                                    </option>
                                </select>
                            </div>
                            <div>
                                <label for="kabupaten">Kabupaten</label>
                                <select name="kabupaten" id="kabupaten" class="form-select mt-2 rounded-4" required>
                                    <option value="">Pilih Kabupaten...</option>
                                    <option value="{{ $profile->kabupaten }}"selected>
                                        {{ Str::of($profile->kabupaten)->split('/[,]/')[1] }}
                                    </option>
                                </select>
                            </div>
                            <div>
                                <label for="kecamatan">Kecamatan</label>
                                <select name="kecamatan" id="kecamatan" class="form-select mt-2 rounded-4" required>
                                    <option value="">Pilih Kecamatan...</option>
                                    <option value="{{ $profile->kecamatan }}"selected>
                                        {{ Str::of($profile->kecamatan)->split('/[,]/')[1] }}
                                    </option>
                                </select>
                            </div>
                            <div>
                                <label for="kelurahan">Kelurahan</label>
                                <select name="kelurahan" id="kelurahan" class="form-select mt-2 rounded-4" required>
                                    <option value="">Pilih Kelurahan...</option>
                                    <option value="{{ $profile->kelurahan }}"selected>
                                        {{ Str::of($profile->kelurahan)->split('/[,]/')[1] }}
                                    </option>
                                </select>
                            </div>
                            <div>
                                <label for="alamat">Alamat <span class="opacity-75"
                                        style="font-size:.85em;">(opsional)</span></label>
                                <textarea name="alamat" id="alamat" class="form-control rounded-4 mt-2 px-3 py-2"
                                    style="resize:none;min-height:6rem;">{{ $profile->alamat }}</textarea>
                            </div>
                            <input type="submit"
                                class="btn btn-primary w-100 fw-bold rounded-4 mt-1 px-3 py-2 shadow-sm mb-4"
                                value="Simpan">
                        </div>
                    </form>
                </div>
                <div class="bg-white shadow p-4 rounded-4 fw-bold">
                    <form action="/profile/password" method="post" accept-charset="utf-8">
                        @csrf
                        <div class="d-flex flex-column gap-3">
                            <div class="border-bottom pb-2 mb-2">
                                <h1 class="fs-3 mt-3 fw-bold"><i class="fa-solid fa-lock"></i>&nbsp;&nbsp;Keamanan</h1>
                            </div>
                            <div>
                                <label for="password_lama">Password Lama</label>
                                <input type="password" name="password_lama" class="form-control rounded-4 mt-2 px-3 py-2"
                                    id="password_lama" required>
                            </div>
                            <div>
                                <label for="password">Password Baru</label>
                                <input type="password" name="password" class="form-control rounded-4 mt-2 px-3 py-2"
                                    id="password" required>
                            </div>
                            <div>
                                <label for="password_confirmation">Ulangi Password Baru</label>
                                <input type="password" name="password_confirmation"
                                    class="form-control rounded-4 mt-2 px-3 py-2" id="password_confirmation" required>
                            </div>
                            <input type="submit"
                                class="btn btn-primary w-100 fw-bold rounded-4 mt-1 px-3 py-2 shadow-sm mb-4"
                                value="Ubah Password">
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content fw-bold">
                <form action="/profile/avatar" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"><i
                                class="fa-solid fa-image-portrait"></i>&nbsp;&nbsp;Foto Profil</h1>
                    </div>
                    <div class="modal-body">
                        <div>
                            <label for="foto_user">Upload Foto <span class="opacity-75"
                                    style='font-size:.85em;'>(maksimum 1.5MB)</span></label>
                            <input type="file" name="foto_user" class="form-control rounded-4 mt-2 px-3 py-2"
                                id="foto_user" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="reset" class="btn btn-secondary" data-bs-dismiss="modal" value="Batal">
                        <input type="submit" class="btn btn-primary" value="Simpan">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ URL::asset('assets/js/dselect.js') }}"></script>
    <script src="{{ URL::asset('assets/js/dselect-address.js') }}"></script>
    <script>
        dselectAddressRemoveOptionOnChange = false;
        provinsiEl.dispatchEvent(new Event('change'));
        kabupatenEl.dispatchEvent(new Event('change'));
        kecamatanEl.dispatchEvent(new Event('change'));
        dselectAddressRemoveOptionOnChange = true;
    </script>
@endsection
