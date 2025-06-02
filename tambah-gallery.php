<?php
include('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mendapatkan nama file gambar yang di-upload
    $judul = $_POST['judul']; // Menambahkan input judul
    $gambar = $_FILES['gambar']['name'];
    $tmp_name = $_FILES['gambar']['tmp_name'];
    $target_dir = "picture/"; // Direktori tujuan untuk menyimpan gambar
    $target_file = $target_dir . basename($gambar);

    // Cek apakah gambar berhasil di-upload
    if (move_uploaded_file($tmp_name, $target_file)) {
        $sql = "INSERT INTO galeri (judul, gambar) VALUES ('$judul', '$gambar')"; // Menyimpan judul dan gambar ke tabel galeri

        if ($conn->query($sql) === TRUE) {
            header("Location: kelola-gallery.php"); // Redirect setelah berhasil
            exit();
        } else {
            echo "Gagal menambah gambar: " . $conn->error; // Jika ada error saat query
        }
    } else {
        echo "Gagal mengupload gambar."; // Jika gagal mengupload gambar
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Galeri - Desa Adat Telaga Tunjung</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <img src="picture\logo_desa_adat_ttk-removebg-preview.png" alt="Logo">
    <div>
        <h1>Dashboard Admin</h1>
        <h2>Desa Adat Telaga Tunjung</h2>
    </div>
</header>

<nav>
    <a href="home.html">Beranda</a>
    <a href="kelola-berita.php">Kelola Berita</a>
    <a href="kelola-struktur.php">Kelola Struktur Kepengurusan</a>
    <a href="kelola-gallery.php">Kelola Galeri</a>
    <a href="#" onclick="logout()">Logout</a>
</nav>

<h2>Tambah Galeri</h2>

<form method="POST" action="" enctype="multipart/form-data">
    <label for="judul">Judul Gambar:</label>
    <input type="text" id="judul" name="judul" required> <!-- Input untuk judul -->

    <label for="gambar">Unggah Gambar:</label>
    <input type="file" name="gambar" accept="image/*" required>

    <button type="submit">Simpan</button>
    <a href="kelola-gallery.php">Kembali</a>
</form>

</body>
</html>
