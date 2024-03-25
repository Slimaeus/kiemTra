<?php
include('./layouts/header.php');
require_once('./models/department.class.php');

$department_list = Department::getAllDepartment();
?>

<h2 class="mb-4">DANH SÁCH PHÒNG BAN</h2>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Mã</th>
                <th scope="col">Tên</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($department_list as $department) : ?>
                <tr>
                    <td><?php echo $department['Ma_Phong']; ?></td>
                    <td><?php echo $department['Ten_Phong']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include('./layouts/footer.php'); ?>