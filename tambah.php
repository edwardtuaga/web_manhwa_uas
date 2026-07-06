<?php
// Menyertakan file koneksi database
include 'koneksi.php';

// Cek apakah tombol Simpan sudah diklik
if (isset($_POST['simpan'])) {
    $judul    = $_POST['judul'];
    $genre    = $_POST['genre'];
    $sinopsis = $_POST['sinopsis'];
    $status   = $_POST['status'];
    
    // Proses Upload Gambar Cover
    $cover_name = $_FILES['cover']['name'];
    $cover_tmp  = $_FILES['cover']['tmp_name'];
    
    // Tentukan lokasi penyimpanan file gambar
    $folder_target = "assets/" . $cover_name;

    // Pindahkan file gambar dari temporary folder ke folder assets
    if (move_uploaded_file($cover_tmp, $folder_target)) {
        // Jika upload berhasil, masukkan data ke database
        $query = "INSERT INTO manhwa (judul, genre, sinopsis, cover, status) 
                  VALUES ('$judul', '$genre', '$sinopsis', '$cover_name', '$status')";
        
        $insert = mysqli_query($koneksi, $query);

        if ($insert) {
            echo "<script>
                    alert('Manhwa baru berhasil ditambahkan!');
                    window.location.href='index.php';
                  </script>";
        } else {
            echo "<script>alert('Gagal menyimpan data ke database.');</script>";
        }
    } else {
        echo "<script>alert('Gagal meng-upload gambar cover.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Manhwa - Admin Panel</title>
    <style>
        body {
            background-color: #121212;
            color: #ffffff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #1f1f1f;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0,0,0,0.3);
        }

        header h1 {
            margin: 0;
            color: #00e676;
            font-size: 24px;
        }

        .container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #1f1f1f;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #ccc;
        }

        .form-group input[type="text"],
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #333;
            border-radius: 5px;
            background-color: #2c2c2c;
            color: #fff;
            box-sizing: border-box;
            font-size: 14px;
        }

        .form-group textarea {
            resize: vertical;
            height: 100px;
        }

        .form-group input[type="file"] {
            color: #ccc;
        }

        .btn-container {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        .btn-submit {
            background-color: #00e676;
            color: #121212;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            flex: 1;
            transition: 0.3s;
        }

        .btn-submit:hover {
            background-color: #00b359;
        }

        .btn-kembali {
            background-color: #444;
            color: #fff;
            padding: 12px 20px;
            text-decoration: none;
            text-align: center;
            border-radius: 5px;
            font-weight: bold;
            flex: 1;
            transition: 0.3s;
        }

        .btn-kembali:hover {
            background-color: #555;
        }
    </style>
</head>
<body>

    <header>
        <h1>Tambah Manhwa Baru</h1>
    </header>

    <div class="container">
        <form action="" method="POST" enctype="multipart/form-data">
            
            <div class="form-group">
                <label for="judul">Judul Manhwa</label>
                <input type="text" id="judul" name="judul" required placeholder="Contoh: Solo Leveling">
            </div>

            <div class="form-group">
                <label for="genre">Genre</label>
                <input type="text" id="genre" name="genre" required placeholder="Contoh: Action, Fantasy">
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select id="status" name="status" required>
                    <option value="Ongoing">Ongoing</option>
                    <option value="Tamat">Tamat</option>
                </select>
            </div>

            <div class="form-group">
                <label for="sinopsis">Sinopsis</label>
                <textarea id="sinopsis" name="sinopsis" required placeholder="Masukkan deskripsi cerita..."></textarea>
            </div>

            <div class="form-group">
                <label for="cover">Gambar Cover</label>
                <input type="file" id="cover" name="cover" accept="image/*" required>
            </div>

            <div class="btn-container">
                <a href="index.php" class="btn-kembali">Batal</a>
                <button type="submit" name="simpan" class="btn-submit">Simpan Manhwa</button>
            </div>

        </form>
    </div>

</body>
</html>