<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="assets/css/index.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif !important;
        }
    </style>
    <title>Beranda</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-navy">
        <a class="navbar-brand" href="index.php">Beasiswa Mahasiswa</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="form.php">Daftar</a></li>
                <li class="nav-item"><a class="nav-link" href="hasil.php">Hasil</a></li>
            </ul>
        </div>
    </nav>
    <div class="container mt-5">
        <h1 class="text-center">Selamat Datang di Sistem Pendaftaran Beasiswa Mahasiswa S1</h1>
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="assets/images/foto1.jpg" class="d-block w-100" alt="Slide 1">
                </div>
                <div class="carousel-item">
                    <img src="assets/images/foto2.jpg" class="d-block w-100" alt="Slide 2">
                </div>
                <div class="carousel-item">
                    <img src="assets/images/foto3.jpg" class="d-block w-100" alt="Slide 3">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div class="mt-4">
            <h2>Pilihan Beasiswa S1:</h2>
            <ul class="mt-4 custom-list">
                <li>Beasiswa Akademik: Ditujukan bagi mahasiswa dengan prestasi akademik yang gemilang, beasiswa ini diberikan kepada mahasiswa yang memiliki IPK minimal 3.0, beasiswa ini bertujuan untuk mendukung mahasiswa yang menunjukkan kecemerlangan dalam studi mahasiswa dan berkomitmen untuk mencapai hasil akademik yang tinggi.</li>
                <li>Beasiswa Non-Akademik: Beasiswa ini dirancang untuk mahasiswa yang aktif dan berprestasi di luar kegiatan akademik. Dengan syarat IPK minimal 3.0, beasiswa ini mengapresiasi mahasiswa yang terlibat dalam berbagai kegiatan non-akademik seperti organisasi, seni, olahraga, atau kegiatan sosial, serta memberikan dukungan bagi mereka yang berkontribusi signifikan dalam bidang-bidang tersebut.</li>
                <li>Beasiswa Penelitian: Ditujukan untuk mahasiswa yang terlibat dalam proyek penelitian, beasiswa ini diberikan kepada mahasiswa semester 6 atau lebih dan memiliki IPK minimal 3.5, beasiswa ini bertujuan untuk mendukung mahasiswa yang aktif dalam penelitian dan memiliki potensi untuk berkontribusi pada pengetahuan dan pengembangan di bidang studinya masing-masing.</li>
            </ul>
        </div>
        <div class="text-center">
            <a href="form.php" class="btn btn-daftar">Daftar Sekarang</a>
        </div>
    </div>
    <footer class="bg-navy text-white text-center py-3">
        &copy; 2024 by Rifkah Syam
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>