<?php
include 'database.php';

//ID dari URL
$id = $_GET['id'];

//ambil data pendaftar berdasarkan ID
$sql_pendaftar = "SELECT * FROM pendaftar_beasiswa WHERE id = ?";
$stmt = $conn->prepare($sql_pendaftar);
$stmt->bind_param('i', $id);
$stmt->execute();
$result_pendaftar = $stmt->get_result();
$pendaftar = $result_pendaftar->fetch_assoc();

//ambil daftar beasiswa
$sql_beasiswa = "SELECT id, nama_beasiswa, minimal_ipk, deskripsi FROM beasiswa";
$result_beasiswa = $conn->query($sql_beasiswa);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/form.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Pendaftaran Beasiswa</title>
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
        <h1>Edit Pendaftaran Beasiswa</h1>
        <form id="beasiswa-form" action="proses_edit.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= htmlspecialchars($pendaftar['id']) ?>">

            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= htmlspecialchars($pendaftar['nama']) ?>" required>
                <div id="nama-warning" class="text-danger"></div>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($pendaftar['email']) ?>" required>
                <div id="email-warning" class="text-danger"></div>
            </div>

            <div class="form-group">
                <label for="no_hp">Nomor HP</label>
                <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= htmlspecialchars($pendaftar['no_hp']) ?>" required>
                <div id="phone-warning" class="text-danger"></div>
            </div>

            <div class="form-group">
                <label for="semester">Semester</label>
                <select class="form-control" id="semester" name="semester" required>
                    <?php for ($i = 1; $i <= 8; $i++) : ?>
                        <option value="<?= $i ?>" <?= ($pendaftar['semester'] == $i) ? 'selected' : '' ?>>Semester <?= $i ?></option>
                    <?php endfor; ?>
                </select>
                <div id="semester-warning" class="text-danger"></div>
            </div>

            <div id="ips-container">
                <!-- Kolom IPS dinamis akan bertambah di sini -->
            </div>

            <div class="form-group">
                <label for="ipk">IPK</label>
                <input type="text" class="form-control" id="ipk" name="ipk" value="<?= htmlspecialchars($pendaftar['ipk']) ?>" readonly>
                <div id="ipk-warning" class="text-danger"></div>
            </div>

            <div class="form-group">
                <label for="beasiswa_id">Jenis Beasiswa</label>
                <select class="form-control" id="beasiswa_id" name="beasiswa_id" required>
                    <?php while ($beasiswa = $result_beasiswa->fetch_assoc()) : ?>
                        <option value="<?= $beasiswa['id'] ?>" data-minimal-ipk="<?= $beasiswa['minimal_ipk'] ?>" data-deskripsi="<?= htmlspecialchars($beasiswa['deskripsi']) ?>"
                        <?= ($pendaftar['beasiswa_id'] == $beasiswa['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($beasiswa['nama_beasiswa']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
                <div id="beasiswa-warning" class="text-danger"></div>
            </div>

            <div class="form-group">
                <label for="berkas">Upload Berkas (PDF saja)</label>
                <input type="file" class="form-control" id="berkas" name="berkas" accept=".pdf">
                <div id="berkas-warning" class="text-danger"></div>
                <small>File yang di-upload saat ini: <?= htmlspecialchars($pendaftar['berkas']) ?></small>
            </div>

            <div class="form-buttons-wrapper">
                <a href="hasil.php" class="btn btn-kembali">Kembali</a>
                <button type="submit" class="btn btn-daftar" id="daftar-button">Simpan</button>
            </div>
        </form>
    </div>

    <footer class="bg-navy text-white text-center py-3">
        &copy; 2024 by Rifkah Syam
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function () {
            //validasi nama
            $('#nama').on('input', function () {
                if ($(this).val().trim() === '') {
                    $('#nama-warning').text('Nama tidak boleh kosong');
                } else {
                    $('#nama-warning').text('');
                }
            });

            //validasi email: @ .com
            $('#email').on('blur', function () {
                var email = $(this).val();
                var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                if (!emailReg.test(email)) {
                    $('#email-warning').text('Email belum sesuai');
                    $('#no_hp').attr('disabled', true);
                } else {
                    $('#email-warning').text('');
                    $('#no_hp').attr('disabled', false);
                }
            });

            //validasi nomor HP hanya angka
            $('#no_hp').on('input', function () {
                var phone = $(this).val();
                if (!/^\d+$/.test(phone)) {
                    $('#phone-warning').text('Nomor HP belum sesuai');
                    $('#semester').attr('disabled', true);
                } else {
                    $('#phone-warning').text('');
                    $('#semester').attr('disabled', false);
                }
            });

            //tkolom IPS sesuai semester yang dipilih
            $('#semester').on('change', function () {
                var semester = $(this).val();
                var ipsContainer = $('#ips-container');
                ipsContainer.empty();
                for (var i = 1; i <= semester; i++) {
                    ipsContainer.append(`
                        <div class="form-group">
                            <label for="ips_${i}">IPS Semester ${i}</label>
                            <input type="number" class="form-control ips" id="ips_${i}" name="ips_${i}" step="0.01" min="0" max="4" required>
                            <div id="ips_${i}_warning" class="text-danger"></div>
                        </div>
                    `);
                }
                //reset IPK dan enable/disable form
                $('#ipk').val('');
                $('#beasiswa_id').val('').trigger('change');
                $('#beasiswa_id, #berkas, #daftar-button').attr('disabled', true);
                $('#semester-warning').text('');
            });

            //perhitungan IPK otomatis + validasi beasiswa
            $(document).on('input', '.ips', function () {
                var totalIPS = 0;
                var countIPS = 0;
                var isValid = true;
                $('.ips').each(function () {
                    var value = parseFloat($(this).val());
                    if (value > 4) {
                        $(this).val('');
                        $('#ips_' + $(this).attr('id').split('_')[1] + '_warning').text('Nilai IPS tidak boleh lebih dari 4.0');
                        isValid = false;
                    } else if (!isNaN(value)) {
                        totalIPS += value;
                        countIPS++;
                        $('#ips_' + $(this).attr('id').split('_')[1] + '_warning').text('');
                    }
                });

                if (isValid) {
                    var ipk = totalIPS / countIPS;
                    $('#ipk').val(ipk.toFixed(2));
                } else {
                    $('#ipk').val('');
                }

                var ipk = parseFloat($('#ipk').val());
                var semester = parseInt($('#semester').val());
                var beasiswaSelect = $('#beasiswa_id');
                var selectedBeasiswa = beasiswaSelect.find('option:selected');
                var minimalIPK = parseFloat(selectedBeasiswa.data('minimal-ipk'));

                //validasi jenis beasiswa yang dipilih
                if (ipk < 3) {
                    beasiswaSelect.prop('disabled', true);
                    $('#berkas').prop('disabled', true);
                    $('#daftar-button').prop('disabled', true);
                    $('#beasiswa-warning').text('IPK kurang dari 3, tidak memenuhi syarat untuk jenis beasiswa');
                } else if (ipk < minimalIPK || (selectedBeasiswa.val() == 3 && semester < 6)) {
                    beasiswaSelect.prop('disabled', true);
                    $('#berkas').prop('disabled', true);
                    $('#daftar-button').prop('disabled', true);
                    $('#beasiswa-warning').text('IPK dan semester tidak memenuhi syarat untuk jenis beasiswa ini');
                } else {
                    beasiswaSelect.prop('disabled', false);
                    $('#berkas').prop('disabled', false);
                    $('#daftar-button').prop('disabled', false);
                    $('#beasiswa-warning').text('');
                }
            });

            //cek input IPK
            $('#ipk').on('input', function () {
                var ipk = parseFloat($(this).val());
                if (isNaN(ipk) || ipk < 0 || ipk > 4) {
                    $('#ipk-warning').text('IPK hanya boleh antara 0 dan 4');
                } else {
                    $('#ipk-warning').text('');
                }
            });

            //validasi pilihan jenis beasiswa
            $('#beasiswa_id').on('change', function () {
                var ipk = parseFloat($('#ipk').val());
                var semester = parseInt($('#semester').val());
                var selectedBeasiswa = $(this).find('option:selected');
                var minimalIPK = parseFloat(selectedBeasiswa.data('minimal-ipk'));

                if (ipk < minimalIPK || (selectedBeasiswa.val() == 3 && semester < 6)) {
                    $('#berkas').prop('disabled', true);
                    $('#daftar-button').prop('disabled', true);
                    $('#beasiswa-warning').text('IPK dan semester tidak memenuhi syarat untuk jenis beasiswa ini');
                } else {
                    $('#berkas').prop('disabled', false);
                    $('#daftar-button').prop('disabled', false);
                    $('#beasiswa-warning').text('');
                }
            });
        });
    </script>
    <script>
        //cek file yang diupload
        $(document).ready(function () {
            $('#beasiswa-form').on('submit', function (e) {
                var fileInput = $('#berkas');
                var file = fileInput.val().split('\\').pop();
                var fileType = file.split('.').pop().toLowerCase();
                
                if (fileType !== 'pdf' && file !== '') {
                    e.preventDefault();
                    alert('Hanya file PDF yang diperbolehkan untuk di-upload.');
                }
            });
        });
    </script>
</body>
</html>