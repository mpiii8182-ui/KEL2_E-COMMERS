<?php
include '../../config/config.php';
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT gambar_minuman FROM minuman WHERE id=$id"));

unlink("../../uploads/" . $data['gambar_minuman']); // Hapus file dari folder
mysqli_query($conn, "DELETE FROM minuman WHERE id=$id");
header("Location: index.php");
?>