<?php
session_start();
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $newPassword = trim($_POST['new_password']);

    // Cek apakah username ada
    $checkUser = mysqli_prepare($link, "SELECT * FROM users WHERE username = ?");
    mysqli_stmt_bind_param($checkUser, "s", $username);
    mysqli_stmt_execute($checkUser);
    $result = mysqli_stmt_get_result($checkUser);

    if ($user = mysqli_fetch_assoc($result)) {
        // Update password baru
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $updateStmt = mysqli_prepare($link, "UPDATE users SET password = ? WHERE username = ?");
        mysqli_stmt_bind_param($updateStmt, "ss", $hashedPassword, $username);
        mysqli_stmt_execute($updateStmt);

        $_SESSION['msg'] = "Password berhasil direset. Silakan login.";
        header("Location: login.php");
        exit();
    } else {
        $error = "Username tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lupa Password - DIDIMAX</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: url('images/didimax.jpg') no-repeat center center/cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', sans-serif;
        }
        .reset-card {
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(12px);
            border-radius: 20px;
            padding: 2.5rem;
            max-width: 420px;
            width: 100%;
            color: #fff;
            box-shadow: 0 8px 32px rgba(0,0,0,0.3);
        }
        .reset-card h4 {
            font-weight: bold;
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .form-group label {
            color: #fff;
        }
        .form-control {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: #fff;
        }
        .form-control::placeholder {
            color: #f0f0f0;
        }
        .form-control:focus {
            background: rgba(255, 255, 255, 0.2);
            box-shadow: none;
            color: #fff;
        }
        .btn-warning {
            background-color: #ffc107;
            border: none;
        }
        .btn-warning:hover {
            background-color: #e0a800;
        }
        a {
            color: #ddd;
        }
        a:hover {
            color: #fff;
            text-decoration: underline;
        }
        .input-group-text {
            background: rgba(255,255,255,0.1);
            border: none;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="reset-card">
        <h4><i class="fas fa-unlock-alt"></i> Reset Password</h4>
        <?php if (isset($error)) { ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error); ?></div>
        <?php } ?>
        <form method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan username" required>
                </div>
            </div>
            <div class="form-group">
                <label for="new_password">Password Baru:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    </div>
                    <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Masukkan password baru" required>
                </div>
            </div>
            <button type="submit" class="btn btn-warning btn-block">Reset Password</button>
        </form>
        <div class="text-center mt-3">
            <a href="login.php"><i class="fas fa-arrow-left"></i> Kembali ke Login</a>
        </div>
    </div>
</body>
</html>
