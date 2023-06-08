<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit | Boosterlab</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .custom-card {
            border-radius: 1em;
        }
    </style>
</head>
<body style="background: #3b71b9">
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow custom-card">
                    <div class="card-body">
                        <form action="{{ route('anak.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-4">
                                <label class="col-sm-2 col-form-label font-weight-bold">Nama Anak</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" required value="{{ old('nama') }}">
                                    <!-- Pesan error untuk title -->
                                    @error('nama')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-sm-2 col-form-label font-weight-bold">Jenis Kelamin</label>
                                <div class="col-sm-10">
                                    <select class="custom-select @error('gender') is-invalid @enderror" name="gender" aria-label="Default select example" required>
                                        <option value="" disabled selected hidden></option>
                                        <option value="1">Laki-laki</option>
                                        <option value="2">Perempuan</option>
                                    </select>
                                    <!-- Pesan error untuk gender -->
                                    @error('gender')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-sm-2 col-form-label font-weight-bold">Tanggal Lahir</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" required value="{{ old('tanggal_lahir') }}">
                                    <!-- Pesan error untuk tanggal_lahir -->
                                    @error('tanggal_lahir')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-sm-2 col-form-label font-weight-bold">Berat Lahir (Kg)</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('berat_lahir') is-invalid @enderror" name="berat_lahir" required value="{{ old('berat_lahir') }}">
                                    <!-- Pesan error untuk berat_lahir -->
                                    @error('berat_lahir')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-5">
                                <label class="col-sm-2 col-form-label font-weight-bold">Tinggi Lahir (Cm)</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('tinggi_lahir') is-invalid @enderror" name="tinggi_lahir" required value="{{ old('tinggi_lahir') }}">
                                    <!-- Pesan error untuk tinggi_lahir -->
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
</script>
</body>
</html>