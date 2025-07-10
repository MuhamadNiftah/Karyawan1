<?php
session_start();
include "koneksi.php";

// Pastikan user login
if (!isset($_SESSION['username']) || strtolower($_SESSION['role']) != 'user') {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$cek = mysqli_query($link, "SELECT * FROM karyawan WHERE username = '$username'");
$dataUser = mysqli_fetch_assoc($cek);

if (!$dataUser) {
    echo "Data karyawan tidak ditemukan.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pengajuan Cuti Menikah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h3 class="mb-4">FORM PENGAJUAN CUTI MENIKAH</h3>
    <form action="simpan_cuti_menikah.php" method="POST">
        <!-- Otomatis dari session -->
        <input type="hidden" name="id_karyawan" value="<?= $dataUser['id'] ?>">

        <div class="form-group">
            <label>Nama Pegawai</label>
            <input type="text" name="nama_pegawai" class="form-control" value="<?= $dataUser['nama'] ?>" readonly>
        </div>
        <div class="form-group">
            <label>NIK</label>
            <input type="text" name="nik" class="form-control" value="<?= $dataUser['nik'] ?>" readonly>
        </div>
        <div class="form-group">
            <label>Divisi</label>
            <input type="text" name="divisi" class="form-control" value="<?= $dataUser['divisi'] ?>" readonly>
        </div>
        <div class="form-group">
            <label>Jabatan</label>
            <input type="text" name="jabatan" class="form-control" value="<?= $dataUser['jabatan'] ?>" readonly>
        </div>
        <div class="form-group">
            <label>Telepon</label>
            <input type="text" name="telepon" class="form-control" value="<?= $dataUser['telp'] ?>" readonly>
        </div>

        <!-- Inputan Manual -->
        <div class="form-group">
            <label>Alasan Pengajuan Cuti</label>
            <input type="text" name="alasan" class="form-control" value="Cuti Menikah" readonly>
        </div>
        <div class="form-group">
            <label>Tanggal Pengajuan Cuti</label>
            <input type="date" name="tanggal_pengajuan" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Durasi Cuti (hari)</label>
            <input type="number" name="durasi" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Tanggal Mulai Cuti</label>
            <input type="date" name="mulai_cuti" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Tanggal Berakhir Cuti</label>
            <input type="date" name="berakhir_cuti" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Alamat Selama Cuti</label>
            <textarea name="alamat_cuti" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Ajukan Cuti</button>
    </form>
</div>
</body>
</html>
