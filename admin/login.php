<?php
// Smart path resolution to work whether accessed directly or included from root index.php
$base_path = file_exists('assets/css/bootstrap.css') ? 'assets/' : (file_exists('admin/assets/css/bootstrap.css') ? 'admin/assets/' : './assets/');
$admin_path = file_exists('index.php') && !file_exists('admin') ? './' : (file_exists('admin/index.php') ? 'admin/' : './');

session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Student Management System</title>
    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="<?php echo $base_path; ?>css/bootstrap.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Custom Modern Styling -->
    <link rel="stylesheet" href="<?php echo $base_path; ?>css/style.css">
</head>

<body class="login-body">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-9">
                <div class="login-card row g-0">
                    <!-- Left Banner / Branding -->
                    <div class="col-lg-5 login-brand-banner d-none d-lg-flex">
                        <div>
                            <div class="d-flex align-items-center gap-2 mb-4">
                                <div class="brand-icon-box">
                                    <i class="bi bi-mortarboard-fill"></i>
                                </div>
                                <span class="fs-4 fw-bold text-white tracking-wide">EduPulse</span>
                            </div>
                            <h2 class="fw-bold mb-3">Student & Academy Management</h2>
                            <p class="text-white-50 small mb-0">
                                Seamlessly manage student enrollments, academic records, attendance, and faculty operations with ease.
                            </p>
                        </div>

                        <div class="pt-4 border-top border-white-50">
                            <div class="d-flex align-items-center gap-3">
                                <div class="d-flex -space-x-2">
                                    <span class="badge rounded-pill bg-white text-dark py-2 px-3 fw-semibold">
                                        <i class="bi bi-shield-check text-success me-1"></i> SSL Protected Portal
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Form Container -->
                    <div class="col-12 col-lg-7 p-4 p-md-5">
                        <div class="d-flex align-items-center gap-2 mb-3 d-lg-none">
                            <div class="brand-icon-box">
                                <i class="bi bi-mortarboard-fill"></i>
                            </div>
                            <span class="fs-4 fw-bold text-dark">EduPulse</span>
                        </div>

                        <div class="mb-4">
                            <h3 class="fw-bold text-dark mb-1">Welcome Back!</h3>
                            <p class="text-muted small">Please enter your credentials to access the admin portal.</p>
                        </div>
                        <!-- Login Form (UI Only, submits to dashboard) -->
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label fw-semibold text-dark small">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted">
                                        <i class="bi bi-person"></i>
                                    </span>
                                    <input type="text" class="form-control bg-light border-start-0 ps-0" name="email" >
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label for="password" class="form-label fw-semibold text-dark small">Password</label>
                                    <a href="#" class="text-decoration-none small text-primary fw-medium">Forgot password?</a>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted">
                                        <i class="bi bi-lock"></i>
                                    </span>
                                    <input type="password" class="form-control bg-light border-start-0 border-end-0 ps-0" name="password" placeholder="••••••••">
                                    <button class="btn btn-light border border-start-0 text-muted" type="button" id="togglePasswordBtn">
                                        <i class="bi bi-eye" id="togglePasswordIcon"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="rememberMe" checked>
                                    <label class="form-check-label text-muted small" for="rememberMe">
                                        Keep me signed in
                                    </label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary-custom w-100 py-2 d-flex align-items-center justify-content-center gap-2">
                                <span>Sign In to Dashboard</span>
                                <i class="bi bi-arrow-right"></i>
                            </button>
                        </form>

                        <div class="mt-4 pt-3 text-center border-top">
                            <p class="text-muted small mb-0">
                                Don't have an account? <a href="<?php echo $admin_path; ?>register.php" class="text-primary fw-semibold text-decoration-none">Create an Account</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="<?php echo $base_path; ?>js/bootstrap.js"></script>
</body>

</html>
<?php

include("./db.php");
include("./admin/db.php");

if (isset($_SESSION['email'])) {
    echo '
            <script>    
                window.location.href="./index.php";
            </script>';
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) && empty($password)) {
        echo '
        <script>
            alert("please enter data in from");
        </script>';
    } else {

        $sql = "SELECT `user_id`, `username`, `email`, `password`, `full_name`, `statuss`, `create_at` 
        FROM `tb_user` 
        WHERE `email` = '$email'  AND `password`= '$password'";
        $res =  $con->query($sql);
   

        $row = mysqli_fetch_assoc($res);
        // Use session
        $_SESSION['email'] = $row['email'];
        $_SESSION['id'] = $row['user_id'];

        if ($res->num_rows > 0) {
            echo '
            <script>
            alert("login success....");
            window.location.href="./index.php;
            </script>';
        }
    }
}

?>