<?php
session_start();
include "koneksi.php"; // koneksi via $link

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id         = trim($_POST['Id']);
    $tanggal    = trim($_POST['Tanggal']);
    $nama_user  = trim($_POST['Nama_User']);
    $lokasi     = trim($_POST['Lokasi']);
    $device     = trim($_POST['Device']);
    $masalah    = trim($_POST['Masalah']);
    $prioritas  = trim($_POST['Prioritas_Permohonan']);
    $dampak     = trim($_POST['Dampak_Permohonan']);

    if (empty($id) || empty($tanggal) || empty($nama_user)) {
        echo "ID, Tanggal, dan Nama User wajib diisi.";
        exit;
    }

    $status = "Masuk";

    $stmt = mysqli_prepare($link, "INSERT INTO tickets (id, tanggal, nama_user, lokasi, device, masalah, prioritas, dampak, status) 
                                   VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssssssss", $id, $tanggal, $nama_user, $lokasi, $device, $masalah, $prioritas, $dampak, $status);
        if (mysqli_stmt_execute($stmt)) {
            // Redirect ke halaman ticket masuk
            header("Location: ticket_masuk.php?pesan=berhasil");
            exit;
        } else {
            echo "❌ Gagal menambahkan ticket: " . mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "❌ Query error: " . mysqli_error($link);
    }

    mysqli_close($link);
}
?>
