<?php
session_start();
include "koneksi.php";

// Hanya untuk admin
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit();
}

// Ambil semua data cuti + join ke tabel karyawan
$query = "
    SELECT c.*, k.nama AS nama_pegawai, k.nik, k.divisi, k.jabatan
    FROM cuti c
    LEFT JOIN karyawan k ON c.id_karyawan = k.id
    ORDER BY c.id DESC
";
$result = mysqli_query($link, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Status Pengajuan Cuti</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0"> Daftar Pengajuan Cuti</h5>
        </div>
        <div class="card-body">
            <?php if (mysqli_num_rows($result) > 0): ?>
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Divisi</th>
                            <th>Jabatan</th>
                            <th>Alasan</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Durasi</th>
                            <th>Mulai</th>
                            <th>Selesai</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= htmlspecialchars($row['nama_pegawai']) ?></td>
                                <td><?= htmlspecialchars($row['nik']) ?></td>
                                <td><?= htmlspecialchars($row['divisi']) ?></td>
                                <td><?= htmlspecialchars($row['jabatan']) ?></td>
                                <td><?= htmlspecialchars($row['alasan']) ?></td>
                                <td><?= date('d-m-Y', strtotime($row['tanggal_pengajuan'])) ?></td>
                                <td><?= $row['durasi'] ?> hari</td>
                                <td><?= date('d-m-Y', strtotime($row['mulai_cuti'])) ?></td>
                                <td><?= date('d-m-Y', strtotime($row['berakhir_cuti'])) ?></td>
                                <td>
                                    <?php
                                    if ($row['status'] == 'Menunggu Approval') {
                                        echo '<span class="badge badge-warning">Menunggu</span>';
                                    } elseif ($row['status'] == 'Disetujui') {
                                        echo '<span class="badge badge-success">Disetujui</span>';
                                    } elseif ($row['status'] == 'Ditolak') {
                                        echo '<span class="badge badge-danger">Ditolak</span>';
                                    } else {
                                        echo htmlspecialchars($row['status']);
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert alert-info text-center">Belum ada data cuti.</div>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>
