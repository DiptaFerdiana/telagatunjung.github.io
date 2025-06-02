<?php
include('db_connection.php');

// Ambil data berita dari database
$query = "SELECT * FROM berita ORDER BY tanggal DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Berita - Desa Adat Telaga Tunjung</title>
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
    <a href="struktur.php">Struktur Kepengurusan</a>
    <a href="berita.php">Berita</a>
    <a href="gallery.php">Galeri Foto</a>
    <a href="peta.html">Pemetaan Wilayah</a>
    <a href="hubungi.html">Hubungi Kami</a>
    <a href="login.html">Admin</a>
</nav>

<h2 style="text-align: center;">Berita Terbaru Desa Adat Telaga Tunjung</h2>

<div class="berita-container">
    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="berita-card">
                <img src="picture/<?php echo $row['gambar']; ?>" alt="<?php echo $row['judul']; ?>" onclick="showPopup(this.src)">
                <div class="konten">
                    <h3><?php echo $row['judul']; ?></h3>
                    <p><?php echo substr($row['konten'], 0, 100); ?>...</p>
                    <div class="tanggal">Tanggal: <?php echo date('d-m-Y', strtotime($row['tanggal'])); ?></div>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Tidak ada berita yang tersedia.</p>
    <?php endif; ?>
</div>

<!-- Popup Gambar -->
<div class="popup-overlay" id="popup" onclick="hidePopup()">
    <img id="popup-img" src="">
</div>

<script>
    function showPopup(src) {
        document.getElementById('popup-img').src = src;
        document.getElementById('popup').style.display = 'flex';
    }

    function hidePopup() {
        document.getElementById('popup').style.display = 'none';
    }
</script>

</body>
</html>
