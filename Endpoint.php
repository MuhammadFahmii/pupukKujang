<?php
require 'Database.php';


header('Content-Type: application/json');
$data = query("SELECT * FROM m_karyawan");
echo json_encode(
  [
    "EMP" => $data
  ],
  JSON_PRETTY_PRINT
);
