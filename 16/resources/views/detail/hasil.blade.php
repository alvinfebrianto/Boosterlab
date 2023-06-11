<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Detail Anak | Boosterlab</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>.custom-card{border-radius: 1em;}</style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('img/boosterlab_logo.svg') }}" alt="Boosterlab Logo" width="170" class="d-inline-block align-text-top">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto"></ul>
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <strong>{{ __('Logout') }}</strong>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container mt-3 mb-3">
            <div class="row justify-content-center">
                <div class="col-md-2 mb-3">
                    <ul class="list-group custom-card">
                        <li class="list-group-item active" aria-current="true">Home</li>
                        <li class="list-group-item"><a href="{{ route('jadwal') }}" style="color: black; text-decoration: none;">Jadwal</a></li>
                        <li class="list-group-item"><a href="{{ route('blog.index') }}" style="color: black; text-decoration: none;">Artikel</a></li>
                        <li class="list-group-item"><a href="{{ route('faq') }}" style="color: black; text-decoration: none;">FAQ</a></li>
                    </ul>
                </div>
                <div class="col-md-10 mb-3">
                    <div class="card shadow custom-card">
                        <div class="card-body">
                            <h3 class="card-title text-center mb-4"><strong>Hasil Kartu Menuju Sehat</strong></h3>
                            <h5 class="card-title"><strong>Profil</strong></h5>
                            <ul class="list-group">
                                <li class="list-group-item">Nama Anak: {{ $anak->nama }}</li>
                                <li class="list-group-item">Jenis Kelamin: {{ $anak->gender }}</li>
                                <li class="list-group-item">Umur: {{ $anak->umur }}</li>
                                <li class="list-group-item">Berat: {{ $anak->berat_lahir }} Kg</li>
                                <li class="list-group-item">Tinggi: {{ $anak->tinggi_lahir }} Cm</li>
                            </ul>
                            <h5 class="card-title mt-4"><strong>Imunisasi</strong></h5>
                            <ul class="list-group">
                                <li class="list-group-item"><strong>DPT2 - Hepatitis B2 - HIB 2</strong></li>
                                <li class="list-group-item">Mencegah penularan penyakit:</li>
                                <li class="list-group-item">- Difteri yang menyebabkan penyumbatan jalan nafas</li>
                                <li class="list-group-item">- Batuk Rejan (batuk 100 hari)</li>
                                <li class="list-group-item">- Tetanus</li>
                                <li class="list-group-item">- Hepatitis B yang menyebabkan kerusakan hati</li>
                                <li class="list-group-item">- Infeksi HIB menyebabkan meningitis (radang selaput otak)</li>
                                <li class="list-group-item"><strong>Polio 3</strong></li>
                                <li class="list-group-item">Mencegah penularan penyakit Polio yang dapat menyebabkan lumpuh layuh pada tungkai dan atau lengan</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>