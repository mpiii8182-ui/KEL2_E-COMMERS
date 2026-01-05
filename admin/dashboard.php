<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
        <div class="container">
            <a class="navbar-brand" href="#">Admin Panel</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link active" href="dashboard.php">Home</a>
                <a class="nav-link" href="infoUser.php">Data User</a>
                <a class="nav-link" href="katalogmakanan/index.php">Katalog makanan</a>
                <a class="nav-link" href="katalogminuman">katalog minuman</a>
                <a class="nav-link btn btn-dark ms-2" href="logout.php">Logout</a>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <h1>Welcome, Admin <?php echo $_SESSION['admin_username']; ?>!</h1>
        <p>Anda memiliki akses penuh untuk mengelola data user.</p>
    </div>
</body>
</html>