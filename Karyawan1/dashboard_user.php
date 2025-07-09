<?php
session_start();
if (!isset($_SESSION['username']) || strtolower($_SESSION['role']) != 'user') {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard User - DIDIMAX BERJANGKA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & SB Admin 2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.1.4/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f8f9fc;
        }
        .sidebar-custom {
            background-color: #4e73df;
            min-height: 100vh;
            width: 240px;
        }
        .sidebar-custom a {
            color: #fff;
            padding: 12px 20px;
            display: block;
            transition: background 0.3s ease;
        }
        .sidebar-custom a:hover {
            background-color: #2e59d9;
            text-decoration: none;
        }
        .brand-header {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.2);
        }
        .brand-header img {
            width: 200px;
            margin-bottom: 5px;
        }
        .brand-header h4 {
            color: white;
            font-size: 18px;
            margin-top: 5px;
        }
        .main-content {
            margin-left: 240px;
            padding: 2rem;
        }
        .card .icon {
            font-size: 22px;
            margin-bottom: 10px;
        }
        .logout-wrapper {
            margin-top: auto;
            padding: 20px;
        }
        .btn-logout {
            width: 100%;
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="d-flex">
    <!-- Sidebar -->
    <nav class="sidebar-custom d-flex flex-column position-fixed">
        <div class="brand-header">
            <img src="images/logo1.png" alt="Logo">
        </div>
        <a href="#"><i class="fas fa-home mr-2"></i> Dashboard</a>
        <a href="from_cuti.php"><i class="fas fa-calendar-plus mr-2"></i> Form Cuti</a>
        <a href="ticketing.html"><i class="fas fa-ticket-alt mr-2"></i> Form Tiket</a>
        <a href="status_pengajuan.php"><i class="fas fa-check mr-2"></i> Status Pengajuan</a>

        <!-- Logout -->
        <div class="logout-wrapper mt-auto">
            <small class="text-white mb-2 d-block text-center">
                <i class="fas fa-user-circle"></i> <?= htmlspecialchars($_SESSION['username']) ?>
            </small>
            <button onclick="confirmLogout()" class="btn btn-danger btn-sm btn-logout">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content flex-grow-1">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 text-gray-800">Selamat Datang, <?= htmlspecialchars($_SESSION['username']) ?>!</h1>
        </div>

        <div class="row">
            <!-- Card 1 -->
            <div class="col-md-3 mb-4">
                <div class="card border-left-primary shadow h-100 py-3 text-center">
                    <div class="card-body">
                        <div class="icon text-primary"><i class="fas fa-tasks"></i></div>
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Kegiatan Harian</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-md-3 mb-4">
                <div class="card border-left-success shadow h-100 py-3 text-center">
                    <div class="card-body">
                        <div class="icon text-success"><i class="fas fa-boxes"></i></div>
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Pengajuan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-md-3 mb-4">
                <div class="card border-left-warning shadow h-100 py-3 text-center">
                    <div class="card-body">
                        <div class="icon text-warning"><i class="fas fa-calendar-week"></i></div>
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Tiket Bulan Ini</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                    </div>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="col-md-3 mb-4">
                <div class="card border-left-danger shadow h-100 py-3 text-center">
                    <div class="card-body">
                        <div class="icon text-danger"><i class="fas fa-exclamation-circle"></i></div>
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Tiket Belum Selesai</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JS Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.1.4/js/sb-admin-2.min.js"></script>

<!-- Logout Confirmation -->
<script>
    function confirmLogout() {
        if (confirm("Yakin ingin logout?")) {
            window.location.href = "logout.php";
        }
    }
</script>
</body>
</html>
