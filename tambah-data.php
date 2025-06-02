<?php
include('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST['judul'];
    $konten = $_POST['konten'];
    $tanggal = date('Y-m-d');

    $gambar = $_FILES['gambar']['name'];
    $tmp_name = $_FILES['gambar']['tmp_name'];
    $target_dir = "picture/";
    $target_file = $target_dir . basename($gambar);

    if (move_uploaded_file($tmp_name, $target_file)) {
        $sql = "INSERT INTO berita (judul, konten, tanggal, gambar) 
                VALUES ('$judul', '$konten', '$tanggal', '$gambar')";

        if ($conn->query($sql) === TRUE) {
            header("Location: kelola-berita.php");
            exit();
        } else {
            echo "Gagal menambah data: " . $conn->error;
        }
    } else {
        echo "Gagal mengupload gambar.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Berita - Desa Adat Telaga Tunjung</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <img src="picture/logo desa adat ttk.jpg" alt="Logo">
    <div>
        <h1>Dashboard Admin</h1>
        <h2>Desa Adat Telaga Tunjung</h2>
    </div>
</header>

<nav>
    <a href="home.html">Beranda</a>
    <a href="kelola-berita.php">Kelola Berita</a>
    <a href="#">Kelola Struktur Kepengurusan</a>
    <a href="#">Kelola Galeri</a>
    <a href="#" onclick="logout()">Logout</a>
</nav>

<h2>Tambah Berita</h2>

<form method="POST" action="" enctype="multipart/form-data">
    <label for="judul">Judul Berita:</label>
    <input type="text" id="judul" name="judul" required>

    <label for="konten">Konten:</label>
    <textarea id="konten" name="konten" rows="5" required></textarea>

    <label for="gambar">Unggah Gambar:</label>
    <input type="file" name="gambar" accept="image/*" required>

    <button type="submit">Simpan</button>
    <a href="kelola-berita.php">Kembali</a>
</form>

</body>
</html>
