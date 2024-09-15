<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "beasiswa_db";

$conn = new mysqli($servername, $username, $password, $dbname);

//apakah koneksi berhasil
if ($conn->connect_error) {
    //jika gagal, tampilkan pesan error dan hentikan eksekusi
    die("Connection failed: " . $conn->connect_error);
}
?>