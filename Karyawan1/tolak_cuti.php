<?php
// tolak_cuti.php
include 'koneksi.php';
session_start();

$id = $_GET['id'];
mysqli_query($link, "UPDATE pengajuan_cuti SET status='Ditolak' WHERE id=$id");
header("Location: approve_pengajuan.php");
exit();
?>
