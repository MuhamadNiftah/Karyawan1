<?php
include "koneksi.php";

$id_karyawan       = $_POST['kode_id'];  // ini juga sebagai foreign key ke tabel karyawan
$nama_pegawai      = $_POST['nama_pegawai'];
$nik               = $_POST['nik'];
$divisi            = $_POST['divisi'];
$jabatan           = $_POST['jabatan'];
$telepon           = $_POST['telepon'];
$alasan            = $_POST['alasan'];
$tanggal_pengajuan = $_POST['tanggal_pengajuan'];
$durasi            = $_POST['durasi'];
$mulai_cuti        = $_POST['mulai_cuti'];
$berakhir_cuti     = $_POST['berakhir_cuti'];
$alamat_cuti       = $_POST['alamat_cuti'];
$pertimbangan      = $_POST['pertimbangan_atasan'];
$catatan           = $_POST['catatan'];
$status            = "Menunggu Approval"; // default

$query = "
INSERT INTO cuti (
    kode_id, nama_pegawai, nik, divisi, jabatan, telepon, alasan,
    tanggal_pengajuan, durasi, mulai_cuti, berakhir_cuti,
    alamat_cuti, pertimbangan_atasan, catatan, id_karyawan, status
) VALUES (
    '$id_karyawan', '$nama_pegawai', '$nik', '$divisi', '$jabatan', '$telepon', '$alasan',
    '$tanggal_pengajuan', '$durasi', '$mulai_cuti', '$berakhir_cuti',
    '$alamat_cuti', '$pertimbangan', '$catatan', '$id_karyawan', '$status'
)";

if (mysqli_query($link, $query)) {
    echo "<script>alert('Pengajuan cuti berhasil disimpan!'); window.location.href='dashboard_user.php';</script>";
} else {
    echo "Gagal menyimpan data: " . mysqli_error($link);
}
?>
