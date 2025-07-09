<?php
$host = "localhost"; // Nama host (localhost jika menggunakan XAMPP/MAMP)
$user = "root"; // Username MySQL Anda
$pass = ""; // Password MySQL, kosong jika tidak ada
$db   = "db_karyawan"; // Nama database yang digunakan

// Membuat koneksi
$link = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$link) {
    // Jika gagal koneksi, tampilkan pesan kesalahan
    die("Koneksi gagal: " . mysqli_connect_error());
} else {
    // Jika berhasil, koneksi akan berjalan
    // echo "Koneksi berhasil!";
}
?>
