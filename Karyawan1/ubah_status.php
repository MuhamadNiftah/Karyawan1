<?php
$koneksi = new mysqli("localhost", "root", "", "db_karyawan");
$id = $_GET['id'];

$koneksi->query("UPDATE tickets SET status = 'selesai' WHERE id = $id");
header("Location: proses_acc.php");
?>
