<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($judul_halaman ?? 'Perpustakaan') ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<?php if (!empty($_SESSION['user'])): ?>
<nav class="navbar navbar-expand navbar-dark bg-primary mb-4">
  <div class="container">
    <a class="navbar-brand" href="index.php">📚 Perpustakaan</a>
    <div class="d-flex align-items-center text-white">
      <span class="me-3">Halo, <?= e($_SESSION['user']['nama']) ?></span>
      <a href="logout.php" class="btn btn-light btn-sm">Logout</a>
    </div>
  </div>
</nav>
<?php endif; ?>
<div class="container">
