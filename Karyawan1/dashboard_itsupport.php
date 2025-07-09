<?php
session_start();
if (!isset($_SESSION['username']) || strtolower($_SESSION['role']) !== 'it support') {
    header("Location: login.php");
    exit();
}

include "koneksi.php";

// Hitung jumlah tiket berdasarkan status
$ticket_masuk   = mysqli_fetch_assoc(mysqli_query($link, "SELECT COUNT(*) as jumlah FROM tickets WHERE status = 'Masuk'"))['jumlah'];
$ticket_proses  = mysqli_fetch_assoc(mysqli_query($link, "SELECT COUNT(*) as jumlah FROM tickets WHERE status = 'Proses'"))['jumlah'];
$ticket_selesai = mysqli_fetch_assoc(mysqli_query($link, "SELECT COUNT(*) as jumlah FROM tickets WHERE status = 'Selesai'"))['jumlah'];

// Total tiket bulan ini
$bulan_ini = date('Y-m');
$total_bulan_ini = mysqli_fetch_assoc(mysqli_query($link, "SELECT COUNT(*) as jumlah FROM tickets WHERE tanggal LIKE '$bulan_ini%'"))['jumlah'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>DIDIMAX BERJANGKA - IT Support</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
        margin: 0;
        font-family: 'Segoe UI', sans-serif;
        background-color: #f1f3f5;
    }
    .sidebar {
        position: fixed;
        left: 0;
        top: 0;
        bottom: 0;
        width: 220px;
        background-color: #343a40;
        padding: 20px;
        color: white;
    }
    .sidebar .logo-container {
        text-align: center;
        margin-bottom: 30px;
    }
    .sidebar .logo-container img {
        max-width: 200px;
    }
    .sidebar ul {
        list-style-type: none;
        padding: 0;
    }
    .sidebar ul li a {
        display: block;
        padding: 10px 15px;
        margin-bottom: 10px;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        transition: 0.3s;
    }
    .sidebar ul li a:hover {
        background-color: #495057;
    }
    .sidebar i {
        margin-right: 10px;
    }
    .logout {
        position: absolute;
        bottom: 20px;
        left: 20px;
        font-size: 14px;
    }
    .logout a {
        color: #ffc107;
        text-decoration: none;
    }
    .main-content {
        margin-left: 240px;
        padding: 40px;
    }
    .main-content h1 {
        font-size: 28px;
        font-weight: bold;
        color: #333;
    }
    .card-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-top: 30px;
    }
    .card {
        background-color: white;
        padding: 25px;
        border-left: 6px solid #007bff;
        border-radius: 10px;
        box-shadow: 0 3px 6px rgba(0,0,0,0.1);
        text-align: center;
        transition: 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .card .label {
        font-size: 14px;
        color: #6c757d;
        margin-bottom: 10px;
    }
    .card .value {
        font-size: 24px;
        font-weight: bold;
        color: #343a40;
    }

    @media (max-width: 768px) {
        .main-content {
            margin-left: 0;
            padding: 20px;
        }
        .sidebar {
            position: relative;
            width: 100%;
            display: flex;
            flex-direction: row;
            overflow-x: auto;
            white-space: nowrap;
        }
        .sidebar ul {
            display: flex;
            flex-direction: row;
        }
        .sidebar ul li {
            margin-right: 10px;
        }
        .logout {
            position: relative;
            margin-top: 10px;
        }
    }
  </style>
</head>
<body>

<div class="sidebar">
    <div class="logo-container">
        <img src="images/logo1.png" alt="logo.png" class="logo-img">
    </div>
    <ul>
        <li><a href="#"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
        <li><a href="ticket_masuk.php"><i class="fas fa-inbox"></i> Ticket Masuk</a></li>
        <li><a href="ticket_diproses.php"><i class="fas fa-spinner"></i> Ticket Diproses</a></li>
        <li><a href="#"><i class="fas fa-check-circle"></i> Ticket Selesai</a></li>
        <li><a href="#"><i class="fas fa-chart-bar"></i> Laporan Ticket</a></li>
    </ul>
    <div class="logout">
        <?= htmlspecialchars($_SESSION['username']); ?> | <a href="logout.php">Logout</a>
    </div>
</div>

<div class="main-content">
    <h1>Dashboard IT Support</h1>
    <div class="card-container">
        <div class="card">
            <p class="label">Ticket Masuk</p>
            <p class="value"><?= $ticket_masuk ?></p>
        </div>
        <div class="card">
            <p class="label">Sedang Dikerjakan</p>
            <p class="value"><?= $ticket_proses ?></p>
        </div>
        <div class="card">
            <p class="label">Ticket Selesai</p>
            <p class="value"><?= $ticket_selesai ?></p>
        </div>
        <div class="card">
            <p class="label">Total Bulan Ini</p>
            <p class="value"><?= $total_bulan_ini ?></p>
        </div>
    </div>
</div>

</body>
</html>
