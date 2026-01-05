<?php
include '../../config/config.php';
$id = $_GET['id'];

// Ambil nama file gambar untuk dihapus dari folder uploads
$data = mysqli_query($conn, "SELECT gambar FROM makanan WHERE id=$id");
$row = mysqli_fetch_assoc($data);
unlink("../../uploads/" . $row['gambar']);

mysqli_query($conn, "DELETE FROM makanan WHERE id=$id");
header("Location: index.php");
?>