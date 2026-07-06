<?php
include 'koneksi.php';

// Mengambil ID dari URL
$id = $_GET['id'];

// Ambil nama file gambar cover lama agar bisa dihapus dari folder assets
$query_gambar = "SELECT cover FROM manhwa WHERE id = '$id'";
$result_gambar = mysqli_query($koneksi, $query_gambar);
$data_gambar = mysqli_fetch_assoc($result_gambar);
$nama_gambar_lama = $data_gambar['cover'];

// Hapus file gambar dari folder assets secara fisik
if (file_exists("assets/" . $nama_gambar_lama)) {
    unlink("assets/" . $nama_gambar_lama);
}

// Hapus data dari database
$query_hapus = "DELETE FROM manhwa WHERE id = '$id'";
$hapus = mysqli_query($koneksi, $query_hapus);

if ($hapus) {
    echo "<script>
            alert('Manhwa berhasil dihapus!');
            window.location.href='index.php';
          </script>";
} else {
    echo "<script>
            alert('Gagal menghapus data.');
            window.location.href='index.php';
          </script>";
}
?>