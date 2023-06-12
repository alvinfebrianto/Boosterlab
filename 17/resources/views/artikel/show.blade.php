<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel | Boosterlab</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>.custom-card{border-radius: 1em;}</style>
</head>
<body>
    <div class="container mt-4 mb-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm custom-card">
                    <div class="card-body">
                        <img src="{{ asset('storage/artikels/'.$artikel->image) }}" class="w-100 rounded">
                        <hr>
                        <!-- Judul Artikel -->
                        <h4 class="fw-bold">{{ $artikel->title }}</h4>
                        <!-- Konten Artikel -->
                        <p class="tmt-3">
                            {!! $artikel->content !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>