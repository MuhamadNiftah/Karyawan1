<?php
session_start();
include "koneksi.php";

// Cek jika user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Ambil no_id dari session (disimpan sebagai username)
$no_id = $_SESSION['username'];

// Ambil data karyawan berdasarkan no_id
$cek = mysqli_query($link, "SELECT * FROM karyawan WHERE no_id = '$no_id'");
if (!$cek || mysqli_num_rows($cek) === 0) {
    die("Data karyawan tidak ditemukan.");
}

$dataUser = mysqli_fetch_assoc($cek);
$id_karyawan = $dataUser['id'];

// Ambil data cuti dengan alasan "Cuti Menikah" berdasarkan id_karyawan
$query = "
    SELECT * FROM cuti 
    WHERE id_karyawan = '$id_karyawan' 
      AND alasan = 'Cuti Menikah'
    ORDER BY tanggal_pengajuan DESC
";
$result = mysqli_query($link, $query);
if (!$result) {
    die("Query cuti error: " . mysqli_error($link));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Status Cuti Menikah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f9f9f9; }
        .container { background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px #ccc; }
        h3 { color: #333; }
    </style>
</head>
<body>
<div class="container mt-5">
    <h3>Status Pengajuan Cuti Menikah</h3>
    <hr>
    <?php if (mysqli_num_rows($result) === 0): ?>
        <div class="alert alert-info mt-4">
            Anda belum pernah mengajukan cuti menikah.
        </div>
    <?php else: ?>
        <table class="table table-bordered mt-4 table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Durasi</th>
                    <th>Mulai</th>
                    <th>Selesai</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            <?php $no = 1; while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= date('d-m-Y', strtotime($row['tanggal_pengajuan'])) ?></td>
                    <td><?= htmlspecialchars($row['durasi']) ?> hari</td>
                    <td><?= date('d-m-Y', strtotime($row['mulai_cuti'])) ?></td>
                    <td><?= date('d-m-Y', strtotime($row['berakhir_cuti'])) ?></td>
                    <td>
                        <?php
                        $status = $row['status'];
                        if ($status == 'Menunggu Approval') {
                            echo '<span class="badge badge-warning">Menunggu</span>';
                        } elseif ($status == 'Disetujui') {
                            echo '<span class="badge badge-success">Disetujui</span>';
                        } elseif ($status == 'Ditolak') {
                            echo '<span class="badge badge-danger">Ditolak</span>';
                        } else {
                            echo '<span class="badge badge-secondary">Tidak Diketahui</span>';
                        }
                        ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
</body>
</html>
