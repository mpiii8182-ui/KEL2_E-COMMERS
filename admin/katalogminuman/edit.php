<?php
session_start();
include '../../config/config.php';

// Proteksi halaman: cek apakah admin sudah login
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../login.php");
    exit();
}

// Ambil ID dari URL
$id = $_GET['id'];

// Ambil data lama berdasarkan ID
$query = mysqli_query($conn, "SELECT * FROM minuman WHERE id = $id");
$data = mysqli_fetch_assoc($query);

// Jika data tidak ditemukan
if (!$data) {
    echo "<script>alert('Data tidak ditemukan!'); window.location='index.php';</script>";
    exit();
}

// Proses Update Data
if (isset($_POST['update'])) {
    $nama  = $_POST['nama_minuman'];
    $harga = $_POST['harga'];
    
    // Cek apakah ada file gambar baru yang diupload
    if ($_FILES['gambar']['name'] != "") {
        // Ambil info file baru
        $filename = time() . '_' . $_FILES['gambar']['name'];
        $tmp_name = $_FILES['gambar']['tmp_name'];

        // Hapus gambar lama dari folder uploads agar tidak menumpuk
        if (file_exists("../../uploads/" . $data['gambar_minuman'])) {
            unlink("../../uploads/" . $data['gambar_minuman']);
        }

        // Upload gambar baru
        move_uploaded_file($tmp_name, "../../uploads/" . $filename);

        // Update database dengan gambar baru
        $sql = "UPDATE minuman SET nama_minuman='$nama', harga='$harga', gambar_minuman='$filename' WHERE id=$id";
    } else {
        // Update database tanpa mengubah gambar
        $sql = "UPDATE minuman SET nama_minuman='$nama', harga='$harga' WHERE id=$id";
    }

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Data Berhasil Diperbarui!'); window.location='index.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Minuman - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .preview-img {
            max-width: 150px;
            border-radius: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body class="bg-light">

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow border-0">
                    <div class="card-header bg-warning text-dark text-center">
                        <h4 class="mb-0">Edit Data Minuman</h4>
                    </div>
                    <div class="card-body p-4">
                        <form method="POST" enctype="multipart/form-data">
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold">ID Minuman</label>
                                <input type="text" class="form-control bg-light" value="<?= $data['id']; ?>" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Nama Minuman</label>
                                <input type="text" name="nama_minuman" class="form-control" value="<?= $data['nama_minuman']; ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Harga (Rp)</label>
                                <input type="number" name="harga" class="form-control" value="<?= $data['harga']; ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold d-block">Gambar Saat Ini</label>
                                <img src="../../uploads/<?= $data['gambar_minuman']; ?>" alt="Gambar" class="preview-img">
                                <p class="text-muted small">*Kosongkan jika tidak ingin mengganti gambar.</p>
                                <input type="file" name="gambar" class="form-control">
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
                                <a href="index.php" class="btn btn-secondary">Batal / Kembali</a>
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