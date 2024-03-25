<?php
session_start();
require_once('./models/user.class.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = User::getUserByUsername($username);

    if ($user !== false && $user->num_rows > 0) {
        $userData = $user->fetch_assoc();
        if ($password == $userData['Mat_Khau']) {
            $_SESSION['user_id'] = $userData['Ma_ND'];
            $_SESSION['username'] = $userData['Ten_ND'];
            $_SESSION['role'] = $userData['Vai_Tro'];
            $_SESSION['fullname'] = $userData['Ten_Hien_Thi'];

            if ($userData['Vai_Tro'] == 'admin' || $userData['Vai_Tro'] == 'user') {
                header("Location: index.php");
            } else {
                $error = "Vai trò của không hợp lệ.";
            }
        } else {
            $error = "Thông tin đăng nhập không chính xác.";
        }
    } else {
        $error = "Thông tin đăng nhập không chính xác.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link href="./css/bootstrap.min.css" rel="stylesheet">
</head>


<?php if (isset($error)) : ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>

<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        <h3>Đăng nhập</h3>
                    </div>
                    <div class="card-body">
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div class="mb-3">
                                <label for="username" class="form-label">Tên đăng nhập</label>
                                <input type="text" id="username" name="username" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Mật khẩu</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>