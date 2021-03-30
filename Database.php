<?php
$conn = mysqli_connect("localhost", "root", "", "karyawan");

function query($query)
{
  global $conn;
  $result = mysqli_query($conn, $query);
  $rows = array();
  while ($row = mysqli_fetch_assoc($result)) {

    $jabatan = "SELECT * FROM m_jabatan WHERE m_jabatan.KD_JABATAN = " . $row["KD_JABATAN"];
    $res_jabatan = mysqli_query($conn, $jabatan);
    $sub_jabatan = array();
    while ($sub_row = mysqli_fetch_assoc($res_jabatan)) {
      $sub_jabatan[] = $sub_row;
    }

    $family = "SELECT * FROM m_keluarga WHERE m_keluarga.NO_BADGE = " . $row["NO_BADGE"];
    $res_family = mysqli_query($conn, $family);
    $sub_family = [];
    while ($sub_row = mysqli_fetch_assoc($res_family)) {
      $sub_family[] = $sub_row;
    }
    $row['DETAIL_JABATAN'] = $sub_jabatan;
    $row['FAMILY'] = $sub_family;
    $rows[] = $row;
  }
  return $rows;
}

function getByName($query)
{
  global $conn;
  $result = mysqli_query($conn, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}
