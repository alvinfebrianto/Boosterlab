<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>FAQ | Boosterlab</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
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
    </div>
    <div class="container mt-3 mb-3">
        <div class="row">
            <div class="col-md-2 mb-3">
                <ul class="list-group custom-card">
                    <li class="list-group-item"><a href="{{ route('home') }}" style="color: black; text-decoration: none;">Home</a></li>
                    <li class="list-group-item">Jadwal</li>
                    <li class="list-group-item"><a href="{{ route('blog.index') }}" style="color: black; text-decoration: none;">Artikel</a></li>
                    <li class="list-group-item active" aria-current="true">FAQ</li>
                </ul>
            </div>
            <div class="col-md-10">
                <div class="accordion" id="accordionPanelsStayOpen">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                    <button class="accordion-button text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                        <strong>Apa itu Boosterlab?</strong>
                    </button>
                    </h2>
                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                    <div class="accordion-body">
                    Boosterlab merupakan sebuah program Dinas Kesehatan Daerah Kabupaten Tulungagung yang bertujuan untuk memfasilitasi masyarakatnya dalam imunisasi agar lebih mudah dan efisien. Website Boosterlab menyediakan berbagai fitur yang dapat diakses seperti pemantauan pertumbuhan dan kesehatan anak.
                    </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                    <button class="accordion-button text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                        <strong>Bagaimana Cara Penggunaannya?</strong>
                    </button>
                    </h2>
                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingTwo">
                    <div class="accordion-body">
                    Boosterlab dirancang untuk mempermudah masyarakat dalam menggunakannya. Pengguna hanya perlu membuat akun dan melakukan login agar dapat mengakses semua fitur pada website.
                    </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                    <button class="accordion-button text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                        <strong>Apakah Hasil dari Boosterlab Akurat?</strong>
                    </button>
                    </h2>
                    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingThree">
                    <div class="accordion-body">
                    Hasil dari website Boosterlab mengacu pada data yang digunakan, yaitu data PMK No 2 Th 2020 Tentang Standar Antropometri Anak, PMK No 66 Tentang Pemantauan Tumbuh Kembang Anak dan juga PMK No 12 Tentang Penyelenggaraan Imunisasi, yang diolah untuk memudahkan dalam membaca pertumbuhan atau perkembangan anak dengan memasukkan parameter umur, jenis kelamin, berat dan tinggi badan anak. Boosterlab ini juga dipantau langsung oleh Dinas Kesehatan Daerah Kabupaten Tulungagung sehingga akurat dan terpercaya.
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>