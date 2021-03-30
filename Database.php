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
  // private $pdo = null;
  // private $stmt = null;
  // private $host = 'localhost';
  // private $db_name = 'karyawan';
  // private $user = 'root';
  // private $pass = '';

  // public function __construct()
  // {
  //   try {
  //     $this->pdo = new PDO(
  //       "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
  //       $this->user,
  //       $this->pass,
  //       [
  //         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  //         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  //         PDO::ATTR_EMULATE_PREPARES => false
  //       ]
  //     );
  //   } catch (Exception $ex) {
  //     die($ex->getMessage());
  //   }
  // }

  // function query($sql, $cond = [])
  // {
  //   try {
  //     $this->stmt = $this->pdo->prepare($sql);
  //     $this->stmt->execute($cond);
  //   } catch (Exception $ex) {
  //     $this->error = $ex->getMessage();
  //     return false;
  //   }
  //   $this->stmt = null;
  //   return true;
  // }

  // function getAll()
  // {
  //   $this->stmt = $this->pdo->prepare("SELECT * FROM `m_karyawan`");
  //   $this->stmt->execute();
  //   $users = array();
  //   while ($row = $this->stmt->fetchALL()) {
  //     $subSQL = "SELECT * FROM `m_jabatan` WHERE `KD_JABATAN` = " . $row['KD_JABATAN'];
  //   };
  //   return count($users) == 0 ? false : $users;
  // }
