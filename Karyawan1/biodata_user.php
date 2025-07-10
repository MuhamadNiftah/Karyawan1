<?php
session_start();
if (!isset($_SESSION['username']) || strtolower($_SESSION['role']) != 'user') {
    header('Location: login.php');
    exit();
}
include 'koneksi.php';

$username = $_SESSION['username'];
$query = mysqli_query($link, "SELECT * FROM karyawan WHERE username = '$username'");
$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Biodata User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
    <h3 class="mb-4">Biodata Anda</h3>

    <?php if ($data): ?>
        <table class="table table-bordered bg-white">
            <tr><th>Nama</th><td><?= htmlspecialchars($data['nama']) ?></td></tr>
            <tr><th>NIK</th><td><?= htmlspecialchars($data['nik']) ?></td></tr>
            <tr><th>Divisi</th><td><?= htmlspecialchars($data['divisi']) ?></td></tr>
            <tr><th>Jabatan</th><td><?= htmlspecialchars($data['jabatan']) ?></td></tr>
            <tr><th>Telepon</th><td><?= htmlspecialchars($data['telp']) ?></td></tr>
        </table>
    <?php else: ?>
        <div class="alert alert-warning">Data belum tersedia.</div>
    <?php endif; ?>

    <a href="dashboard_user.php" class="btn btn-secondary">Kembali ke Dashboard</a>
</div>
</body>
</html>
