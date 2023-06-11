<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Data Anak | Boosterlab</title>
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
                                <label class="col-sm-2 col-form-label font-weight-bold">Tanggal Lahir</label>
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
                                <label class="col-sm-2 col-form-label font-weight-bold">Berat Lahir (Kg)</label>
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
                                <label class="col-sm-2 col-form-label font-weight-bold">Tinggi Lahir (Cm)</label>
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
    <script>
    // Mendapatkan elemen input tanggal lahir
    var tanggalLahirInput = document.getElementById('tanggal_lahir');

    tanggalLahirInput.addEventListener('change', function() {
    var tanggalLahir = new Date(this.value);
    var hariIni = new Date();

    // Menghitung selisih tahun, bulan, dan hari antara tanggal lahir dan hari ini
    var selisihTahun = hariIni.getFullYear() - tanggalLahir.getFullYear();
    var selisihBulan = hariIni.getMonth() - tanggalLahir.getMonth();
    var selisihHari = hariIni.getDate() - tanggalLahir.getDate();

    // Memeriksa apakah hari ulang tahun sudah terlewati pada tahun ini
    var ulangTahunTerlewati = (
        hariIni.getMonth() > tanggalLahir.getMonth() ||
        (hariIni.getMonth() === tanggalLahir.getMonth() && hariIni.getDate() >= tanggalLahir.getDate())
    );

    // Mengurangi 1 tahun jika hari ulang tahun belum terlewati pada tahun ini
    if (!ulangTahunTerlewati) {
        selisihTahun--;
    }

    // Mengurangi 1 bulan jika hari ini belum melewati hari lahir pada bulan ini
    if (selisihHari < 0) {
        selisihBulan--;
    }

    // Menghitung selisih hari dengan memperhatikan jumlah hari dalam bulan yang berbeda
    if (selisihBulan < 0) {
        selisihBulan += 12;
        selisihTahun--;
    }

    // Mengisi elemen <span> "umur" dengan hasil perhitungan
    var umurString = selisihTahun + ' tahun ' + selisihBulan + ' bulan ' + selisihHari + ' hari';
    document.getElementById('umur').textContent = umurString;

    // Set the value of the hidden input field with the age string
    document.getElementById('umur_hidden').value = umurString;
    });
    </script>
</body>
</html>