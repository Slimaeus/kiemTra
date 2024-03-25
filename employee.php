<?php
include('./layouts/header.php');
require_once('./models/employee.class.php');

if (isset($_SESSION['username'])) {
    $role = $_SESSION['role'];
} else {
    $role = '';
}

$recordsPerPage = 5;
$currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;

$employeePagination = Employee::getAllEmployeePaging($currentPage, $recordsPerPage);
$employees = $employeePagination['items'];
$totalPages = $employeePagination['totalPages'];

?>

<div class="container mt-4">
    <h2>DANH SÁCH NHÂN VIÊN</h2>

    <?php if ($role == 'admin') : ?>
        <div class="text-right mb-3">
            <a href="addemployee.php" class="btn btn-primary">Thêm Nhân Viên</a>
        </div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Mã</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Giới tính</th>
                    <th scope="col">Nơi sinh</th>
                    <th scope="col">Phòng</th>
                    <th scope="col">Lương</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employees as $employee) : ?>
                    <tr>
                        <td><?php echo $employee['Ma_NV']; ?></td>
                        <td><?php echo $employee['Ten_NV']; ?></td>
                        <td>
                            <?php if ($employee['Phai'] == 'NU') : ?>
                              <img src="./images/woman.png" alt="woman" width="30">
                            <?php else : ?>
                              <img src="./images/man.png" alt="man" width="30">
                            <?php endif; ?>
                        </td>
                        <td><?php echo $employee['Noi_Sinh']; ?></td>
                        <td><?php echo $employee['Ten_Phong']; ?></td>
                        <td><?php echo number_format($employee['Luong']); ?></td>
                        <?php if ($role == 'admin') : ?>
                            <td>
                                <a href="editemployee.php?id=<?php echo $employee['Ma_NV']; ?>" class="btn btn-info">Chỉnh sửa</a>
                                <a href="deleteemployee.php?id=<?php echo $employee['Ma_NV']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xoá nhân viên này không?')" class="btn btn-danger">Xóa</i></a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <nav>
        <ul class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                <li class="page-item <?php if ($i == $currentPage) echo 'active'; ?>"><a class="page-link" href="employee.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>

<?php
Db::close_connection();
include('./layouts/footer.php');
?>