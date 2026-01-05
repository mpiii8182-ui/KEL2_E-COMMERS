<?php
session_start();
include '../../config/config.php';
if (!isset($_SESSION['admin_logged_in'])) { header("Location: ../login.php"); exit(); }

$result = mysqli_query($conn, "SELECT * FROM makanan");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kelola Makanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between mb-3">
            <h3>Katalog Makanan</h3>
            <a href="tambah.php" class="btn btn-primary">Tambah Makanan</a>
        </div>
        <table class="table table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Gambar</th>
                    <th>Nama Makanan</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><img src="../../uploads/<?= $row['gambar']; ?>" width="80"></td>
                    <td><?= $row['nama']; ?></td>
                    <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus makanan ini?')">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <a href="../dashboard.php" class="btn btn-secondary">Kembali ke Dashboard</a>
    </div>
</body>
</html>