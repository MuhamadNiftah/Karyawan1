<?php
include "koneksi.php";
if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $res = mysqli_query($link, "SELECT * FROM karyawan WHERE id = $id");
    echo json_encode(mysqli_fetch_assoc($res));
}
?>
