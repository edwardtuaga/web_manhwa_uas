<?php
include 'koneksi.php';

// Mengambil ID Manhwa dari URL
$id_manhwa = $_GET['id'];

// Query 1: Mengambil data spesifik manhwa tersebut
$query_manhwa = "SELECT * FROM manhwa WHERE id = '$id_manhwa'";
$result_manhwa = mysqli_query($koneksi, $query_manhwa);
$manhwa = mysqli_fetch_assoc($result_manhwa);

// Jika data manhwa tidak ditemukan
if (!$manhwa) {
    echo "<script>alert('Manhwa tidak ditemukan!'); window.location.href='index.php';</script>";
    exit;
}

// Query 2: Mengambil daftar chapter yang terhubung dengan manhwa ini
$query_chapters = "SELECT * FROM chapters WHERE manhwa_id = '$id_manhwa' ORDER BY nomor_chapter DESC";
$result_chapters = mysqli_query($koneksi, $query_chapters);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail - <?php echo $manhwa['judul']; ?></title>
    <style>
        body { background-color: #121212; color: #fff; font-family: 'Segoe UI', sans-serif; margin: 0; padding: 0; }
        .container { max-width: 900px; margin: 30px auto; padding: 0 20px; }
        
        /* Layout Detail Utama */
        .detail-header { display: flex; gap: 30px; background-color: #1f1f1f; padding: 25px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.3); }
        .detail-header img { width: 220px; height: 300px; object-fit: cover; border-radius: 6px; }
        .detail-info { flex: 1; }
        .detail-info h2 { margin-top: 0; color: #00e676; font-size: 28px; }
        .genre { background-color: rgba(0, 230, 118, 0.1); color: #00e676; padding: 4px 10px; border-radius: 4px; display: inline-block; margin-bottom: 15px; font-size: 14px; }
        .sinopsis { color: #ccc; line-height: 1.6; margin-top: 15px; }

        /* Section Daftar Chapter */
        .chapter-section { margin-top: 40px; }
        .chapter-header { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #333; padding-bottom: 10px; margin-bottom: 20px; }
        .btn-tambah-ch { background-color: #00e676; color: #121212; padding: 8px 16px; text-decoration: none; font-weight: bold; border-radius: 4px; font-size: 14px; }
        
        /* List Item Chapter */
        .chapter-list { display: flex; flex-direction: column; gap: 10px; }
        .chapter-item { display: flex; justify-content: space-between; align-items: center; background-color: #1f1f1f; padding: 15px 20px; border-radius: 6px; text-decoration: none; color: #fff; transition: 0.2s; border-left: 4px solid transparent; }
        .chapter-item:hover { background-color: #2a2a2a; border-left: 4px solid #00e676; }
        .chapter-title { font-weight: bold; }
        
        .btn-kembali { display: inline-block; margin-bottom: 20px; color: #00e676; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>

    <div class="container">
        <a href="index.php" class="btn-kembali">&larr; Kembali ke Beranda</a>

        <div class="detail-header">
            <img src="assets/<?php echo $manhwa['cover']; ?>" alt="Cover">
            <div class="detail-info">
                <h2><?php echo $manhwa['judul']; ?></h2>
                <div class="genre"><?php echo $manhwa['genre']; ?></div>
                <div><strong>Status:</strong> <?php echo $manhwa['status']; ?></div>
                <div class="sinopsis">
                    <strong>Sinopsis:</strong><br>
                    <?php echo nl2br($manhwa['sinopsis']); ?>
                </div>
            </div>
        </div>

        <div class="chapter-section">
            <div class="chapter-header">
                <h3>Daftar Chapter</h3>
                <a href="tambah_chapter.php?manhwa_id=<?php echo $manhwa['id']; ?>" class="btn-tambah-ch">+ Tambah Chapter</a>
            </div>

            <div class="chapter-list">
                <?php 
                if (mysqli_num_rows($result_chapters) > 0) {
                    while($ch = mysqli_fetch_assoc($result_chapters)) {
                ?>
                       <div class="chapter-item" style="display: flex; justify-content: space-between; align-items: center; background-color: #1f1f1f; padding: 15px 20px; border-radius: 6px; border-left: 4px solid transparent; transition: 0.2s;">
    <a href="baca.php?chapter_id=<?php echo $ch['id']; ?>" style="text-decoration: none; color: #fff; flex: 1; font-weight: bold;">
        Chapter <?php echo $ch['nomor_chapter']; ?> : <?php echo $ch['judul_chapter']; ?>
    </a>
    
    <div style="display: flex; gap: 10px; align-items: center;">
        <a href="baca.php?chapter_id=<?php echo $ch['id']; ?>" style="color: #00e676; text-decoration: none; font-size: 14px; font-weight: bold;">Baca &rarr;</a>
        
        <a href="edit_chapter.php?id=<?php echo $ch['id']; ?>" style="background-color: #ffb300; color: #121212; padding: 4px 10px; text-decoration: none; font-weight: bold; border-radius: 4px; font-size: 12px;">Edit</a>
        
        <a href="hapus_chapter.php?id=<?php echo $ch['id']; ?>&manhwa_id=<?php echo $manhwa['id']; ?>" onclick="return confirm('Yakin ingin menghapus chapter ini?')" style="background-color: #e53935; color: #fff; padding: 4px 10px; text-decoration: none; font-weight: bold; border-radius: 4px; font-size: 12px;">Hapus</a>
    </div>
</div>
                <?php 
                    }
                } else {
                    echo "<p style='color: #666; text-align: center; padding: 20px;'>Belum ada chapter untuk manhwa ini.</p>";
                }
                ?>
            </div>
        </div>
    </div>

</body>
</html>