<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Detail Anak | Boosterlab</title>
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
                            <h3 class="card-title text-center mb-4"><strong>Hasil Kartu Imunisasi Anak</strong></h3>
                            <h4 class="card-title"><strong>Profil</strong></h4>
                            <ul class="list-group">
                                <li class="list-group-item" style="font-size: 16px;">Nama Anak: {{ $anak->nama }}</li>
                                <li class="list-group-item" style="font-size: 16px;">Jenis Kelamin: {{ $anak->gender }}</li>
                                <li class="list-group-item" style="font-size: 16px;">Umur: {{ $anak->umur }}</li>
                                <li class="list-group-item" style="font-size: 16px;">Berat: {{ rtrim(rtrim($anak->berat_lahir, '0'), '.') }} Kg</li>
                                <li class="list-group-item" style="font-size: 16px;">Tinggi: {{ rtrim(rtrim($anak->tinggi_lahir, '0'), '.') }} Cm</li>
                            </ul>
                            <h4 class="card-title mt-4"><strong>Imunisasi</strong></h4>
                            <ul class="list-group">
                                <li class="list-group-item" style="font-size: 16px;"><strong>DPT2 - Hepatitis B2 - HIB 2</strong><br>
                                    Mencegah penularan penyakit:<br>
                                    <span class="bullet-point">•</span> Difteri ... <br>
                                    <span class="bullet-point">•</span> Batuk Rejan ... <br>
                                    <span class="bullet-point">•</span> Tetanus.<br>
                                    <span class="bullet-point">•</span> Hepatitis B ... <br>
                                    <span class="bullet-point">•</span> Infeksi HIB ... 
                                </li>
                                <li class="list-group-item" style="font-size: 16px;"><strong>Polio 3</strong><br>
                                    Mencegah penularan penyakit Polio ...
                                </li>
                            </ul>
                            <h4 class="card-title mt-4"><strong>Kebutuhan Gizi</strong></h4>
                            <ul class="list-group">
                                <li class="list-group-item" style="font-size: 16px;">Kebutuhan gizi pada bayi usia 0-6 bulan cukup terpenuhi dari ASI saja (ASI Eksklusif)<br>
                                    <span class="bullet-point">•</span> Berikan ASI ... <br>
                                    <span class="bullet-point">•</span> Jangan berikan ... <br>
                                    ...
                                </li>
                            </ul>
                            <h4 class="card-title mt-4"><strong>Tahap Perkembangan</strong></h4>
                            <ul class="list-group">
                                <li class="list-group-item" style="font-size: 16px;">
                                    <span class="bullet-point">•</span> Mengangkat kepala ... <br>
                                    ...
                                </li>
                            </ul>
                            <h4 class="card-title mt-4"><strong>Stimulasi</strong></h4>
                            <ul class="list-group">
                                <li class="list-group-item" style="font-size: 16px;"><strong>Kemampuan gerak kasar</strong><br>...</li>
                                <li class="list-group-item" style="font-size: 16px;"><strong>Kemampuan gerak halus</strong><br>...</li>
                                <li class="list-group-item" style="font-size: 16px;"><strong>Kemampuan Bicara dan Bahasa</strong><br>...</li>
                                <li class="list-group-item" style="font-size: 16px;"><strong>Kemampuan Sosialisasi dan Kemandirian</strong><br>...</li>
                            </ul>
                            <h4 class="card-title mt-4"><strong>Tips Sehat</strong></h4>
                            <ul class="list-group">
                                <li class="list-group-item" style="font-size: 16px;">...</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
