<?php
include 'koneksi.php';

// Menangkap ID Chapter dari URL
if (isset($_GET['id'])) {
    $id_chapter = $_GET['id'];
} else {
    echo "<script>alert('ID Chapter tidak ditemukan!'); window.location.href='index.php';</script>";
    exit;
}

// Query untuk mengambil data chapter lama yang mau diedit
$query_chapter = "SELECT * FROM chapters WHERE id = '$id_chapter'";
$result_chapter = mysqli_query($koneksi, $query_chapter);
$chapter = mysqli_fetch_assoc($result_chapter);

// Jika data chapter tidak ditemukan
if (!$chapter) {
    echo "<script>alert('Data chapter tidak ditemukan!'); window.location.href='index.php';</script>";
    exit;
}

// Mengambil nama manhwa untuk tampilan judul biar informatif
$manhwa_id = $chapter['manhwa_id'];
$query_manhwa = "SELECT judul FROM manhwa WHERE id = '$manhwa_id'";
$result_manhwa = mysqli_query($koneksi, $query_manhwa);
$manhwa = mysqli_fetch_assoc($result_manhwa);


// Cek jika tombol Simpan Perubahan diklik
if (isset($_POST['update_chapter'])) {
    $nomor_chapter = $_POST['nomor_chapter'];
    $judul_chapter = $_POST['judul_chapter'];
    $konten_gambar = $_POST['konten_gambar'];

    // Query UPDATE untuk memperbarui data chapter
    $query_update = "UPDATE chapters SET 
                        nomor_chapter = '$nomor_chapter', 
                        judul_chapter = '$judul_chapter', 
                        konten_gambar = '$konten_gambar' 
                     WHERE id = '$id_chapter'";
                     
    $update = mysqli_query($koneksi, $query_update);

    if ($update) {
        echo "<script>
                alert('Chapter berhasil diperbarui!');
                window.location.href='detail.php?id=$manhwa_id';
              </script>";
    } else {
        echo "<script>alert('Gagal memperbarui chapter.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Chapter - <?php echo $manhwa['judul']; ?></title>
    <style>
        body { background-color: #121212; color: #ffffff; font-family: 'Segoe UI', sans-serif; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 50px auto; background-color: #1f1f1f; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.3); }
        h2 { color: #ffb300; margin-top: 0; font-size: 22px; border-bottom: 2px solid #333; padding-bottom: 10px; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; color: #ccc; font-weight: bold; }
        .form-group input { width: 100%; padding: 12px; border: 1px solid #333; border-radius: 5px; background-color: #2c2c2c; color: #fff; box-sizing: border-box; }
        .note { font-size: 12px; color: #aaa; margin-top: 5px; }
        .btn-container { display: flex; gap: 10px; margin-top: 30px; }
        .btn-submit { background-color: #ffb300; color: #121212; padding: 12px 20px; border: none; border-radius: 5px; font-weight: bold; cursor: pointer; flex: 1; transition: 0.3s; }
        .btn-submit:hover { background-color: #ff9800; }
        .btn-kembali { background-color: #444; color: #fff; padding: 12px 20px; text-decoration: none; text-align: center; border-radius: 5px; font-weight: bold; flex: 1; transition: 0.3s; }
        .btn-kembali:hover { background-color: #555; }
    </style>
</head>
<body>

    <div class="container">
        <h2>Edit Chapter: <?php echo $manhwa['judul']; ?></h2>
        
        <form action="" method="POST">
            <div class="form-group">
                <label for="nomor_chapter">Nomor Chapter</label>
                <input type="number" id="nomor_chapter" name="nomor_chapter" required value="<?php echo $chapter['nomor_chapter']; ?>">
            </div>

            <div class="form-group">
                <label for="judul_chapter">Judul Chapter</label>
                <input type="text" id="judul_chapter" name="judul_chapter" required value="<?php echo $chapter['judul_chapter']; ?>">
            </div>

            <div class="form-group">
                <label for="konten_gambar">Nama File Gambar Isi Komik</label>
                <input type="text" id="konten_gambar" name="konten_gambar" required value="<?php echo $chapter['konten_gambar']; ?>">
                <div class="note">*Pisahkan dengan tanda koma ( , ) jika gambar lebih dari satu.</div>
            </div>

            <div class="btn-container">
                <a href="detail.php?id=<?php echo $manhwa_id; ?>" class="btn-kembali">Batal</a>
                <button type="submit" name="update_chapter" class="btn-submit">Simpan Perubahan</button>
            </div>
        </form>
    </div>

</body>
</html>