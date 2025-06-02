<?php
$host = "localhost";  // Nama host atau server MySQL
$username = "root";   // Username MySQL
$password = "";       // Password MySQL
$dbname = "telaga_tunjung"; // Ganti dengan nama database Anda

// Koneksi ke database
$conn = new mysqli($host, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
