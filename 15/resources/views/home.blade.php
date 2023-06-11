<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Boosterlab') }}</title>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>.custom-card{border-radius: 1em;}.toast-success{background-color: #28a745 !important;}</style>
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
                    <ul class="navbar-nav me-auto">
                    </ul>
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
                <div class="col-md-10">
                    <div class="card border-0 shadow custom-card">
                        <div class="card-body">
                            <a href="{{ route('anak.create') }}" class="btn btn-md btn-success mb-3">Tambah Data Anak</a>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Jenis Kelamin</th>
                                            <th scope="col">Tanggal Lahir</th>
                                            <th scope="col">Umur</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $sortedAnaks = $anaks->sortBy('umur');
                                            $counter = 1;
                                        @endphp

                                        @forelse ($sortedAnaks as $anak)
                                            <tr>
                                                <td>{{ $counter++ }}</td>
                                                <td>{{ $anak->nama }}</td>
                                                <td>{{ $anak->gender }}</td>
                                                <td>{{ $anak->tanggal_lahir }}</td>
                                                <td>
                                                    @php
                                                        $tanggalLahir = \Carbon\Carbon::parse($anak->tanggal_lahir);
                                                        $umur = $tanggalLahir->diff(\Carbon\Carbon::now());
                                                        $umurBulan = ($umur->format('%y') * 12) + $umur->format('%m');
                                                        echo $umurBulan . ' bulan';
                                                    @endphp
                                                </td>
                                                <td class="text-center">
                                                    <form onsubmit="return confirm('Apakah Anda Yakin?');" action="{{ route('anak.destroy', $anak->nomor) }}" method="POST">
                                                        <a href="{{ route('detail.index', $anak->nomor) }}" class="btn btn-sm btn-dark mb-1">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        <a href="{{ route('anak.edit', $anak->nomor) }}" class="btn btn-sm btn-primary mb-1">
                                                            <i class="bi bi-pencil"></i>
                                                        </a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger mb-1">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7">
                                                    <div class="alert alert-danger">
                                                        Data Anak Masih Kosong.
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{ $anaks->links() }}
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