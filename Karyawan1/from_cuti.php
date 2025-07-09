<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Form Cuti - DIDIMAX</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap & SB Admin 2 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.1.4/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

  <style>
    .card-mini {
      height: 120px;
      font-size: 0.85rem;
    }
    .card-body-centered {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 100%;
      padding: 0.75rem;
    }
    .card .h5 {
      font-size: 1.2rem;
    }
  </style>
</head>

<body id="page-top">
<div class="container-fluid mt-4">

  <!-- Cards -->
  <div class="row justify-content-center">

    <!-- Card: Cuti Menikah -->
    <div class="col-sm-6 col-md-3 mb-3">
      <div class="card border-left-primary shadow card-mini position-relative">
        <a href="cuti_menikah.php" class="stretched-link text-decoration-none text-dark">
          <div class="card-body card-body-centered text-center">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Cuti Menikah</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
          </div>
        </a>
      </div>
    </div>

    <!-- ✅ Card: Cuti Melahirkan (UPDATED) -->
    <div class="col-sm-6 col-md-3 mb-3">
      <div class="card border-left-success shadow card-mini position-relative">
        <a href="cuti_melahirkan.php" class="stretched-link text-decoration-none text-dark">
          <div class="card-body card-body-centered text-center">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Cuti Melahirkan</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
          </div>
        </a>
      </div>
    </div>

    <!-- Card: Cuti Tahunan -->
    <div class="col-sm-6 col-md-3 mb-3">
      <div class="card border-left-warning shadow card-mini position-relative">
        <a href="cuti_tahunan.php" class="stretched-link text-decoration-none text-dark">
          <div class="card-body card-body-centered text-center">
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Cuti Tahunan</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
          </div>
        </a>
      </div>
    </div>

    <!-- Card: Cuti Alasan Penting -->
    <div class="col-sm-6 col-md-3 mb-3">
      <div class="card border-left-danger shadow card-mini position-relative">
        <a href="cuti_alasan_penting.php" class="stretched-link text-decoration-none text-dark">
          <div class="card-body card-body-centered text-center">
            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Cuti Alasan Penting</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
          </div>
        </a>
      </div>
    </div>

  </div> <!-- End row -->

</div> <!-- End container -->

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.1.4/js/sb-admin-2.min.js"></script>

</body>
</html>
