<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    {{-- <link href="{{ asset('assets/fontawesome-free-6-4-0-web/css/fontawesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/fontawesome-free-6-4-0-web/css/solid.min.css') }}" rel="stylesheet"> --}}
    <script src="https://kit.fontawesome.com/3f83f8404b.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@200;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/dselect.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/loader.css') }}">
    {{-- <link rel="preload" href="https://i.postimg.cc/HWqncFVD/2022-09-06-compressed.jpg" as="image" /> --}}
    <link rel="preload" href="{{ asset('assets/images/bg.jpg') }}" as="image" />

    <title>NBayesListrik | {{ $page_title }} </title>
    <style>
        body {
            font-family: 'Lexend Deca', sans-serif;
            font-weight: 200;
            color: rgba(0, 0, 0, 0.85);
        }

        body,
        input,
        textarea {
            font-size: 1.125rem !important;
        }

        .dselect-wrapper .form-select,
        .dselect-wrapper .form-control {
            border-radius: 1rem;
            padding-block: 0.5rem;
            padding-inline: 1rem;
            font-size: 1.125rem !important;
        }

        .dselect-wrapper .form-control {
            margin-bottom: 0.5rem;
        }

        .dselect-wrapper .dropdown-menu {
            translate: 0 -0.75rem;
            border-radius: 1rem;
            box-shadow: 0 0.25rem 1rem rgba(0, 0, 0, 0.15);
            padding: 0.75rem;
            font-size: 1.125rem !important;
        }

        .valign-center {
            vertical-align: center !important;
        }
    </style>
</head>

<body>
    {{-- Loader (loading screen) --}}
    <div class="loader bg-white">
        <div class="loading"></div>
        <p class='mt-2 fs-5 fw-bold'>Memuat...</p>
    </div>

    {{-- Background --}}
    {{-- <img src="https://i.postimg.cc/HWqncFVD/2022-09-06-compressed.jpg" alt="Para guru SD Pajangan 1"
        class='position-fixed top-0 w-100 h-100 user-select-none' style="z-index: -1; object-fit: cover;"> --}}
    <img src="{{ asset('assets/images/bg.jpg') }}" alt="Grid elektrik dan meteran listrik"
        class='position-fixed top-0 w-100 h-100 user-select-none' style="z-index: -1; object-fit: cover;">

    {{-- Content --}}
    @yield('content')

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Sweetalert v2
        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                html: '<div class="d-flex flex-column gap-2">' +
                    @foreach ($errors->all() as $error)
                        '<div style="background-color: rgba(255,0,0,0.15);" class="p-2 rounded-3">{{ $error }}</div>' +
                    @endforeach
                '</div>'
            });
        @endif
        @if ($session = session('alert'))
            Swal.fire({
                icon: '{{ $session['icon'] }}',
                title: '{{ $session['title'] }}',
                text: '{{ $session['text'] }}',
                @if ($session['icon'] != 'error')
                    showConfirmButton: false,
                    timer: 1500,
                @endif
            });
        @endif

        // Loader (loading screen)
        window.addEventListener("load", function() {
            let op = 1; // initial opacity
            const loaderEl = document.getElementsByClassName('loader')[0];
            const timer = setInterval(function() {
                if (op <= 0.1) {
                    clearInterval(timer);
                    loaderEl.style.display = 'none';
                }
                loaderEl.style.opacity = op;
                loaderEl.style.filter = 'alpha(opacity=' + op * 100 + ")";
                op -= op * 0.05;
            }, 5);
        });
    </script>
</body>

</html>
