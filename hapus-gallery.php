<?php
include('db_connection.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data gambar untuk menghapus file dari folder
    $result = $conn->query("SELECT gambar FROM galeri WHERE id = $id");
    $row = $result->fetch_assoc();

    if ($row) {
        $gambar = $row['gambar'];
        $gambar_path = "picture/" . $gambar;

        // Hapus data dari database
        $delete = $conn->query("DELETE FROM galeri WHERE id = $id");

        if ($delete) {
            // Hapus file gambar jika ada
            if (file_exists($gambar_path)) {
                unlink($gambar_path);
            }
            header("Location: kelola-gallery.php"); // Redirect ke halaman kelola galeri
            exit();
        } else {
            echo "Gagal menghapus data: " . $conn->error;
        }
    } else {
        echo "Data tidak ditemukan.";
    }
} else {
    echo "ID tidak ditemukan.";
}
?>
