<?php
session_start();
if (!isset($_SESSION['username']) || strtolower($_SESSION['role']) != 'user') {
    header('Location: login.php');
    exit();
}
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama    = $_POST['nama'];
    $nik     = $_POST['nik'];
    $divisi  = $_POST['divisi'];
    $jabatan = $_POST['jabatan'];
    $telp    = $_POST['telp'];
    $username = $_SESSION['username']; // langsung dari session

    $insert = mysqli_query($link, "INSERT INTO karyawan (nama, nik, divisi, jabatan, telp, username) 
        VALUES ('$nama', '$nik', '$divisi', '$jabatan', '$telp', '$username')");

    if ($insert) {
        header("Location: biodata_user.php");
        exit();
    } else {
        echo "<script>alert('Gagal menambahkan data.');</script>";
    }
}

$dataKaryawan = [];
$result = mysqli_query($link, "SELECT * FROM karyawan");
while ($row = mysqli_fetch_assoc($result)) {
    $dataKaryawan[] = $row;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Data Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-light">
<div class="container mt-4">
    <h3 class="mb-4">Form Tambah Data Karyawan</h3>
    <form method="POST">
        <div class="form-group">
            <label>Nama (Pilih jika sudah ada)</label>
            <select id="namaSelect" class="form-control mb-2">
                <option value="">-- Pilih Nama --</option>
                <?php foreach ($dataKaryawan as $karyawan): ?>
                    <option value="<?= htmlspecialchars($karyawan['nama']) ?>">
                        <?= htmlspecialchars($karyawan['nama']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <input type="text" name="nama" id="namaInput" class="form-control" placeholder="Atau isi manual nama..." required>
        </div>

        <div class="form-group">
            <label>NIK</label>
            <input type="text" name="nik" id="nikInput" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Divisi</label>
            <input type="text" name="divisi" id="divisiInput" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Jabatan</label>
            <input type="text" name="jabatan" id="jabatanInput" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Telepon</label>
            <input type="text" name="telp" id="telpInput" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="dashboard_user.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<script>
// Data Karyawan dari PHP ke JavaScript
const dataKaryawan = <?php echo json_encode($dataKaryawan); ?>;

// Saat nama dipilih dari dropdown, isi otomatis field lainnya
$('#namaSelect').on('change', function () {
    const selectedNama = $(this).val();
    $('#namaInput').val(selectedNama);

    const selectedData = dataKaryawan.find(item => item.nama === selectedNama);
    if (selectedData) {
        $('#nikInput').val(selectedData.nik);
        $('#divisiInput').val(selectedData.divisi);
        $('#jabatanInput').val(selectedData.jabatan);
        $('#telpInput').val(selectedData.telp);
    } else {
        $('#nikInput').val('');
        $('#divisiInput').val('');
        $('#jabatanInput').val('');
        $('#telpInput').val('');
    }
});
</script>
</body>
</html>
