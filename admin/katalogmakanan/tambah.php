<?php
session_start();
include '../../config/config.php';

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    
    // Upload Gambar
    $gambar = $_FILES['gambar']['name'];
    $tmp_name = $_FILES['gambar']['tmp_name'];
    move_uploaded_file($tmp_name, "../../uploads/" . $gambar);

    $sql = "INSERT INTO makanan (nama, gambar, harga) VALUES ('$nama', '$gambar', '$harga')";
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Makanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card col-md-6 mx-auto">
            <div class="card-body">
                <h4>Tambah Makanan Baru</h4>
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label>Nama Makanan</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Harga</label>
                        <input type="number" name="harga" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Gambar Produk</label>
                        <input type="file" name="gambar" class="form-control" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-success">Simpan</button>
                    <a href="index.php" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>