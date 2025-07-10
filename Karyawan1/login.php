<?php
session_start();
include "koneksi.php";

// --- BUAT ADMIN DEFAULT (JALAN SEKALI) ---
$checkAdmin = mysqli_query($link, "SELECT * FROM users WHERE username = 'admin'");
if (mysqli_num_rows($checkAdmin) === 0) {
    $adminUser = 'admin';
    $adminPass = password_hash('admin123', PASSWORD_DEFAULT);
    $adminRole = 'admin';

    $insertAdmin = mysqli_prepare($link, "INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($insertAdmin, "sss", $adminUser, $adminPass, $adminRole);
    mysqli_stmt_execute($insertAdmin);
}

// --- PROSES LOGIN ---
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = mysqli_prepare($link, "SELECT * FROM users WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($user = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Cek apakah user memiliki data di tabel karyawan
            $cekKaryawan = mysqli_query($link, "SELECT * FROM karyawan WHERE no_id = '{$user['username']}'");
            if ($dataKaryawan = mysqli_fetch_assoc($cekKaryawan)) {
                $_SESSION['no_id'] = $dataKaryawan['no_id'];
            }

            // Redirect sesuai role
            $role = strtolower(trim($user['role']));
            switch ($role) {
                case 'admin':
                    header('Location: dashboard_admin.php'); break;
                case 'manager':
                    header('Location: dashboard_manager.php'); break;
                case 'it support':
                case 'it_support':
                    header('Location: dashboard_itsupport.php'); break;
                case 'user':
                default:
                    header('Location: dashboard_user.php'); break;
            }
            exit();
        } else {
            $_SESSION['msg'] = "Password salah!";
        }
    } else {
        $_SESSION['msg'] = "Username tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - DIDIMAX BERJANGKA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: url('images/didimax.jpg') no-repeat center center/cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }
        .login-wrapper {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
            max-width: 420px;
            width: 100%;
            color: #fff;
        }
        .brand-header {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
        }
        .brand-header img {
            height: 50px;
            margin-right: 10px;
        }
        .brand-header h4 {
            font-size: 1.5rem;
            font-weight: bold;
            color: #ffffff;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.4);
        }
        .form-control {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: #fff;
        }
        .form-control::placeholder {
            color: #f0f0f0;
        }
        .form-control:focus {
            background: rgba(255, 255, 255, 0.3);
            box-shadow: none;
            color: #fff;
        }
        .btn-primary {
            background-color: #2e59d9;
            border: none;
        }
        .btn-primary:hover {
            background-color: #224abe;
        }
        a {
            color: #ddd;
        }
        a:hover {
            color: #fff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="login-wrapper text-center">
        <div class="brand-header">
            <img src="images/dmb.png" alt="Logo">
            <h4>DIDIMAX BERJANGKA</h4>
        </div>

        <?php if (isset($_SESSION['msg'])): ?>
            <div class="alert alert-danger text-left">
                <?= htmlspecialchars($_SESSION['msg']); unset($_SESSION['msg']); ?>
            </div>
        <?php endif; ?>

        <form method="post">
            <div class="form-group text-left">
                <label for="username"><i class="fas fa-user"></i> Username:</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan username" required>
            </div>
            <div class="form-group text-left">
                <label for="password"><i class="fas fa-lock"></i> Password:</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan password" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
        </form>

        <div class="mt-3">
            <a href="lupa_password.php"><i class="fas fa-question-circle"></i> Lupa Password?</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
