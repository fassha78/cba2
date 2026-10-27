<?php
require 'koneksi.php';
wajib_login();

$b = ['judul' => '', 'pengarang' => '', 'tahun' => date('Y'), 'stok' => 1];
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $b = [
        'judul'     => trim($_POST['judul'] ?? ''),
        'pengarang' => trim($_POST['pengarang'] ?? ''),
        'tahun'     => (int)($_POST['tahun'] ?? 0),
        'stok'      => (int)($_POST['stok'] ?? 0),
    ];
    if ($b['judul'] === '' || $b['pengarang'] === '') {
        $error = 'Judul dan pengarang wajib diisi.';
    } else {
        // CREATE
        $stmt = $conn->prepare('INSERT INTO buku (judul, pengarang, tahun, stok) VALUES (?, ?, ?, ?)');
        $stmt->bind_param('ssii', $b['judul'], $b['pengarang'], $b['tahun'], $b['stok']);
        $stmt->execute();
        $_SESSION['pesan'] = 'Buku berhasil ditambahkan.';
        header('Location: index.php');
        exit;
    }
}

$judul_halaman = 'Tambah Buku';
$judul_form = 'Tambah Buku';
require 'header.php';
require '_form.php';
require 'footer.php';
