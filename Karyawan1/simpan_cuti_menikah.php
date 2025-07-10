<?php
session_start();
include 'koneksi.php';

// Cek apakah user sudah login
if (!isset($_SESSION['username']) || strtolower($_SESSION['role']) != 'user') {
    header("Location: login.php");
    exit();
}

// Tangkap data dari form
$id_karyawan = $_POST['id_karyawan'];
$alasan = $_POST['alasan'];
$tanggal_pengajuan = $_POST['tanggal_pengajuan'];
$durasi = $_POST['durasi'];
$mulai_cuti = $_POST['mulai_cuti'];
$berakhir_cuti = $_POST['berakhir_cuti'];
$alamat_cuti = $_POST['alamat_cuti'];
$status = "Menunggu Approval";

// Simpan ke tabel cuti
$query = mysqli_query($link, "INSERT INTO cuti (
    id_karyawan, alasan, tanggal_pengajuan, durasi, mulai_cuti, berakhir_cuti, alamat_cuti, status
) VALUES (
    '$id_karyawan', '$alasan', '$tanggal_pengajuan', '$durasi', '$mulai_cuti', '$berakhir_cuti', '$alamat_cuti', '$status'
)");

if ($query) {
    // Berhasil, arahkan ke halaman status pengajuan
    header("Location: status_pengajuan.php");
    exit();
} else {
    // Gagal, tampilkan pesan error
    echo "<script>alert('Gagal menyimpan pengajuan cuti.'); window.location='form_cuti_menikah.php';</script>";
}
?>
