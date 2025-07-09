<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$query = "SELECT * FROM pengajuan_cuti WHERE status IN ('Disetujui', 'Ditolak') ORDER BY created_at DESC";
$result = mysqli_query($link, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Report Pengajuan Cuti</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Report Pengajuan Cuti (Disetujui / Ditolak)</h5>
        </div>
        <div class="card-body position-relative">
            <?php if (mysqli_num_rows($result) > 0): ?>
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Divisi</th>
                        <th>Jabatan</th>
                        <th>Alasan</th>
                        <th>Periode</th>
                        <th>Status</th>
                        <th>Telepon</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['nama']) ?></td>
                        <td><?= htmlspecialchars($row['nik']) ?></td>
                        <td><?= htmlspecialchars($row['divisi']) ?></td>
                        <td><?= htmlspecialchars($row['jabatan']) ?></td>
                        <td><?= nl2br(htmlspecialchars($row['alasan'])) ?></td>
                        <td><?= date("d/m/Y", strtotime($row['mulai'])) ?> s/d <?= date("d/m/Y", strtotime($row['sampai'])) ?></td>
                        <td>
                            <?php if ($row['status'] == 'Disetujui'): ?>
                                <span class="badge badge-success"><?= $row['status'] ?></span>
                            <?php else: ?>
                                <span class="badge badge-danger"><?= $row['status'] ?></span>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($row['telepon']) ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <!-- Tombol Export ke Excel di pojok kanan bawah -->
            <div class="d-flex justify-content-end mt-4">
                <a href="export_cuti_excel.php" class="btn btn-success">
                    <i class="fas fa-file-excel"></i> Export ke Excel
                </a>
            </div>

            <?php else: ?>
                <p class="text-center">Belum ada data pengajuan yang disetujui atau ditolak.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>
