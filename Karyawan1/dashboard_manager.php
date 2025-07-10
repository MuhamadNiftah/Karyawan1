<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Manager') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>DIDIMAX BERJANGKA - Manager</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="sidebar">   
        <h2>
            <div class="logo-container">
                <img src="Karyawan_New/logo.png" alt="logo.png" class="logo-img">
            </div>
        </h2>
        <ul>
            <li><a href="#"><i>🛠️</i> Dashboard</a></li>
            <li><a href="#"><i>📥</i> Ticket Masuk</a></li>
            <li><a href="#"><i>✅</i> Ticket Selesai</a></li>
            <li><a href="#"><i>📊</i> Laporan Ticket</a></li>
        </ul>
        <div class="logout">
            <p><?php echo htmlspecialchars($_SESSION['username']); ?> | <a href="logout.php">Logout</a></p>
        </div>
    </div>

    <div class="main-content">
        <h1>Dashboard Manager</h1>
        <div class="card-container">
            <div class="card">
                <p class="label">Ticket Masuk</p>
                <p class="value">0</p>
            </div>
            <div class="card">
                <p class="label">Sedang Dikerjakan</p>
                <p class="value">0</p>
            </div>
            <div class="card">
                <p class="label">Ticket Selesai</p>
                <p class="value">0</p>
            </div>
            <div class="card">
                <p class="label">Total Ticket Bulan Ini</p>
                <p class="value">0</p>
            </div>
        </div>
    </div>
</body>
</html>
