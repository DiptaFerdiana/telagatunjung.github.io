<?php
include('db_connection.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM berita WHERE id = $id");
    $row = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $konten = $_POST['konten'];
    $tanggal = date('Y-m-d');

    // Cek apakah gambar baru diupload
    if ($_FILES['gambar']['name']) {
        $gambar = $_FILES['gambar']['name'];
        $tmp_name = $_FILES['gambar']['tmp_name'];
        $target_dir = "picture/";
        $target_file = $target_dir . basename($gambar);

        if (move_uploaded_file($tmp_name, $target_file)) {
            $sql = "UPDATE berita 
                    SET judul='$judul', konten='$konten', tanggal='$tanggal', gambar='$gambar' 
                    WHERE id=$id";
        } else {
            echo "Gagal mengupload gambar baru.";
            exit();
        }
    } else {
        // Jika tidak ada gambar baru
        $sql = "UPDATE berita 
                SET judul='$judul', konten='$konten', tanggal='$tanggal' 
                WHERE id=$id";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: kelola-berita.php");
        exit();
    } else {
        echo "Gagal mengupdate data: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Berita - Desa Adat Telaga Tunjung</title>
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
    <a href="#">Kelola Struktur Kepengurusan</a>
    <a href="#">Kelola Galeri</a>
    <a href="#" onclick="logout()">Logout</a>
</nav>

<h2>Edit Berita</h2>

<form method="POST" action="" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $row['id']; ?>">

    <label for="judul">Judul Berita:</label>
    <input type="text" id="judul" name="judul" value="<?= $row['judul']; ?>" required>

    <label for="konten">Konten:</label>
    <textarea id="konten" name="konten" rows="5" required><?= $row['konten']; ?></textarea>

    <label for="gambar">Gambar Saat Ini:</label><br>
    <img src="picture/<?= $row['gambar']; ?>" width="200"><br><br>

    <label for="gambar">Ganti Gambar (jika perlu):</label>
    <input type="file" name="gambar" accept="image/*">

    <button type="submit">Simpan Perubahan</button>
    <a href="kelola-berita.php">Kembali</a>
</form>

</body>
</html>
