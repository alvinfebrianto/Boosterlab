<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tambah Data Anak | Boosterlab</title>
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
                                <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>