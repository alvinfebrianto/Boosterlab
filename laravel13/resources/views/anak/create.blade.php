<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tambah Data Anak | Boosterlab</title>
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
                        <li class="list-group-item">Jadwal</li>
                        <li class="list-group-item"><a href="{{ route('blog.index') }}" style="color: black; text-decoration: none;">Artikel</a></li>
                        <li class="list-group-item"><a href="{{ route('faq') }}" style="color: black; text-decoration: none;">FAQ</a></li>
                    </ul>
                </div>
                <div class="col-md-10">
                    <div class="card border-0 shadow custom-card">
                        <div class="card-body">
                            <form action="{{ route('anak.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-4">
                                    <label class="col-sm-2 col-form-label" style="font-weight: bold;">Nama Anak</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" required autofocus value="{{ old('nama') }}">
                                        @error('nama')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-sm-2 col-form-label" style="font-weight: bold;">Jenis Kelamin</label>
                                    <div class="col-sm-10">
                                        <select class="form-select @error('gender') is-invalid @enderror" name="gender" aria-label="Default select example" required style="font-size: 15px;">
                                            <option value="" disabled selected hidden></option>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                        @error('gender')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-sm-2 col-form-label" style="font-weight: bold;">Tanggal Lahir</label>
                                    <div class="col-sm-10">
                                        <input type="date" id="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" required value="{{ old('tanggal_lahir') }}">
                                        @error('tanggal_lahir')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-4" style="display: none;">
                                    <label class="col-sm-2 col-form-label font-weight-bold">Umur</label>
                                    <div class="col-sm-10">
                                        <span id="umur"></span>
                                        <input type="hidden" id="umur_hidden" name="umur" value="{{ old('umur') }}">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-sm-2 col-form-label" style="font-weight: bold;">Berat Lahir (Kg)</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('berat_lahir') is-invalid @enderror" name="berat_lahir" required value="{{ old('berat_lahir') }}">
                                        @error('berat_lahir')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <label class="col-sm-2 col-form-label" style="font-weight: bold;">Tinggi Lahir (Cm)</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('tinggi_lahir') is-invalid @enderror" name="tinggi_lahir" required value="{{ old('tinggi_lahir') }}">
                                        @error('tinggi_lahir')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                            </form> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var tanggalLahirInput = document.getElementById('tanggal_lahir');

        tanggalLahirInput.addEventListener('change', function() {
            var tanggalLahir = moment(this.value, 'YYYY-MM-DD');
            var umur = tanggalLahir.fromNow(true);

            document.getElementById('umur').textContent = umur;
            document.getElementById('umur_hidden').value = umur;
        });
    </script>
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>