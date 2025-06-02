<?php
include('db_connection.php');

// Ambil data struktur kepengurusan dari database
$query = "SELECT * FROM struktur_kepengurusan ORDER BY id ASC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struktur Kepengurusan - Desa Adat Telaga Tunjung</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <img src="picture\logo_desa_adat_ttk-removebg-preview.png" alt="Logo" style="height: 80px;">
    <div>
        <h1>DESA ADAT TELAGA TUNJUNG</h1>
        <h2>Desa Timpag, Kec. Kerambitan, Kab. Tabanan, Bali</h2>
    </div>
</header>

<nav>
    <a href="home.html">Beranda</a>
    <a href="struktur-user.php">Struktur Kepengurusan</a>
    <a href="berita.php">Berita</a>
    <a href="gallery.php">Galeri Foto</a>
    <a href="peta.html">Pemetaan Wilayah</a>
    <a href="hubungi.html">Hubungi Kami</a>
    <a href="login.html">Admin</a>
</nav>

<h2>Struktur Kepengurusan Desa Adat Telaga Tunjung</h2>

<div class="struktur-container">
    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="struktur-card">
                <img src="picture/<?php echo $row['foto']; ?>" alt="<?php echo $row['nama']; ?>">
                <h3><?php echo $row['nama']; ?></h3>
                <p><strong><?php echo $row['jabatan']; ?></strong></p>
                <p><?php echo $row['deskripsi']; ?></p>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Belum ada data struktur kepengurusan.</p>
    <?php endif; ?>
</div>

</body>
</html>
