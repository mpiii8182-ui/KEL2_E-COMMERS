<?php
session_start();
include '../../config/config.php';

// Proteksi: Cek login admin
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../login.php");
    exit();
}

// Ambil ID dari URL
$id = $_GET['id'];

// Ambil data lama makanan berdasarkan ID
$query = mysqli_query($conn, "SELECT * FROM makanan WHERE id = $id");
$data = mysqli_fetch_assoc($query);

// Jika ID tidak ditemukan
if (!$data) {
    echo "<script>alert('Data tidak ditemukan!'); window.location='index.php';</script>";
    exit();
}

// Proses Update
if (isset($_POST['update'])) {
    $nama  = $_POST['nama'];
    $harga = $_POST['harga'];
    
    // Cek apakah ada file gambar baru yang diunggah
    if ($_FILES['gambar']['name'] != "") {
        $filename = time() . '_' . $_FILES['gambar']['name'];
        $tmp_name = $_FILES['gambar']['tmp_name'];

        // Hapus file gambar lama dari folder uploads
        if (file_exists("../../uploads/" . $data['gambar'])) {
            unlink("../../uploads/" . $data['gambar']);
        }

        // Simpan gambar baru
        move_uploaded_file($tmp_name, "../../uploads/" . $filename);

        // Update database dengan gambar baru
        $sql = "UPDATE makanan SET nama='$nama', harga='$harga', gambar='$filename' WHERE id=$id";
    } else {
        // Update database tanpa mengubah gambar
        $sql = "UPDATE makanan SET nama='$nama', harga='$harga' WHERE id=$id";
    }

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Data makanan berhasil diperbarui!'); window.location='index.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Makanan - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .img-preview {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border: 2px solid #dee2e6;
            border-radius: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Edit Data Makanan</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">
                            
                            <div class="mb-3 text-center">
                                <label class="d-block mb-2 fw-bold">Gambar Saat Ini</label>
                                <img src="../../uploads/<?= $data['gambar']; ?>" class="img-preview" alt="Foto Makanan">
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Nama Makanan</label>
                                <input type="text" name="nama" class="form-control" value="<?= $data['nama']; ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Harga (Rp)</label>
                                <input type="number" name="harga" class="form-control" value="<?= $data['harga']; ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Ganti Gambar (Opsional)</label>
                                <input type="file" name="gambar" class="form-control">
                                <small class="text-muted">*Biarkan kosong jika tidak ingin mengganti gambar.</small>
                            </div>

                            <hr>
                            <div class="d-flex justify-content-between">
                                <a href="index.php" class="btn btn-secondary">Kembali</a>
                                <button type="submit" name="update" class="btn btn-primary">Update Data</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
