<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Jadwal Imunisasi | Boosterlab</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
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
                        <li class="list-group-item"><a href="{{ route('home') }}" style="color: black; text-decoration: none;">Home</a></li>
                        <li class="list-group-item active" aria-current="true">Jadwal</li>
                        <li class="list-group-item"><a href="{{ route('blog.index') }}" style="color: black; text-decoration: none;">Artikel</a></li>
                        <li class="list-group-item"><a href="{{ route('faq') }}" style="color: black; text-decoration: none;">FAQ</a></li>
                    </ul>
                </div>
                <div class="col-md-10">
                    <div class="card border-0 shadow custom-card">
                        <div class="card-body">
                            <div class="row mb-4">
                                <label class="col-sm-2 col-form-label" style="font-weight: bold;">Nama Anak</label>
                                <div class="col-sm-10">
                                    <select class="form-select @error('nama') is-invalid @enderror" name="nama" aria-label="Default select example" required autofocus style="font-size: 17px;">
                                        <option value="" disabled selected hidden></option>
                                        @foreach ($anakList as $namaAnak)
                                            <option value="{{ $namaAnak->nama }}" {{ (isset($data) && $data->anak_id == $namaAnak->nama) ? 'selected' : '' }}>{{ $namaAnak->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="table-responsive" id="tableContainer" style="display: none;">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Bulan</th>
                                            <th scope="col">Jadwal</th>
                                            <th scope="col">Ingatkan</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($anakList as $anak)
                                            @php
                                                $tanggalLahir = \Carbon\Carbon::parse($anak->tanggal_lahir);
                                                $umur = $tanggalLahir->diff(\Carbon\Carbon::now())->format('%y tahun %m bulan %d hari');
                                                $tanggalHepatitisB = $tanggalLahir->copy();
                                                $tanggalBCG = $tanggalHepatitisB->copy()->addDays(30);
                                                $tanggalDPT1 = $tanggalBCG->copy()->addDays(30);
                                                $tanggalDPT2 = $tanggalDPT1->copy()->addDays(30);
                                                $tanggalDPT3 = $tanggalDPT2->copy()->addDays(20);
                                                $tanggalCampak = $tanggalDPT3->copy()->addDays(160);
                                            @endphp
                                            <tr>
                                                <td>0 Bulan</td>
                                                <td>{{ $tanggalHepatitisB->format('d F Y') }}<br>Hepatitis B</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>1 Bulan</td>
                                                <td>{{ $tanggalBCG->format('d F Y') }}<br>BCG<br>Polio-1</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>2 Bulan</td>
                                                <td>{{ $tanggalDPT1->format('d F Y') }}<br>DPT-1, Hepatitis B1, HIB-1<br>Polio-2</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>3 Bulan</td>
                                                <td>{{ $tanggalDPT2->format('d F Y') }}<br>DPT-2, Hepatitis B2, HIB-2<br>Polio-3</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>4 Bulan</td>
                                                <td>{{ $tanggalDPT3->format('d F Y') }}<br>DPT-3, Hepatitis B3, HIB-3<br>Polio-4<br>IPV</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>9 Bulan</td>
                                                <td>{{ $tanggalCampak->format('d F Y') }}<br>Campak-1</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script>
        document.querySelector('select[name="nama"]').addEventListener('change', function() {
            var tableContainer = document.getElementById('tableContainer');
            if (this.value !== '') {
                tableContainer.style.display = 'block';
            } else {
                tableContainer.style.display = 'none';
            }
        });
    </script>
</body>
</html>