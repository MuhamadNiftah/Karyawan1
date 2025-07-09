<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$koneksi = new mysqli("localhost", "root", "", "db_karyawan");
$tickets = $koneksi->query("SELECT * FROM tickets WHERE status = 'proses'");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>PROSES / ACC</title>
</head>
<body>
    <h1>Ticket Dalam Proses</h1>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Tanggal</th>
            <th>Nama</th>
            <th>Lokasi</th>
            <th>Device</th>
            <th>Masalah</th>
            <th>Prioritas</th>
            <th>Dampak</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        <?php while($row = $tickets->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['tanggal'] ?></td>
            <td><?= $row['nama_user'] ?></td>
            <td><?= $row['lokasi'] ?></td>
            <td><?= $row['device'] ?></td>
            <td><?= $row['masalah'] ?></td>
            <td><?= $row['prioritas_permohonan'] ?></td>
            <td><?= $row['dampak_permohonan'] ?></td>
            <td><?= $row['status'] ?></td>
            <td><a href="acc_ticket.php?id=<?= $row['id'] ?>">✔ ACC</a></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
