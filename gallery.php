<?php
include('db_connection.php');

// Ambil data gambar dari tabel galeri
$query = "SELECT * FROM galeri ORDER BY tanggal DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Desa Adat Telaga Tunjung</title>
    <link rel="stylesheet" href="style.css">
    <style>

    </style>
</head>
<body>

<header>
    <img src="picture\logo_desa_adat_ttk-removebg-preview.png" alt="Logo">
    <div>
        <h1>DESA ADAT TELAGA TUNJUNG</h1>
        <h2>DESA TIMPAG, KECAMATAN KERAMBITAN, KABUPATEN TABANAN, BALI</h2>
    </div>
    <img src="picture\logo_desa_adat_ttk-removebg-preview.png" alt="Kantor Desa" style="height: 80px;">
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

<h2>Galeri Desa Adat Telaga Tunjung</h2>

<?php if ($result->num_rows > 0): ?>
    <div class="gallery">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="gallery-item">
                <img src="picture/<?php echo $row['gambar']; ?>" alt="Gambar Galeri" width="300" onclick="openModal(this.src)">
                <p><?php echo $row['judul']; ?></p>
            </div>
        <?php endwhile; ?>
    </div>
<?php else: ?>
    <p>Belum ada gambar di galeri.</p>
<?php endif; ?>

<!-- Modal -->
<div id="imageModal" class="modal" onclick="closeModal()">
    <span class="close" onclick="closeModal()">&times;</span>
    <img class="modal-content" id="modalImg">
</div>

<script>
function openModal(src) {
    var modal = document.getElementById("imageModal");
    var modalImg = document.getElementById("modalImg");
    modal.style.display = "block";
    modalImg.src = src;
}

function closeModal() {
    document.getElementById("imageModal").style.display = "none";
}
</script>

</body>
</html>
