<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin - DIDIMAX</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.1.4/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
    }
    .sidebar .nav-item .nav-link span {
      font-weight: 500;
    }
    .sidebar-brand-icon img {
      max-width: 150px;
    }
    .topbar {
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    .card .card-body {
      transition: transform 0.2s ease-in-out;
    }
    .card:hover .card-body {
      transform: scale(1.03);
    }
  </style>
</head>
<body id="page-top">

<div id="wrapper">
  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
      <div class="sidebar-brand-icon">
        <img src="images/logo1.png" alt="Logo">
      </div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
      <a class="nav-link" href="#">
        <i class="fas fa-tachometer-alt"></i>
        <span>Dashboard Admin</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="tambah_user.php">
        <i class="fas fa-user-plus"></i>
        <span>Tambah Akun User</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="from_cuti.php">
        <i class="fas fa-calendar-check"></i>
        <span>Form Cuti</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="Ticketing.html">
        <i class="fas fa-ticket-alt"></i>
        <span>Form Tiket</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="approve_pengajuan.php">
        <i class="fas fa-thumbs-up"></i>
        <span>Approve Pengajuan</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="report_pengajuan.php">
        <i class="fas fa-chart-line"></i>
        <span>Report Pengajuan</span>
      </a>
    </li>
    <hr class="sidebar-divider">
    <li class="nav-item">
      <a class="nav-link text-warning" href="logout.php">
        <i class="fas fa-sign-out-alt"></i>
        <span>Logout (<?= htmlspecialchars($_SESSION['username']); ?>)</span>
      </a>
    </li>
  </ul>

  <div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
      <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <span class="h5 font-weight-bold text-primary ml-3">Selamat Datang, <?= htmlspecialchars($_SESSION['username']); ?>!</span>
      </nav>
      <div class="container-fluid">
        <h1 class="h4 mb-4 text-gray-800">Dashboard Statistik</h1>
        <div class="row">
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body text-center">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Cuti</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
              <div class="card-body text-center">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Semua Aset</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
              <div class="card-body text-center">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Tiket Bulan Ini</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
              <div class="card-body text-center">
                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Belum Selesai</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Grafik Data Pengajuan Cuti -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Grafik Pengajuan Cuti per Bulan</h6>
          </div>
          <div class="card-body">
            <canvas id="grafikCuti"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.1.4/js/sb-admin-2.min.js"></script>
<script>
  $(document).ready(function() {
    $.ajax({
      url: 'grafik_data_cuti.php',
      method: 'GET',
      dataType: 'json',
      success: function(data) {
        const ctx = document.getElementById('grafikCuti').getContext('2d');
        new Chart(ctx, {
          type: 'bar',
          data: {
            labels: data.bulan,
            datasets: [{
              label: 'Jumlah Pengajuan',
              data: data.jumlah,
              backgroundColor: 'rgba(54, 162, 235, 0.7)',
              borderColor: 'rgba(54, 162, 235, 1)',
              borderWidth: 1
            }]
          },
          options: {
            responsive: true,
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });
      }
    });
  });
</script>
</body>
</html>
