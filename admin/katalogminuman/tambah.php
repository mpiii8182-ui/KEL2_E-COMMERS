<?php
session_start();
include '../../config/config.php';

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    
    // Upload File
    $filename = time() . '_' . $_FILES['gambar']['name'];
    move_uploaded_file($_FILES['gambar']['tmp_name'], "../../uploads/" . $filename);

    mysqli_query($conn, "INSERT INTO minuman (nama_minuman, gambar_minuman, harga) VALUES ('$nama', '$filename', '$harga')");
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Minuman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card col-md-6 mx-auto shadow">
            <div class="card-body">
                <h4>Tambah Data Minuman</h4>
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label>Nama Minuman</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Harga (Angka)</label>
                        <input type="number" name="harga" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Gambar Minuman</label>
                        <input type="file" name="gambar" class="form-control" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-success w-100">Simpan Data</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>