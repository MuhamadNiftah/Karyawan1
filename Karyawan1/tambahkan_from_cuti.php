<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'user') {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Form Cuti - DIDIMAX</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap & Font Awesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-5">
  <form action="proses_cuti.php" method="POST" class="bg-white p-4 shadow rounded">

    <!-- Header -->
    <div class="text-center mb-4">
      <h5 class="font-weight-bold">PT. DIDI MAX BERJANGKA</h5>
      <small>MEMBER OF JAKARTA FUTURES EXCHANGE & INDONESIA DERIVATIVES CLEARING HOUSE</small>
      <hr>
      <h5 class="mt-3">FORMULIR PERMINTAAN DAN PEMBERIAN CUTI</h5>
    </div>

    <!-- DATA KARYAWAN -->
    <h6 class="font-weight-bold mt-4">DATA KARYAWAN</h6>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama" class="form-control" required>
      </div>
      <div class="form-group col-md-6">
        <label for="nik">NIK</label>
        <input type="text" name="nik" id="nik" class="form-control" required>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="jabatan">Divisi</label>
        <input type="text" name="divisi" id="divisi" class="form-control" required>
      </div>
      <div class="form-group col-md-6">
        <label for="unit_kerja">Jabatan</label>
        <input type="text" name="jabatan" id="jabatan" class="form-control" required>
      </div>
    </div>

    <!-- ALASAN CUTI -->
    <h6 class="font-weight-bold mt-4">ALASAN CUTI</h6>
    <div class="form-group">
      <textarea name="alasan" class="form-control" rows="3" placeholder="Tulis alasan cuti..." required></textarea>
    </div>

    <!-- LAMANYA CUTI -->
    <h6 class="font-weight-bold mt-4">LAMANYA CUTI</h6>
    <div class="form-row">
      <div class="form-group col-md-2">
        <label for="jumlah_hari">Selama (hari)</label>
        <input type="number" name="jumlah_hari" id="jumlah_hari" class="form-control" min="1" required>
      </div>
      <div class="form-group col-md-5">
        <label for="mulai">Mulai Tanggal</label>
        <input type="date" name="mulai" id="mulai" class="form-control" required>
      </div>
      <div class="form-group col-md-5">
        <label for="sampai">Sampai Tanggal</label>
        <input type="date" name="sampai" id="sampai" class="form-control" required>
      </div>
    </div>

    <!-- ALAMAT & TELEPON -->
    <h6 class="font-weight-bold mt-4">ALAMAT SELAMA MENJALANKAN CUTI</h6>
    <div class="form-group">
      <textarea name="alamat_cuti" rows="2" class="form-control" placeholder="Alamat lengkap selama cuti..." required></textarea>
    </div>

    <div class="form-group">
      <label for="telepon">No. Telepon</label>
      <input type="text" name="telepon" id="telepon" class="form-control" required>
    </div>

    <!-- TOMBOL KIRIM -->
    <div class="form-group text-right">
      <button type="submit" class="btn btn-success">
        <i class="fas fa-paper-plane mr-1"></i> Kirim Pengajuan
      </button>
    </div>

  </form>
</div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
