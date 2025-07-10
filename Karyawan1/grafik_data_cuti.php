<?php
session_start();
include "koneksi.php";

// Ambil jumlah cuti berdasarkan bulan dan status
$query = "
    SELECT 
        DATE_FORMAT(tanggal_pengajuan, '%M %Y') AS bulan,
        status,
        COUNT(*) AS total
    FROM cuti
    GROUP BY YEAR(tanggal_pengajuan), MONTH(tanggal_pengajuan), status
    ORDER BY YEAR(tanggal_pengajuan), MONTH(tanggal_pengajuan)
";

$result = mysqli_query($link, $query);
$data = [];

// Format data
while ($row = mysqli_fetch_assoc($result)) {
    $bulan = $row['bulan'];
    $status = $row['status'];
    $total = (int)$row['total'];

    if (!isset($data[$bulan])) {
        $data[$bulan] = ['Disetujui' => 0, 'Ditolak' => 0, 'Menunggu Approval' => 0];
    }

    $data[$bulan][$status] = $total;
}

// Siapkan format JSON untuk Chart.js
$response = [
    'labels' => array_keys($data),
    'disetujui' => [],
    'ditolak' => [],
    'menunggu' => []
];

foreach ($data as $bulan => $statusData) {
    $response['disetujui'][] = $statusData['Disetujui'];
    $response['ditolak'][] = $statusData['Ditolak'];
    $response['menunggu'][] = $statusData['Menunggu Approval'];
}

header('Content-Type: application/json');
echo json_encode($response);
