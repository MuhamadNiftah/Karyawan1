<?php
session_start();
include "koneksi.php";

// Cek login session
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$no_id = $_SESSION['username'];

// Ambil data karyawan berdasarkan no_id
$cek = mysqli_query($link, "SELECT * FROM karyawan WHERE no_id = '$no_id'");
if (!$cek || mysqli_num_rows($cek) === 0) {
    die("Data karyawan tidak ditemukan.");
}
$dataUser = mysqli_fetch_assoc($cek);
$id_karyawan = $dataUser['id'];

// Ambil data dari form
$kode_id             = mysqli_real_escape_string($link, $_POST['kode_id']);
$nama_pegawai        = mysqli_real_escape_string($link, $_POST['nama_pegawai']);
$nik                 = mysqli_real_escape_string($link, $_POST['nik']);
$divisi              = mysqli_real_escape_string($link, $_POST['divisi']);
$jabatan             = mysqli_real_escape_string($link, $_POST['jabatan']);
$telepon             = mysqli_real_escape_string($link, $_POST['telepon']);
$alasan              = mysqli_real_escape_string($link, $_POST['alasan']);
$tanggal_pengajuan   = mysqli_real_escape_string($link, $_POST['tanggal_pengajuan']);
$durasi              = mysqli_real_escape_string($link, $_POST['durasi']);
$mulai_cuti          = mysqli_real_escape_string($link, $_POST['mulai_cuti']);
$berakhir_cuti       = mysqli_real_escape_string($link, $_POST['berakhir_cuti']);
$alamat_cuti         = mysqli_real_escape_string($link, $_POST['alamat_cuti']);
$pertimbangan_atasan = mysqli_real_escape_string($link, $_POST['pertimbangan_atasan']);
$catatan             = mysqli_real_escape_string($link, $_POST['catatan']);
$status              = "Menunggu Approval";

// Simpan ke tabel cuti
$query = "INSERT INTO cuti (
    kode_id, nama_pegawai, nik, divisi, jabatan, telepon,
    alasan, tanggal_pengajuan, durasi, mulai_cuti, berakhir_cuti,
    alamat_cuti, pertimbangan_atasan, catatan, id_karyawan, status
) VALUES (
    '$kode_id', '$nama_pegawai', '$nik', '$divisi', '$jabatan', '$telepon',
    '$alasan', '$tanggal_pengajuan', '$d_
