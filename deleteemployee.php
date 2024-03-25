<?php
include('./layouts/header.php');
require_once('./models/employee.class.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $employee = new Employee();

    $result = $employee->deleteEmployee($id);

    if ($result) {
        echo '<h2>Xoá thành công!</h2>';
    } else {
        echo '<h2>Xoá nhân viên thất bại!</h2>';
    }
    echo '<a href="employee.php" class="btn btn-primary">Quay lại trang danh sách</a>';
}

Db::close_connection();

include('./layouts/footer.php');