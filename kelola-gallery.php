<?php
include('db_connection.php');
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Galeri - Desa Adat Telaga Tunjung</title>
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
    <a href="dashboard.php">Beranda Admin</a>
    <a href="kelola-berita.php">Kelola Berita</a>
    <a href="kelola-struktur.php">Kelola Struktur Kepengurusan</a>
    <a href="kelola-gallery.php">Kelola Galeri</a>
    <a href="home.html" onclick="logout()">Logout</a>
</nav>

<div class="toolbar">
    <button class="add-btn" onclick="window.location.href='tambah-gallery.php'">Tambah Gambar</button>
</div>

<h2>Galeri</h2>

<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $query = "SELECT * FROM galeri ORDER BY tanggal DESC";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$no++."</td>";
                echo "<td><img src='picture/".$row['gambar']."' alt='Gambar' width='100'></td>";
                echo "<td>
                        <a href='hapus-gallery.php?id=".$row['id']."' onclick='return confirm(\"Yakin hapus?\")'><button class='delete-btn'>Hapus</button></a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Belum ada gambar di galeri.</td></tr>";
        }

        $conn->close();
        ?>
    </tbody>
</table>

</body>
</html>
