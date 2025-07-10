<?php
include "koneksi.php";
$result = mysqli_query($link, "SELECT * FROM karyawan ORDER BY no_id ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pengajuan Cuti Tahunan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container mt-5">
    <h3 class="mb-4">FORM PENGAJUAN CUTI TAHUNAN</h3>
    <form action="simpan_cuti_melahirkan.php" method="POST">
        <!-- Pilih Pegawai -->
        <div class="form-group">
            <label>Pilih No ID</label>
            <select name="kode_id" id="kode_id" class="form-control" required>
                <option value="">-- Pilih No ID --</option>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <option value="<?= $row['id'] ?>"><?= $row['no_id'] ?> - <?= $row['nama'] ?></option>
                <?php } ?>
            </select>
        </div>

        <!-- Otomatis terisi -->
        <div class="form-group">
            <label>Nama Pegawai</label>
            <input type="text" name="nama_pegawai" id="nama_pegawai" class="form-control" readonly>
        </div>
        <div class="form-group">
            <label>NIK</label>
            <input type="text" name="nik" id="nik" class="form-control" readonly>
        </div>
        <div class="form-group">
            <label>Divisi</label>
            <input type="text" name="divisi" id="divisi" class="form-control" readonly>
        </div>
        <div class="form-group">
            <label>Jabatan</label>
            <input type="text" name="jabatan" id="jabatan" class="form-control" readonly>
        </div>
        <div class="form-group">
            <label>Telepon</label>
            <input type="text" name="telepon" id="telepon" class="form-control" readonly>
        </div>

        <!-- Inputan Manual -->
        <div class="form-group">
            <label>Alasan Pengajuan Cuti</label>
            <input type="text" name="alasan" class="form-control" value="Cuti Tahunan" readonly>
        </div>
        <div class="form-group">
            <label>Tanggal Pengajuan Cuti</label>
            <input type="date" name="tanggal_pengajuan" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Durasi Cuti (hari)</label>
            <input type="number" name="durasi" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Tanggal Mulai Cuti</label>
            <input type="date" name="mulai_cuti" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Tanggal Berakhir Cuti</label>
            <input type="date" name="berakhir_cuti" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Alamat Selama Cuti</label>
            <textarea name="alamat_cuti" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Ajukan Cuti</button>
    </form>
</div>

<!-- Script AJAX -->
<script>
$(document).ready(function(){
    $('#kode_id').change(function(){
        var id = $(this).val();
        if(id){
            $.ajax({
                type: 'POST',
                url: 'get_karyawan.php',
                data: {id: id},
                dataType: 'json',
                success: function(data){
                    $('#nama_pegawai').val(data.nama);
                    $('#nik').val(data.nik);
                    $('#divisi').val(data.divisi);
                    $('#jabatan').val(data.jabatan);
                    $('#telepon').val(data.telp);
                }
            });
        } else {
            $('#nama_pegawai, #nik, #divisi, #jabatan, #telepon').val('');
        }
    });
});
</script>
</body>
</html>
