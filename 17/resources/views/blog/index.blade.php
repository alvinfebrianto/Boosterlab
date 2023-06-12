<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Blog | Boosterlab</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>.custom-card{border-radius: 1em;}.text-truncate-container a{overflow:hidden;-webkit-line-clamp:3;-webkit-box-orient:vertical;display:-webkit-box;}.description-content{overflow:hidden;text-overflow:ellipsis;white-space:normal;-webkit-line-clamp:5;-webkit-box-orient:vertical;display:-webkit-box;}</style>
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
    </div>
    <div class="container mt-3 mb-3">
        <div class="row justify-content-center">
            <div class="col-md-2 mb-3">
                <ul class="list-group custom-card">
                    <!-- Sidebar -->
                    <li class="list-group-item"><a href="{{ route('home') }}" style="color: black; text-decoration: none;">Home</a></li>
                    <li class="list-group-item"><a href="{{ route('jadwal') }}" style="color: black; text-decoration: none;">Jadwal</a></li>
                    <li class="list-group-item active" aria-current="true">Artikel</li>
                    <li class="list-group-item"><a href="{{ route('faq') }}" style="color: black; text-decoration: none;">FAQ</a></li>
                </ul>
            </div>
            <div class="col-md-10">
                <div class="card border-0 shadow custom-card">
                    <div class="card-body">
                        <div class="table table-borderless">
                            @forelse ($artikels as $artikel)
                                <div class="row mb-3">
                                    <div class="col-md-5">
                                        <!-- Menampilkan gambar artikel -->
                                        <img src="{{ Storage::url('public/artikels/').$artikel->image }}" class="rounded" style="width: 23rem">
                                    </div>
                                    <div class="col-md-7">
                                        <div class="text-truncate-container">
                                            <!-- Link untuk menuju halaman detail artikel -->
                                            <a href="{{ route('artikel.show', $artikel->id) }}" class="h5">{{ $artikel->title }}</a>
                                            <br>
                                            <div class="description-content">{!! $artikel->content !!}</div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="alert alert-danger">
                                    Artikel belum tersedia.
                                </div>
                            @endforelse
                        </div>
                        {{ $artikels->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>