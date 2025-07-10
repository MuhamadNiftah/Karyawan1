<?php
session_start();
include "koneksi.php";

if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);

    // Cek apakah username sudah digunakan di tabel users
    $query = mysqli_prepare($link, "SELECT id FROM users WHERE username = ?");
    mysqli_stmt_bind_param($query, "s", $username);
    mysqli_stmt_execute($query);
    mysqli_stmt_store_result($query);

    if (mysqli_stmt_num_rows($query) > 0) {
        $_SESSION['msg'] = "Username sudah dipakai, gunakan yang lain.";
    } else {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = mysqli_prepare($link, "INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sss", $username, $passwordHash, $role);
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['msg'] = "Registrasi berhasil, silakan login.";
            header('Location: login.php');
            exit();
        } else {
            $_SESSION['msg'] = "Registrasi gagal, coba lagi.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('https://images.unsplash.com/photo-1550751827-4bd374c3f58b');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .register-card {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 460px;
        }
    </style>
</head>
<body>
<div class="register-card">
    <h3 class="text-center mb-4 font-weight-bold">Registrasi Pengguna</h3>
    <?php
    if (isset($_SESSION['msg'])) {
        echo "<div class='alert alert-info'>" . htmlspecialchars($_SESSION['msg']) . "</div>";
        unset($_SESSION['msg']);
    }
    ?>
    <form method="post">
        <div class="form-group">
            <label>Username:</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Password:</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Role:</label>
            <select name="role" class="form-control" required>
                <option value="admin">Admin</option>
                <option value="user">User</option>
                <option value="manager">Manager</option>
                <option value="it support">IT Support</option>
            </select>
        </div>
        <button type="submit" name="register" class="btn btn-primary btn-block">Daftar</button>
    </form>
    <div class="text-center mt-3">
        <a href="login.php">Sudah punya akun? Login</a>
    </div>
</div>
</body>
</html>
