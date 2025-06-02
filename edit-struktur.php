<?php
include('db_connection.php');

// Ambil id dari URL untuk mendapatkan data yang akan diedit
$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal = date('Y-m-d');

    // Cek apakah foto baru di-upload
    if ($_FILES['foto']['name']) {
        $foto = $_FILES['foto']['name'];
        $tmp_name = $_FILES['foto']['tmp_name'];
        $target_dir = "picture/";
        $target_file = $target_dir . basename($foto);

        if (move_uploaded_file($tmp_name, $target_file)) {
            $sql = "UPDATE struktur_kepengurusan 
                    SET nama='$nama', jabatan='$jabatan', deskripsi='$deskripsi', tanggal='$tanggal', foto='$foto' 
                    WHERE id=$id";
        } else {
            echo "Gagal mengupload foto.";
        }
    } else {
        // Jika foto tidak diubah, cukup update kolom lain
        $sql = "UPDATE struktur_kepengurusan 
                SET nama='$nama', jabatan='$jabatan', deskripsi='$deskripsi', tanggal='$tanggal' 
                WHERE id=$id";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: kelola-struktur.php");
        exit();
    } else {
        echo "Gagal memperbarui data: " . $conn->error;
    }
}

// Ambil data yang akan diedit berdasarkan ID
$sql = "SELECT * FROM struktur_kepengurusan WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Struktur Kepengurusan - Desa Adat Telaga Tunjung</title>
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
    <a href="#">Kelola Galeri</a>
    <a href="#" onclick="logout()">Logout</a>
</nav>

<h2>Edit Struktur Kepengurusan</h2>

<form method="POST" action="" enctype="multipart/form-data">
    <label for="nama">Nama:</label>
    <input type="text" id="nama" name="nama" value="<?php echo $row['nama']; ?>" required>

    <label for="jabatan">Jabatan:</label>
    <input type="text" id="jabatan" name="jabatan" value="<?php echo $row['jabatan']; ?>" required>

    <label for="deskripsi">Deskripsi:</label>
    <textarea id="deskripsi" name="deskripsi" rows="5" required><?php echo $row['deskripsi']; ?></textarea>

    <label for="foto">Unggah Foto Baru (Opsional):</label>
    <input type="file" name="foto" accept="image/*">
    <p>Foto saat ini: <img src="picture/<?php echo $row['foto']; ?>" alt="Foto" width="100"></p>

    <button type="submit">Simpan</button>
    <a href="kelola-struktur.php">Kembali</a>
</form>

</body>
</html>
