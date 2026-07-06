<?php
include 'koneksi.php';

$id = $_GET['id'];
$query = "SELECT * FROM manhwa WHERE id = '$id'";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $judul    = $_POST['judul'];
    $genre    = $_POST['genre'];
    $sinopsis = $_POST['sinopsis'];
    $status   = $_POST['status'];
    
    $cover_name = $_FILES['cover']['name'];
    $cover_tmp  = $_FILES['cover']['tmp_name'];

    // Cek apakah admin mengupload gambar cover baru
    if (!empty($cover_name)) {
        // Hapus cover lama terlebih dahulu
        if (file_exists("assets/" . $data['cover'])) {
            unlink("assets/" . $data['cover']);
        }
        // Upload cover baru
        move_uploaded_file($cover_tmp, "assets/" . $cover_name);
        $query_update = "UPDATE manhwa SET judul='$judul', genre='$genre', sinopsis='$sinopsis', status='$status', cover='$cover_name' WHERE id='$id'";
    } else {
        // Jika tidak upload gambar baru, pakai gambar lama
        $query_update = "UPDATE manhwa SET judul='$judul', genre='$genre', sinopsis='$sinopsis', status='$status' WHERE id='$id'";
    }

    $update = mysqli_query($koneksi, $query_update);

    if ($update) {
        echo "<script>
                alert('Data manhwa berhasil diperbarui!');
                window.location.href='index.php';
              </script>";
    } else {
        echo "<script>alert('Gagal memperbarui data.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Manhwa - Admin Panel</title>
    <style>
        body { background-color: #121212; color: #fff; font-family: sans-serif; }
        .container { max-width: 600px; margin: 30px auto; background-color: #1f1f1f; padding: 30px; border-radius: 8px; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; color: #ccc; }
        .form-group input, .form-group textarea, .form-group select { width: 100%; padding: 10px; background-color: #2c2c2c; color: #fff; border: 1px solid #333; border-radius: 5px; box-sizing: border-box; }
        .btn-submit { background-color: #ffb300; color: #121212; padding: 12px 20px; border: none; border-radius: 5px; font-weight: bold; cursor: pointer; width: 100%; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Manhwa: <?php echo $data['judul']; ?></h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Judul Manhwa</label>
                <input type="text" name="judul" value="<?php echo $data['judul']; ?>" required>
            </div>
            <div class="form-group">
                <label>Genre</label>
                <input type="text" name="genre" value="<?php echo $data['genre']; ?>" required>
            </div>
            <div class="form-group">
                <label>Status</label>
                <select name="status">
                    <option value="Ongoing" <?php if($data['status'] == 'Ongoing') echo 'selected'; ?>>Ongoing</option>
                    <option value="Tamat" <?php if($data['status'] == 'Tamat') echo 'selected'; ?>>Tamat</option>
                </select>
            </div>
            <div class="form-group">
                <label>Sinopsis</label>
                <textarea name="sinopsis" required><?php echo $data['sinopsis']; ?></textarea>
            </div>
            <div class="form-group">
                <label>Gambar Cover (Kosongkan jika tidak ingin diubah)</label>
                <input type="file" name="cover" accept="image/*">
                <p style="font-size: 12px; color: #aaa;">File saat ini: <?php echo $data['cover']; ?></p>
            </div>
            <button type="submit" name="update" class="btn-submit">Perbarui Manhwa</button>
        </form>
    </div>
</body>
</html>