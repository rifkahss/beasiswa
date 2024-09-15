<?php
include 'database.php';

header('Content-Type: application/json');

$id = $_GET['id'];

//cek valid ID
if (!filter_var($id, FILTER_VALIDATE_INT)) {
    echo json_encode([
        'success' => false,
        'message' => 'ID tidak valid.'
    ]);
    exit;
}

$sql = "DELETE FROM pendaftar_beasiswa WHERE id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode([
        'success' => false,
        'message' => 'Gagal menyiapkan query: ' . $conn->error
    ]);
    exit;
}

$stmt->bind_param('i', $id);

$response = [];

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        $response['success'] = true;
        $response['message'] = 'Data berhasil dihapus.';
    } else {
        $response['success'] = false;
        $response['message'] = 'Data tidak ditemukan.';
    }
} else {
    $response['success'] = false;
    $response['message'] = 'Gagal menghapus data: ' . $conn->error;
}

$stmt->close();
$conn->close();

echo json_encode($response);
?>