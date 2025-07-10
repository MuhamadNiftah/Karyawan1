<?php
include "koneksi.php";

$id = $_GET['id'];
mysqli_query($link, "UPDATE cuti SET status='Ditolak' WHERE id='$id'");

header("Location: approve_pengajuan.php");
exit();
?>
