<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tambah Data Detail Anak | Boosterlab</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>.custom-card{border-radius: 1em;}</style>
</head>
<body>
    <div class="container mt-3 mb-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-0 shadow custom-card">
                    <div class="card-body">
                        <form action="{{ route('detail.store', ['anak' => $anak]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="row mb-4">
                                <label class="col-sm-2 col-form-label" style="font-weight: bold;">Bulan ke-</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="{{ $bulan }}" disabled readonly>
                                    <input type="hidden" name="bulan" value="{{ $bulan }}">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-sm-2 col-form-label" style="font-weight: bold;">Berat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('berat') is-invalid @enderror" name="berat" required autofocus value="{{ old('berat') }}">
                                    @error('berat')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-sm-2 col-form-label" style="font-weight: bold;">Tinggi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('tinggi') is-invalid @enderror" name="tinggi" required autofocus value="{{ old('tinggi') }}">
                                    @error('tinggi')
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
</body>
</html>