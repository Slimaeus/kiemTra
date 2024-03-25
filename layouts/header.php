<!DOCTYPE html>
<html lang="vi">
<?php
session_start();
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QUẢN LÝ NHÂN SỰ</title>
  <link href="./css/bootstrap.min.css" rel="stylesheet">
  <link href="./css/all.min.css" rel="stylesheet">
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-primary bg-primary">
    <div class="container">
      <a class="navbar-brand" href="index.php">Quản lý Nhân sự</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Trang chủ</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="employee.php">Nhân viên</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="department.php">Phòng ban</a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <span class="navbar-text me-3">Vai trò: <?php echo isset($_SESSION['role']) ? $_SESSION['role'] : 'Khách'; ?></span>
        </ul>

        <ul class="navbar-nav ml-auto">
          <?php if (isset($_SESSION['username'])) : ?>
            <span class="navbar-text me-3">Chào <?php echo $_SESSION['fullname']; ?></span>
            <li class="nav-item">
              <a class="btn text-white bg-danger" href="logout.php">Đăng Xuất</a>
            </li>
          <?php else : ?>
            <li class="nav-item">
              <a class="btn text-dark bg-white" href="login.php">Đăng Nhập</a>
            </li>
          <?php endif; ?>
        </ul>

      </div>
    </div>
  </nav>
  <div class="container">