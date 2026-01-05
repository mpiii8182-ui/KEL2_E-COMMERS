<?php
session_start();
include '../config/config.php';
if (!isset($_SESSION['username'])) { header("Location: login.php"); exit(); }

$result = mysqli_query($conn, "SELECT * FROM makanan");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Katalog Makanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-primary mb-4">
        <div class="container">
            <span class="navbar-brand">Food Shop - Welcome, <?= $_SESSION['username']; ?></span>
            <a href="logout.php" class="btn btn-light btn-sm">Logout</a>
        </div>
    </nav>

    <div class="container">
        <h2 class="mb-4">Menu Makanan Tersedia</h2>
        <div class="row">
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="../uploads/<?= $row['gambar']; ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h5 class="card-title"><?= $row['nama']; ?></h5>
                        <p class="card-text text-success fw-bold">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></p>
                        <button class="btn btn-outline-primary btn-sm w-100">Detail</button>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

    <h3 class="mt-5 mb-3">Katalog Minuman</h3>
<div class="row">
    <?php
    $minuman = mysqli_query($conn, "SELECT * FROM minuman");
    while($drink = mysqli_fetch_assoc($minuman)) : ?>
    <div class="col-md-3 mb-4">
        <div class="card h-100 shadow-sm border-0">
            <img src="../uploads/<?= $drink['gambar_minuman']; ?>" class="card-img-top" style="height: 180px; object-fit: cover;">
            <div class="card-body">
                <h6 class="fw-bold"><?= $drink['nama_minuman']; ?></h6>
                <p class="text-success small">Harga: Rp <?= number_format($drink['harga'], 0, ',', '.'); ?></p>
                <button class="btn btn-sm btn-outline-primary w-100 disabled">Hanya Lihat</button>
            </div>
        </div>
    </div>
    <?php endwhile; ?>
</div>
</body>
</html>