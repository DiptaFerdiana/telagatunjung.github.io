<?php
include('db_connection.php');

// Ambil id dari URL untuk menghapus data
$id = $_GET['id'];

// Ambil data struktur untuk memastikan foto yang terkait dihapus juga
$sql = "SELECT * FROM struktur_kepengurusan WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($row) {
    // Hapus foto dari folder jika ada
    $foto = $row['foto'];
    $foto_path = "picture/" . $foto;
    
    // Menghapus file foto jika ada
    if (file_exists($foto_path)) {
        unlink($foto_path);
    }

    // Hapus data dari database
    $sql_delete = "DELETE FROM struktur_kepengurusan WHERE id=$id";

    if ($conn->query($sql_delete) === TRUE) {
        header("Location: kelola-struktur.php");
        exit();
    } else {
        echo "Gagal menghapus data: " . $conn->error;
    }
} else {
    echo "Data tidak ditemukan.";
}
?>
