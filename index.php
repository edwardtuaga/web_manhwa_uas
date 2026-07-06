<?php
// Menyertakan file koneksi database
include 'koneksi.php';

// Mengambil data dari tabel manhwa
$query = "SELECT * FROM manhwa ORDER BY id DESC";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webtoon Manhwa - UAS Pemrograman Web</title>
    <style>
        /* Desain Tema Gelap Ala Webtoon */
        body {
            background-color: #121212;
            color: #ffffff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Header / Navbar */
        header {
            background-color: #1f1f1f;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0,0,0,0.3);
        }

        header h1 {
            margin: 0;
            color: #00e676; /* Warna Hijau Khas Webtoon */
            font-size: 28px;
        }

        /* Container Utama */
        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }

        /* Navigasi Admin */
        .admin-nav {
            margin-bottom: 20px;
            text-align: right;
        }

        .btn-tambah {
            background-color: #00e676;
            color: #121212;
            padding: 10px 20px;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
            transition: 0.3s;
        }

        .btn-tambah:hover {
            background-color: #00b359;
        }

        /* Grid Layout untuk Daftar Komik */
        .comic-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 25px;
        }

        /* Kartu Komik */
        .comic-card {
            background-color: #1f1f1f;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        /* Efek Hover Keren */
        .comic-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 230, 118, 0.2);
        }

        .comic-card img {
            width: 100%;
            height: 280px;
            object-fit: cover;
            display: block; /* Memastikan ruang gambar aman */
        }

        .comic-info {
            padding: 15px;
        }

        .comic-title {
            font-size: 16px;
            font-weight: bold;
            margin: 0 0 8px 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .comic-genre {
            font-size: 12px;
            color: #00e676;
            background-color: rgba(0, 230, 118, 0.1);
            padding: 3px 8px;
            border-radius: 4px;
            display: inline-block;
            margin-bottom: 10px;
        }

        .comic-status {
            font-size: 12px;
            color: #aaa;
        }

        /* Jika Data Kosong */
        .empty-state {
            text-align: center;
            grid-column: 1 / -1;
            padding: 50px;
            color: #666;
            font-size: 18px;
        }
    </style>
</head>
<body>

    <header>
        <h1>MANHWA ABSOLUTE</h1>
    </header>

    <div class="container">
        <div class="admin-nav">
            <a href="tambah.php" class="btn-tambah">+ Tambah Manhwa Baru</a>
        </div>

      <div class="comic-grid">
            <?php 
            // Cek apakah ada data di database
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
            ?>
                    <div class="comic-card">
                        <a href="detail.php?id=<?php echo $row['id']; ?>" style="text-decoration: none; color: inherit;">
                            <img src="assets/<?php echo $row['cover']; ?>" alt="Cover <?php echo $row['judul']; ?>">
                            
                            <div class="comic-info">
                                <div class="comic-title"><?php echo $row['judul']; ?></div>
                        </a> <span class="comic-genre"><?php echo $row['genre']; ?></span>
                                <div class="comic-status">Status: <?php echo $row['status']; ?></div>
                                
                                <div style="margin-top: 15px; display: flex; gap: 10px;">
                                    <a href="edit.php?id=<?php echo $row['id']; ?>" style="flex: 1; text-align: center; background-color: #ffb300; color: #121212; padding: 6px; text-decoration: none; font-weight: bold; border-radius: 4px; font-size: 13px;">Edit</a>
                                    <a href="hapus.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus manhwa ini?')" style="flex: 1; text-align: center; background-color: #e53935; color: #fff; padding: 6px; text-decoration: none; font-weight: bold; border-radius: 4px; font-size: 13px;">Hapus</a>
                                </div>
                            </div>
                    </div>
            <?php 
                }
            } else {
                // Tampilan jika database belum diisi
                echo "<div class='empty-state'>Belum ada komik yang ditambahkan. Silakan klik tombol 'Tambah Manhwa Baru' di atas!</div>";
            }
            ?>
        </div>
    </div>

</body>
</html>