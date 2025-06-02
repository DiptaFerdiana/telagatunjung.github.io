<?php
include('db_connection.php');  // Memasukkan koneksi database

// Ambil data berita dari database
$sql = "SELECT * FROM berita";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - Desa Adat Telaga Tunjung</title>
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
    <a href="home.html" onclick="logout()">Logout</a> <!-- Tombol logout -->
</nav>

<main class="admin-panel">
    <section>
        <h2>Selamat Datang, Admin!</h2>
        <p>Gunakan panel ini untuk mengelola konten dan informasi Desa Adat Telaga Tunjung.</p>
</main>

<footer>
    &copy; 2025 Desa Adat Telaga Tunjung - Panel Admin
</footer>

<script>
    function logout() {
        // Logout dengan mengarahkan kembali ke halaman login
        window.location.href = "login.html";
    }
</script>

</body>
</html>
