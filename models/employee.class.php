<?php
require_once("./config/db.class.php");

class Employee
{
  protected $db;

  public function __construct()
  {
    $this->db = new Db();
  }

  public static function getAllEmployeePaging($currentPage, $limit)
  {
    $db = new Db();
    $offset = ($currentPage - 1) * $limit;
    $queryString = "SELECT nhanvien.Ma_NV, nhanvien.Ten_NV, nhanvien.Phai, nhanvien.Noi_Sinh, nhanvien.Luong, phong.Ten_Phong 
                    FROM nhanvien 
                    INNER JOIN phong ON nhanvien.Ma_Phong = phong.Ma_Phong 
                    LIMIT $offset, $limit";

    $countQueryString = "SELECT COUNT(*) 
                        FROM nhanvien 
                        INNER JOIN phong ON nhanvien.Ma_Phong = phong.Ma_Phong";

    $totalRecords = $db->query_count($countQueryString);
    $totalPages = ceil($totalRecords / $limit);

    $result = array(
      'items' => $db->select_to_array($queryString),
      'totalPages' => $totalPages
    );
    return $result;
  }


  public static function getEmployeeByMaNV($maNV)
  {
    $db = new Db;
    $maNV = $db->connect()->real_escape_string($maNV);
    $queryString = "SELECT * FROM nhanvien WHERE Ma_NV = '$maNV'";
    return $db->select_to_array($queryString)[0];
  }

  public function addEmployee($maNV, $tenNV, $phai, $noiSinh, $maPhong, $luong)
  {
    $maNV = $this->db->connect()->real_escape_string($maNV);
    $tenNV = $this->db->connect()->real_escape_string($tenNV);
    $phai = $this->db->connect()->real_escape_string($phai);
    $noiSinh = $this->db->connect()->real_escape_string($noiSinh);
    $maPhong = $this->db->connect()->real_escape_string($maPhong);
    $luong = (int)$luong;

    $queryString = "INSERT INTO nhanvien (Ma_NV, Ten_NV, Phai, Noi_Sinh, Ma_Phong, Luong) VALUES ('$maNV', '$tenNV', '$phai', '$noiSinh', '$maPhong', $luong)";
    return $this->db->query_execute($queryString);
  }

  public function updateEmployee($maNV, $tenNV, $phai, $noiSinh, $maPhong, $luong)
  {
    $maNV = $this->db->connect()->real_escape_string($maNV);
    $tenNV = $this->db->connect()->real_escape_string($tenNV);
    $phai = $this->db->connect()->real_escape_string($phai);
    $noiSinh = $this->db->connect()->real_escape_string($noiSinh);
    $maPhong = $this->db->connect()->real_escape_string($maPhong);
    $luong = (int)$luong;

    $queryString = "UPDATE nhanvien SET Ten_NV = '$tenNV', Phai = '$phai', Noi_Sinh = '$noiSinh', Ma_Phong = '$maPhong', Luong = $luong WHERE Ma_NV = '$maNV'";
    return $this->db->query_execute($queryString);
  }

  public function deleteEmployee($maNV)
  {
    $maNV = $this->db->connect()->real_escape_string($maNV);

    $queryString = "DELETE FROM nhanvien WHERE Ma_NV = '$maNV'";
    return $this->db->query_execute($queryString);
  }
}
