<?php
require 'koneksi.php';

if (!empty($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $conn->prepare('SELECT id, username, password, nama FROM users WHERE username = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        session_regenerate_id(true);
        $_SESSION['user'] = ['id' => $user['id'], 'nama' => $user['nama']];
        header('Location: index.php');
        exit;
    }
    $error = 'Username atau password salah.';
}

$judul_halaman = 'Login';
require 'header.php';
?>
<div class="row justify-content-center mt-5">
  <div class="col-md-4">
    <div class="card shadow-sm">
      <div class="card-body p-4">
        <h4 class="text-center mb-4">Login Perpustakaan</h4>
        <?php if ($error): ?>
          <div class="alert alert-danger"><?= e($error) ?></div>
        <?php endif; ?>
        <form method="post">
          <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" required autofocus>
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <button type="submit" class="btn btn-primary w-100">Masuk</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>
