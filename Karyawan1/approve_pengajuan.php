<?php
session_start();
include 'koneksi.php';

// Cek login admin
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Ambil data cuti + info karyawan (JOIN) + urutkan data terbaru paling atas
$query = "
    SELECT c.*, k.nama AS nama_pegawai, k.nik, k.divisi, k.jabatan, k.telp AS telepon
    FROM cuti c
    LEFT JOIN karyawan k ON c.id_karyawan = k.id
    WHERE c.status = 'Menunggu Approval'
    ORDER BY c.id DESC
";
$result = mysqli_query($link, $query);
if (!$result) {
    die("Query gagal: " . mysqli_error($link));
}

// Format tanggal
function formatTanggal($tanggal) {
    if (!$tanggal || $tanggal == '0000-00-00') {
        return '-';
    }
    return date('d-m-Y', strtotime($tanggal));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Approve Pengajuan Cuti</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .btn-custom {
            min-width: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .btn i {
            margin-right: 5px;
        }
    </style>
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-user-check"></i> Daftar Pengajuan Cuti</h5>
        </div>
        <div class="card-body">
            <?php if (mysqli_num_rows($result) > 0): ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Pegawai</th>
                                <th>NIK</th>
                                <th>Divisi</th>
                                <th>Jabatan</th>
                                <th>Alasan</th>
                                <th>Periode</th>
                                <th>Telepon</th>
                                <th>Tanggal Pengajuan</th>
                                <th>Aksi</th>
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
                                    <td><?= nl2br(htmlspecialchars($row['alasan'])) ?></td>
                                    <td><?= formatTanggal($row['mulai_cuti']) ?> s/d <?= formatTanggal($row['berakhir_cuti']) ?></td>
                                    <td><?= htmlspecialchars($row['telepon']) ?></td>
                                    <td><?= formatTanggal($row['tanggal_pengajuan']) ?></td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <a href="setujui_cuti.php?id=<?= $row['id'] ?>" 
                                               class="btn btn-success btn-sm mb-1 btn-custom">
                                                <i class="fas fa-check-circle"></i> Setujui
                                            </a>
                                            <a href="tolak_cuti.php?id=<?= $row['id'] ?>" 
                                               class="btn btn-danger btn-sm btn-custom" 
                                               onclick="return confirm('Tolak pengajuan ini?')">
                                                <i class="fas fa-times-circle"></i> Tolak
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-info text-center">
                    Belum ada pengajuan cuti yang menunggu persetujuan.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>
