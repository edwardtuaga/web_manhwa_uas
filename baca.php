<?php
include 'koneksi.php';

// Menangkap ID Chapter dari URL
if (isset($_GET['chapter_id'])) {
    $chapter_id = $_GET['chapter_id'];
} else {
    echo "<script>alert('Chapter tidak ditentukan!'); window.location.href='index.php';</script>";
    exit;
}

// Query mengambil data chapter sekaligus judul manhwa menggunakan INNER JOIN
$query = "SELECT chapters.*, manhwa.judul AS judul_manhwa 
          FROM chapters 
          INNER JOIN manhwa ON chapters.manhwa_id = manhwa.id 
          WHERE chapters.id = '$chapter_id'";

$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

// Jika data chapter tidak ditemukan
if (!$data) {
    echo "<script>alert('Data chapter tidak ditemukan!'); window.location.href='index.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['judul_manhwa']; ?> - Chapter <?php echo $data['nomor_chapter']; ?></title>
    <style>
        body {
            background-color: #121212;
            color: #ffffff;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Header Navigasi Baca */
        .reader-header {
            background-color: #1f1f1f;
            padding: 15px;
            text-align: center;
            position: sticky;
            top: 0;
            box-shadow: 0 4px 10px rgba(0,0,0,0.4);
            z-index: 1000;
        }

        .reader-header h2 {
            margin: 0 0 5px 0;
            font-size: 20px;
            color: #00e676;
        }

        .reader-header h3 {
            margin: 0 0 15px 0;
            font-size: 16px;
            color: #aaa;
            font-weight: normal;
        }

        .btn-kembali {
            background-color: #333;
            color: #00e676;
            padding: 6px 15px;
            text-decoration: none;
            font-weight: bold;
            border-radius: 4px;
            font-size: 14px;
            transition: 0.2s;
        }

        .btn-kembali:hover {
            background-color: #444;
        }

        /* Tempat Gambar Manhwa Vertikal */
        .comic-content {
            max-width: 700px;
            margin: 20px auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #000;
        }

        .comic-content img {
            width: 100%;
            height: auto;
            display: block;
            margin: 0;
            padding: 0;
        }

        .empty-content {
            padding: 50px;
            text-align: center;
            color: #666;
        }
    </style>
</head>
<body>

    <div class="reader-header">
        <h2><?php echo $data['judul_manhwa']; ?></h2>
        <h3>Chapter <?php echo $data['nomor_chapter']; ?> : <?php echo $data['judul_chapter']; ?></h3>
        <a href="detail.php?id=<?php echo $data['manhwa_id']; ?>" class="btn-kembali">&larr; Kembali ke Detail</a>
    </div>

    <div class="comic-content">
        <?php 
        // Mengubah string (contoh: "ch1_1.jpg,ch1_2.jpg") menjadi array data terpisah
        $gambar_array = explode(',', $data['konten_gambar']);
        
        if (!empty($data['konten_gambar'])) {
            foreach ($gambar_array as $gambar) {
                // Trim digunakan untuk menghapus spasi tidak sengaja di sekitar nama file
                $gambar_bersih = trim($gambar); 
                echo "<img src='assets/$gambar_bersih' alt='Isi Chapter'>";
            }
        } else {
            echo "<div class='empty-content'>Gambar konten belum diisi atau format salah.</div>";
        }
        ?>
    </div>

</body>
</html>