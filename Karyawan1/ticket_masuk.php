<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['username']) || strtolower($_SESSION['role']) !== 'it support') {
    header("Location: login.php");
    exit();
}

// Ambil semua tiket yang statusnya "Masuk"
$result = mysqli_query($link, "SELECT * FROM tickets WHERE status = 'Masuk' ORDER BY tanggal DESC");

// Tangani update status jika tombol ditekan
if (isset($_GET['aksi']) && isset($_GET['id'])) {
    $aksi = $_GET['aksi'];
    $id   = intval($_GET['id']);
    
    if ($aksi == "setuju") {
        mysqli_query($link, "UPDATE tickets SET status = 'Proses' WHERE id = $id");
    } elseif ($aksi == "tolak") {
        mysqli_query($link, "UPDATE tickets SET status = 'Ditolak' WHERE id = $id");
    }

    header("Location: ticket_masuk.php?pesan=updated");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ticket Masuk - IT Support</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Daftar Ticket Masuk</h2>

    <?php if (isset($_GET['pesan']) && $_GET['pesan'] == 'berhasil'): ?>
        <div class="alert alert-success">✅ Ticket berhasil ditambahkan!</div>
    <?php elseif (isset($_GET['pesan']) && $_GET['pesan'] == 'updated'): ?>
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
                <td>
                    <span class="badge badge-warning"><?= htmlspecialchars($row['status']) ?></span><br><br>
                    <a href="?aksi=setuju&id=<?= $row['id'] ?>" class="btn btn-success btn-sm" onclick="return confirm('Setujui ticket ini?')">Setuju</a>
                    <a href="?aksi=tolak&id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tolak ticket ini?')">Tolak</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
