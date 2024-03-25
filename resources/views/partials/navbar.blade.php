<nav class="navbar navbar-expand-lg position-fixed top-0 bg-white border-bottom shadow w-100" style="z-index: 2;">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="/">NBayesListrik</a>
        <button class="navbar-toggler border-0 bg-primary px-3 py-2 rounded-4 my-2" type="button"
            data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa-solid fa-bars text-white my-1"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="d-flex gap-2 navbar-nav me-auto mb-2 mb-lg-0 align-items-center mt-2 mt-md-0">
                <li class="nav-item">
                    <a class="btn btn-primary rounded-4 fw-bold px-3 py-2 shadow-sm" href="/"><i
                            class="fa-solid fa-house"></i>&nbsp;&nbsp;Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-primary rounded-4 fw-bold px-3 py-2 shadow-sm" href="/data"><i
                            class="fa-solid fa-book"></i>&nbsp;&nbsp;Data Training</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-primary rounded-4 fw-bold px-3 py-2 shadow-sm" href="/predicts"><i
                            class="fa-solid fa-play"></i>&nbsp;&nbsp;Buat Prediksi</a>
                </li>
            </ul>
            <ul class="navbar-nav mb-2 mb-lg-0 align-items-center">
                <p class="mt-3 px-1 fw-bold opacity-75 d-none d-md-inline">
                    {{ session('loggedIn')['nama_depan'] . ' ' . session('loggedIn')['nama_belakang'] }}</p>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <img src="{{ Str::replaceLast('.', '-32.', session('loggedIn')['foto_user']) }}"
                            alt="User Profile"
                            class="img-fluid rounded-circle bg-white border border-primary border-4 shadow-sm"
                            style="width:2.5rem;height:2.5rem;object-fit:cover;">
                    </a>
                    <ul class="dropdown-menu shadow rounded-4 overflow-hidden" style="margin-left: -6rem;">
                        <li>
                            <a class="dropdown-item fw-bold" href="/profile">
                                <i class="fa-solid fa-user"></i>&nbsp;&nbsp;Profil Saya
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item fw-bold" href="/logout">
                                <i class="fa-solid fa-right-from-bracket"></i>&nbsp;&nbsp;Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<nav class="navbar navbar-expand-lg border-0 w-100 pb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">W</a>
    </div>
</nav>
