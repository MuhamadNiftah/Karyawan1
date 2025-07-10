<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama_pegawai'];
    $nik = $_POST['nik'];
    $divisi = $_POST['divisi'];
    $jabatan = $_POST['jabatan'];
    $alasan = $_POST['alasan'];
    $jumlah_hari = $_POST['jumlah_hari'];
    $mulai = $_POST['mulai'];
    $sampai = $_POST['sampai'];
    $alamat_cuti = $_POST['alamat_cuti'];
    $telepon = $_POST['telepon'];

    // Insert ke database
    $query = "INSERT INTO pengajuan_cuti (nama, nik, divisi, jabatan, alasan, jumlah_hari, mulai, sampai, alamat_cuti, telepon, status)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Menunggu Approval')";
    
    $stmt = mysqli_prepare($link, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssssiisss", $nama, $nik, $divisi, $jabatan, $alasan, $jumlah_hari, $mulai, $sampai, $alamat_cuti, $telepon);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("Location: approve_pengajuan.php?pesan=berhasil");
    } else {
        die("Query error: " . mysqli_error($link));
    }
} else {
    header("Location: index.php");
}
?>
