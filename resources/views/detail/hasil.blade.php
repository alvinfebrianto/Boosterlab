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
        <!-- Navbar -->
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('img/boosterlab_logo.svg') }}" alt="Boosterlab Logo" width="170" class="d-inline-block align-text-top">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto"></ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
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
                <!-- Content pada tampilan hasil -->
                <div class="col-md-10 mb-3">
                    <div class="card shadow custom-card">
                        <div class="card-body">
                            <h3 class="card-title text-center mb-4"><strong>Hasil Kartu Menuju Sehat</strong></h3>
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
                                    <span class="bullet-point">•</span> Difteri yang menyebabkan penyumbatan jalan nafas.<br>
                                    <span class="bullet-point">•</span> Batuk Rejan (batuk 100 hari).<br>
                                    <span class="bullet-point">•</span> Tetanus.<br>
                                    <span class="bullet-point">•</span> Hepatitis B yang menyebabkan kerusakan hati.<br>
                                    <span class="bullet-point">•</span> Infeksi HIB menyebabkan meningitis (radang selaput otak).
                                </li>
                                <li class="list-group-item" style="font-size: 16px;"><strong>Polio 3</strong><br>
                                    Mencegah penularan penyakit Polio yang dapat menyebabkan lumpuh layuh pada tungkai dan atau lengan.
                                </li>
                            </ul>
                            <h4 class="card-title mt-4"><strong>Kebutuhan Gizi</strong></h4>
                            <ul class="list-group">
                                <li class="list-group-item" style="font-size: 16px;">Kebutuhan gizi pada bayi usia 0-6 bulan cukup terpenuhi dari ASI saja (ASI Eksklusif)<br>
                                    <span class="bullet-point">•</span> Berikan ASI yang pertama keluar dan berwarna kekuningan (kolostrum).<br>
                                    <span class="bullet-point">•</span> Jangan berikan makanan atau minuman selain ASI.<br>
                                    <span class="bullet-point">•</span> Susui bayi sesering mungkin.<br>
                                    <span class="bullet-point">•</span> Susui setiap bayi menginginkan, paling sedikit 8 kali sehari.<br>
                                    <span class="bullet-point">•</span> Jika bayi tidur lebih dari 3 jam, bangunkan lalu susui.<br>
                                    <span class="bullet-point">•</span> Susui dengan payudara kanan dan kiri secara bergantian.<br>
                                    <span class="bullet-point">•</span> Susui sampai payudara terasa kosong, lalu pindah ke payudara sisi lainnya.<br>
                                </li>
                            </ul>
                            <h4 class="card-title mt-4"><strong>Tahap Perkembangan</strong></h4>
                            <ul class="list-group">
                                <li class="list-group-item" style="font-size: 16px;">
                                    <span class="bullet-point">•</span> Mengangkat kepala setinggi 45 derajat.<br>
                                    <span class="bullet-point">•</span> Menggerakkan kepala dari kiri/kanan ke tengah.<br>
                                    <span class="bullet-point">•</span> Melihat dan menatap wajah anda.<br>
                                    <span class="bullet-point">•</span> Mengoceh spontan atau bereaksi dengan mengoceh.<br>
                                    <span class="bullet-point">•</span> Suka tertawa keras.<br>
                                    <span class="bullet-point">•</span> Bereaksi terkejut terhadap suara keras.<br>
                                    <span class="bullet-point">•</span> Membalas tersenyum ketika diajak bicara/tersenyum.<br>
                                    <span class="bullet-point">•</span> Mengenal ibu dengan penglihatan, penciuman, pendengaran, kontak.<br>
                                </li>
                            </ul>
                            <h4 class="card-title mt-4"><strong>Stimulasi</strong></h4>
                            <ul class="list-group">
                                <li class="list-group-item" style="font-size: 16px;"><strong>Kemampuan gerak kasar</strong><br>
                                    <span class="bullet-point">•</span> Mengangkat kepala.<br>
                                    <span class="bullet-point">•</span> Berguling-guling.<br>
                                    <span class="bullet-point">•</span> Menahan kepala tetap tegak.<br>
                                </li>
                                <li class="list-group-item" style="font-size: 16px;"><strong>Kemampuan gerak halus</strong><br>
                                    <span class="bullet-point">•</span> Melihat, meraih dan menendang mainan gantung.<br>
                                    <span class="bullet-point">•</span> Memperhatikan benda bergerak.<br>
                                    <span class="bullet-point">•</span> Melihat benda-benda kecil.<br>
                                    <span class="bullet-point">•</span> Memegang benda.<br>
                                    <span class="bullet-point">•</span> Meraba dan merasakan bentuk permukaan.<br>
                                </li>
                                <li class="list-group-item" style="font-size: 16px;"><strong>Kemampuan Bicara dan Bahasa</strong><br>
                                    <span class="bullet-point">•</span> Berbicara.<br>
                                    <span class="bullet-point">•</span> Meniru suara-suara.<br>
                                    <span class="bullet-point">•</span> Mengenali berbagai suara.<br>
                                </li>
                                <li class="list-group-item" style="font-size: 16px;"><strong>Kemampuan Sosialisasi dan Kemandirian</strong><br>
                                    <span class="bullet-point">•</span> Memberi rasa aman dan kasih sayang.<br>
                                    <span class="bullet-point">•</span> Mengajak bayi tersenyum.<br>
                                    <span class="bullet-point">•</span> Mengenali berbagai suara.<br>
                                    <span class="bullet-point">•</span> Mengajak bayi mengamati benda-benda dan keadaan di sekitarnya.<br>
                                    <span class="bullet-point">•</span> Meniru ocehan dan mimik muka bayi.<br>
                                    <span class="bullet-point">•</span> Mengayun bayi.<br>
                                    <span class="bullet-point">•</span> Menina-bobokan.<br>
                                </li>
                            </ul>
                            <h4 class="card-title mt-4"><strong>Tips Sehat</strong></h4>
                            <ul class="list-group">
                                <li class="list-group-item" style="font-size: 16px;">
                                    <span class="bullet-point">•</span> Minta anak menceritakan apa yang sedang dilakukan.<br>
                                    <span class="bullet-point">•</span> Dengarkan anak ketika ia berbicara.<br>
                                    <span class="bullet-point">•</span> Jika anak gagap, bantu anak bicara lebih lambat.<br>
                                    <span class="bullet-point">•</span> Beri kesempatan anak bermain dan mencoba sesuatu yang baru dan awasi anak.<br>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>