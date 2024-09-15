<?php
include 'database.php';

//ambil data dari database, diurutkan berdasarkan ID
$result = $conn->query("SELECT p.*, b.nama_beasiswa FROM pendaftar_beasiswa p JOIN beasiswa b ON p.beasiswa_id = b.id ORDER BY p.id ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/hasil.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif !important;
        }
    </style>
    <title>Hasil Pendaftaran</title>
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
        <h1 class="text-center">Daftar Nama Calon Penerima Beasiswa</h1>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Nomor HP</th>
                        <th>Semester</th>
                        <th>IPK</th>
                        <th>Pilihan Beasiswa</th>
                        <th>Berkas</th>
                        <th>Status Ajuan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?= htmlspecialchars($row['nama']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= htmlspecialchars($row['no_hp']) ?></td>
                        <td><?= htmlspecialchars($row['semester']) ?></td>
                        <td><?= htmlspecialchars($row['ipk']) ?></td>
                        <td><?= htmlspecialchars($row['nama_beasiswa']) ?></td>
                        <td>
                            <?php
                            $filePath = 'uploads/' . htmlspecialchars($row['berkas']);
                            ?>
                            <a href="<?= $filePath ?>" target="_blank">Lihat Berkas</a>
                        </td>
                        <td><?= htmlspecialchars($row['status_ajuan']) ?></td>
                        <td class="button-group">
                            <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning">Edit</a>
                            <a href="proses_hapus.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-delete">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
    <footer class="bg-navy text-white text-center py-3">
        &copy; 2024 by Rifkah Syam
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.btn-delete').forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault(); //agar link tidak default
                var url = this.href; 
                var row = this.closest('tr');

                if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                    fetch(url, { method: 'GET' })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert(data.message);
                                row.remove();
                            } else {
                                alert(data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Terjadi kesalahan:', error);
                            alert('Terjadi kesalahan saat menghapus data.');
                        });
                }
            });
        });
    });
    </script>
</body>
</html>