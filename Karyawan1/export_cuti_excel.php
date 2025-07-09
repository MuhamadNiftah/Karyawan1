<?php
include 'koneksi.php';

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=report_pengajuan_cuti.xls");

$query = "SELECT * FROM pengajuan_cuti WHERE status IN ('Disetujui', 'Ditolak') ORDER BY created_at DESC";
$result = mysqli_query($link, $query);

echo "<table border='1'>";
echo "<tr>
        <th>Nama</th>
        <th>NIK</th>
        <th>Divisi</th>
        <th>Jabatan</th>
        <th>Alasan</th>
        <th>Periode</th>
        <th>Status</th>
        <th>Telepon</th>
      </tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>".htmlspecialchars($row['nama'])."</td>";
    echo "<td>".htmlspecialchars($row['nik'])."</td>";
    echo "<td>".htmlspecialchars($row['divisi'])."</td>";
    echo "<td>".htmlspecialchars($row['jabatan'])."</td>";
    echo "<td>".nl2br(htmlspecialchars($row['alasan']))."</td>";
    echo "<td>".date("d/m/Y", strtotime($row['mulai'])) . " s/d " . date("d/m/Y", strtotime($row['sampai'])) . "</td>";
    echo "<td>".$row['status']."</td>";
    echo "<td>".htmlspecialchars($row['telepon'])."</td>";
    echo "</tr>";
}
echo "</table>";
?>
