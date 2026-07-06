<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_manhwa"; // Sesuaikan dengan nama database yang kamu buat tadi

$koneksi = mysqli_connect($host, $user, $pass, $db);

// Cek apakah koneksi berhasil atau gagal
if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>