<?php
require 'Database.php';
header('Content-Type: application/json');
if (isset($_GET['kondisi'])) {
  $kondisi = $_GET['kondisi'];
  $data = getByName("SELECT m_karyawan.NAMA, m_karyawan.NO_BADGE, UNIT_KERJA FROM m_karyawan JOIN m_keluarga ON m_karyawan.NO_BADGE = m_keluarga.NO_BADGE WHERE m_karyawan.NAMA LIKE '%$kondisi%' OR m_karyawan.NO_BADGE LIKE '%$kondisi%' OR m_keluarga.NAMA LIKE '%$kondisi%' group by m_karyawan.NO_BADGE");
  echo json_encode([
    "Data" => $data
  ], JSON_PRETTY_PRINT);
} else {
  $data = query("SELECT * FROM m_karyawan");
  echo json_encode(
    [
      "EMP" => $data
    ],
    JSON_PRETTY_PRINT
  );
}
