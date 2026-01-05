<?php
session_start();
include '../../config/config.php';
if (!isset($_SESSION['admin_logged_in'])) { header("Location: ../login.php"); exit(); }

$result = mysqli_query($conn, "SELECT * FROM minuman");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Kelola Minuman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Katalog Minuman</h2>
            <div>
                <a href="tambah.php" class="btn btn-primary">+ Tambah Minuman</a>
                <a href="../dashboard.php" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
        <div class="card shadow">
            <div class="card-body">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Gambar</th>
                            <th>Nama Minuman</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td><?= $row['id']; ?></td>
                            <td><img src="../../uploads/<?= $row['gambar_minuman']; ?>" width="80" class="rounded"></td>
                            <td><?= $row['nama_minuman']; ?></td>
                            <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                            <td>
                                <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="delete.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>