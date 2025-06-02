<?php
include('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal = date('Y-m-d');

    $foto = $_FILES['foto']['name'];
    $tmp_name = $_FILES['foto']['tmp_name'];
    $target_dir = "picture/";
    $target_file = $target_dir . basename($foto);

    if (move_uploaded_file($tmp_name, $target_file)) {
        $sql = "INSERT INTO struktur_kepengurusan (nama, jabatan, deskripsi, tanggal, foto) 
                VALUES ('$nama', '$jabatan', '$deskripsi', '$tanggal', '$foto')";

        if ($conn->query($sql) === TRUE) {
            header("Location: kelola-struktur.php");
            exit();
        } else {
            echo "Gagal menambah data: " . $conn->error;
        }
    } else {
        echo "Gagal mengupload foto.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Struktur Kepengurusan - Desa Adat Telaga Tunjung</title>
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
    <a href="kelola-gallery">Kelola Galeri</a>
    <a href="#" onclick="logout()">Logout</a>
</nav>

<h2>Tambah Struktur Kepengurusan</h2>

<form method="POST" action="" enctype="multipart/form-data">
    <label for="nama">Nama:</label>
    <input type="text" id="nama" name="nama" required>

    <label for="jabatan">Jabatan:</label>
    <input type="text" id="jabatan" name="jabatan" required>

    <label for="deskripsi">Deskripsi:</label>
    <textarea id="deskripsi" name="deskripsi" rows="5" required></textarea>

    <label for="foto">Unggah Foto:</label>
    <input type="file" name="foto" accept="image/*" required>

    <button type="submit">Simpan</button>
    <a href="kelola-struktur.php">Kembali</a>
</form>

</body>
</html>
