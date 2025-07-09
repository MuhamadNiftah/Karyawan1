<?php
session_start();
include "koneksi.php";

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

// Ambil data karyawan berdasarkan username
$cek = mysqli_query($link, "SELECT * FROM karyawan WHERE username = '$username'");
if (!$cek || mysqli_num_rows($cek) === 0) {
    die("Data karyawan tidak ditemukan.");
}
$dataUser = mysqli_fetch_assoc($cek);
$id_karyawan = $dataUser['id'];

// Ambil data dari form
$alasan            = mysqli_real_escape_string($link, $_POST['alasan']);
$tanggal_pengajuan = $_POST['tanggal_pengajuan'];
$durasi            = $_POST['durasi'];
$mulai_cuti        = $_POST['mulai_cuti'];
$berakhir_cuti     = $_POST['berakhir_cuti'];
$alamat_cuti       = mysqli_real_escape_string($link, $_POST['alamat_cuti']);
$pertimbangan      = mysqli_real_escape_string($link, $_POST['pertimbangan_atasan']);
$catatan           = mysqli_real_escape_string($link, $_POST['catatan']);

// Insert data ke tabel cuti
$query = "
    INSERT INTO cuti (
        id_karyawan, alasan, tanggal_pengajuan, durasi, 
        mulai_cuti, berakhir_cuti, alamat_cuti, 
        pertimbangan_atasan, catatan, status
    ) VALUES (
        '$id_karyawan', '$alasan', '$tanggal_pengajuan', '$durasi',
        '$mulai_cuti', '$berakhir_cuti', '$alamat_cuti',
        '$pertimbangan', '$catatan', 'Menunggu Approval'
    )
";

$insert = mysqli_query($link, $query);

if ($insert) {
    echo "<script>alert('Cuti berhasil diajukan!');window.location='status_pengajuan.php';</script>";
} else {
    echo "Gagal mengajukan cuti: " . mysqli_error($link);
}
?>
