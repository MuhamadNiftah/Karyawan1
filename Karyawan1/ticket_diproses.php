<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['username']) || strtolower($_SESSION['role']) !== 'it support') {
    header("Location: login.php");
    exit();
}

// Ambil semua tiket yang statusnya "Proses"
$result = mysqli_query($link, "SELECT * FROM tickets WHERE status = 'Proses' ORDER BY tanggal DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ticket Diproses - IT Support</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Daftar Ticket Sedang Diproses</h2>

    <?php if (isset($_GET['pesan']) && $_GET['pesan'] == 'updated'): ?>
        <div class="alert alert-info">ℹ️ Status tiket berhasil diperbarui.</div>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Tanggal</th>
                <th>Nama User</th>
                <th>Lokasi</th>
                <th>Device</th>
                <th>Masalah</th>
                <th>Prioritas</th>
                <th>Dampak</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td><?= htmlspecialchars($row['tanggal']) ?></td>
                <td><?= htmlspecialchars($row['nama_user']) ?></td>
                <td><?= htmlspecialchars($row['lokasi']) ?></td>
                <td><?= htmlspecialchars($row['device']) ?></td>
                <td><?= htmlspecialchars($row['masalah']) ?></td>
                <td><?= htmlspecialchars($row['prioritas']) ?></td>
                <td><?= htmlspecialchars($row['dampak']) ?></td>
                <td><span class="badge badge-info"><?= htmlspecialchars($row['status']) ?></span></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
