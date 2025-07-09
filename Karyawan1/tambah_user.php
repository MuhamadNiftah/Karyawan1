<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: dashboard_admin.php');
    exit();
}

include 'koneksi.php';

$message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role     = $_POST['role'];

    $sql = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
    $stmt = $link->prepare($sql);

    if (!$stmt) {
        die("Prepare failed: " . $link->error);
    }

    $stmt->bind_param("sss", $username, $password, $role);

    if ($stmt->execute()) {
        header("Location: dashboard_admin.php?success=1");
        exit();
    } else {
        $message = "Gagal menambahkan user: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah User - Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
        background: url('images/didimax.jpg') no-repeat center center fixed;
        background-size: cover;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Segoe UI', sans-serif;
    }

    .card {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 1rem;
        padding: 30px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        width: 100%;
        max-width: 500px;
        color: #fff;
    }

    .card-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .card-header h4 {
        color: #fff;
    }

    label {
        color: #fff;
        font-weight: 500;
    }

    .form-control,
    .input-group-text,
    select {
        background-color: rgba(255, 255, 255, 0.8) !important;
        border: none;
        border-radius: 0.5rem !important;
        transition: all 0.3s ease;
        color: #000;
    }

    .form-control:focus {
        box-shadow: 0 0 0 2px #4e73df;
    }

    .input-group-text {
        border-right: none;
    }

    .input-group .form-control {
        border-left: none;
    }

    .btn-success {
        background-color: #224abe;
        border: none;
        font-weight: bold;
        transition: all 0.3s ease;
    }

    .btn-success:hover {
        background-color: #1a3fa3;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }

    .alert {
        font-size: 14px;
    }
  </style>
</head>
<body>
  <div class="card">
    <div class="card-header">
      <h4><i class="fas fa-user-plus"></i> Tambah User Baru</h4>
    </div>

    <?php if ($message): ?>
      <div class="alert alert-warning"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <form method="POST" action="">
      <div class="form-group">
        <label>Username</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-user"></i></span>
          </div>
          <input type="text" name="username" class="form-control" required placeholder="Masukkan Username">
        </div>
      </div>

      <div class="form-group">
        <label>Password</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-lock"></i></span>
          </div>
          <input type="password" name="password" class="form-control" required placeholder="Masukkan Password">
        </div>
      </div>

      <div class="form-group">
        <label>Role</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
          </div>
          <select name="role" class="form-control" required>
            <option value="">-- Pilih Role --</option>
            <option value="user">User</option>
            <option value="admin">Admin</option>
            <option value="Manager">Manager</option>
            <option value="IT Support">IT Support</option>
          </select>
        </div>
      </div>

      <button type="submit" class="btn btn-success btn-block mt-4">
        <i class="fas fa-plus-circle"></i> Tambah User
      </button>
    </form>
  </div>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
