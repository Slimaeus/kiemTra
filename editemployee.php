<?php
include('./layouts/header.php');
require_once('./models/employee.class.php');
require_once('./models/department.class.php');
if (isset($_SESSION['username'])) {
    $role = $_SESSION['role'];
} else {
    $role = '';
}

$employee_info = array();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $employee_info = Employee::getEmployeeByMaNV($id);

    if (!$employee_info) {
        echo '<div class="alert alert-danger" role="alert">Không tìm thấy thông tin nhân viên!</div>';
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id'], $_POST['name'], $_POST['gender'], $_POST['birthPlace'], $_POST['departmentId'], $_POST['salary'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $birthPlace = $_POST['birthPlace'];
        $departmentId = $_POST['departmentId'];
        $salary = $_POST['salary'];

        $emloyee = new Employee();

        $result = $emloyee->updateEmployee($id, $name, $gender, $birthPlace, $departmentId, $salary);

        if ($result) {
            echo '<h2>Cập nhật thành công!</h2>';
        } else {
            echo '<h2>Cập nhật thất bại!</h2>';
        }
        echo '<a href="employee.php" class="btn btn-primary">Quay lại trang danh sách</a>';
        exit();
    } else {
        echo '<div class="alert alert-danger" role="alert">Vui lòng nhập đầy đủ thông tin!</div>';
    }
}
?>

<h2>CHỈNH SỬA NHÂN VIÊN</h2>

<?php if ($role != 'admin') : ?>
    <h3>Bạn không có quyền thực hiện chức năng này!</h3>
<?php endif; ?>

<?php if ($role == 'admin') : ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateForm();">
        <input type="hidden" name="id" value="<?php echo $employee_info['Ma_NV']; ?>">
        <div class="form-group">
            <label for="name">Tên nhân viên:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $employee_info['Ten_NV']; ?>">
        </div>
        <div class="form-group">
            <label for="gender">Giới tính:</label>
            <select class="form-control" id="gender" name="gender">
                <option value="NU" <?php if ($employee_info['Phai'] == 'NU') echo 'selected'; ?>>Nữ</option>
                <option value="NAM" <?php if ($employee_info['Phai'] == 'NAM') echo 'selected'; ?>>Nam</option>
            </select>
        </div>
        <div class="form-group">
            <label for="birthPlace">Nơi sinh:</label>
            <input type="text" class="form-control" id="birthPlace" name="birthPlace" value="<?php echo $employee_info['Noi_Sinh']; ?>">
        </div>
        <div class="form-group">
            <label for="departmentId">Tên Phòng:</label>
            <select class="form-control" id="departmentId" name="departmentId">
                <?php
                $department = new Department();
                $department_list = $department->getAllDepartment();
                foreach ($department_list as $department) {
                    echo '<option value="' . $department['Ma_Phong'] . '"';
                    if ($employee_info['Ma_Phong'] == $department['Ma_Phong']) {
                        echo ' selected';
                    }
                    echo '>' . $department['Ten_Phong'] . '</option>';
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="salary">Lương:</label>
            <input type="text" class="form-control" id="salary" name="salary" value="<?php echo $employee_info['Luong']; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
<?php endif; ?>

<script>
    function validateForm() {
        var name = document.getElementById('name').value;
        var birthPlace = document.getElementById('birthPlace').value;
        var salary = document.getElementById('salary').value;

        if (name == '' || birthPlace == '' || salary == '') {
            alert('Vui lòng nhập đầy đủ thông tin!');
            return false;
        }
        return true;
    }
</script>

<?php include('./layouts/footer.php'); ?>