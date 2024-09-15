<?php
include 'database.php';

//ambil data dari form
$id = $_POST['id'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$no_hp = $_POST['no_hp'];
$semester = $_POST['semester'];
$ipk = $_POST['ipk'];
$beasiswa_id = $_POST['beasiswa_id'];
$berkas = $_FILES['berkas']['name'];

//upload berkas jika ada file baru
if (!empty($_FILES['berkas']['name'])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["berkas"]["name"]);
    move_uploaded_file($_FILES["berkas"]["tmp_name"], $target_file);
}

//update data di database
$sql = "UPDATE pendaftar_beasiswa SET nama=?, email=?, no_hp=?, semester=?, ipk=?, beasiswa_id=?, berkas=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sssisisi', $nama, $email, $no_hp, $semester, $ipk, $beasiswa_id, $berkas, $id);

if ($stmt->execute()) {
    header('Location: hasil.php');
} else {
    echo "Error updating record: " . $conn->error;
}

$stmt->close();
$conn->close();
?>