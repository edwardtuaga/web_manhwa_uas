<?php
include 'koneksi.php';

// Mengambil ID Chapter dan ID Manhwa dari URL
$id_chapter = $_GET['id'];
$manhwa_id = $_GET['manhwa_id'];

// Query untuk menghapus data chapter berdasarkan id
$query = "DELETE FROM chapters WHERE id = '$id_chapter'";
$hapus = mysqli_query($koneksi, $query);

if ($hapus) {
    echo "<script>
            alert('Chapter berhasil dihapus!');
            window.location.href='detail.php?id=$manhwa_id';
          </script>";
} else {
    echo "<script>
            alert('Gagal menghapus chapter.');
            window.location.href='detail.php?id=$manhwa_id';
          </script>";
}
?>