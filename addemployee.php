<?php
include('./layouts/header.php');
require_once('./models/employee.class.php');
require_once('./models/department.class.php');
if (isset($_SESSION['username'])) {
    $role = $_SESSION['role'];
} else {
    $role = '';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['gender']) && isset($_POST['birthPlace']) && isset($_POST['departmentId']) && isset($_POST['salary'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $birthPlace = $_POST['birthPlace'];
        $departmentId = $_POST['departmentId'];
        $salary = $_POST['salary'];

        $employee = new Employee();

        $result = $employee->addEmployee($id, $name, $gender, $birthPlace, $departmentId, $salary);

        if ($result) {
            echo '<h2>Thêm thành công!</h2>';
        } else {
            echo '<h2>Thêm thất bại!</h2>';
        }
        echo '<a href="employee.php" class="btn btn-primary">Quay lại trang danh sách</a>';
        exit();
    } else {
        echo '<div class="alert alert-danger" role="alert">Vui lòng nhập đầy đủ thông tin!</div>';
    }
}
?>

<h2>THÊM NHÂN VIÊN</h2>

<?php if ($role != 'admin') : ?>
    <h3>Bạn không có quyền thực hiện chức năng này!</h3>
<?php endif; ?>

<?php if ($role == 'admin') : ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateForm();">
        <div class="form-group">
            <label for="id">Mã nhân viên:</label>
            <input type="text" class="form-control" id="id" name="id">
        </div>
        <div class="form-group">
            <label for="name">Tên nhân viên:</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="form-group">
            <label for="gender">Giới tính:</label>
            <select class="form-control" id="gender" name="gender">
                <option value="NAM">Nam</option>
                <option value="NU">Nữ</option>
            </select>
        </div>
        <div class="form-group">
            <label for="birthPlace">Nơi sinh:</label>
            <input type="text" class="form-control" id="birthPlace" name="birthPlace">
        </div>
        <div class="form-group">
            <label for="departmentId">Phòng:</label>
            <select class="form-control" id="departmentId" name="departmentId">
                <?php
                $department = new Department();
                $department_list = $department->getAllDepartment();
                foreach ($department_list as $department) {
                    echo '<option value="' . $department['Ma_Phong'] . '">' . $department['Ten_Phong'] . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="salary">Lương:</label>
            <input type="text" class="form-control" id="salary" name="salary">
        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
    </form>
<?php endif; ?>

<script>
    function validateForm() {
        var id = document.getElementById('id').value;
        var name = document.getElementById('name').value;
        var birthPlace = document.getElementById('birthPlace').value;
        var salary = document.getElementById('salary').value;

        if (id == '' || name == '' || birthPlace == '' || salary == '') {
            alert('Vui lòng nhập đầy đủ thông tin!');
            return false;
        }

        return true;
    }
</script>

<?php
include('./layouts/footer.php');
?>