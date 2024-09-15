<?php
include 'database.php';

//ambil data dari form
$nama = $_POST['nama'];
$email = $_POST['email'];
$no_hp = $_POST['no_hp'];
$semester = $_POST['semester'];
$ipk = $_POST['ipk'];
$beasiswa_id = $_POST['beasiswa_id'];
$berkas = $_FILES['berkas'];

//validasi data
if (empty($nama) || empty($email) || empty($no_hp) || empty($semester) || empty($ipk) || empty($beasiswa_id)) {
    die('Data tidak lengkap.');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die('Format email tidak valid.');
}

if (!preg_match('/^\d+$/', $no_hp)) {
    die('Nomor HP hanya boleh berupa angka.');
}

//handle upload file
if ($berkas['error'] !== UPLOAD_ERR_OK) {
    die('Terjadi kesalahan saat mengupload file.');
}

$fileType = strtolower(pathinfo($berkas['name'], PATHINFO_EXTENSION));
if ($fileType !== 'pdf') {
    die('Hanya file PDF yang diperbolehkan.');
}

// buat nama file jadi unik
$uploadDir = 'uploads/';
$timestamp = time();
$uniqueFileName = $timestamp . '_' . basename($berkas['name']);
$uploadFile = $uploadDir . $uniqueFileName;

//berkas pindah ke direktori upload
if (!move_uploaded_file($berkas['tmp_name'], $uploadFile)) {
    die('Gagal mengupload file.');
}

$ips = [];
for ($i = 1; $i <= $semester; $i++) {
    $ips[$i] = isset($_POST["ips_$i"]) ? $_POST["ips_$i"] : null;
}

$columns = ['nama', 'email', 'no_hp', 'semester', 'ipk', 'beasiswa_id', 'berkas'];
$values = [$nama, $email, $no_hp, $semester, $ipk, $beasiswa_id, $uniqueFileName];

for ($i = 1; $i <= 8; $i++) {
    $columns[] = "ips_semester$i";
    $values[] = $ips[$i] ?? null;
}

$placeholders = implode(',', array_fill(0, count($columns), '?'));
$sql = "INSERT INTO pendaftar_beasiswa (" . implode(',', $columns) . ") VALUES ($placeholders)";

$stmt = $conn->prepare($sql);
$stmt->bind_param(str_repeat('s', count($values)), ...$values);

if ($stmt->execute()) {
    header('Location: hasil.php');
    exit();
} else {
    die('Gagal menyimpan data: ' . $conn->error);
}

$stmt->close();
$conn->close();
?>