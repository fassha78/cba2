<?php
require 'koneksi.php';
wajib_login();

$id = (int)($_GET['id'] ?? 0);
$stmt = $conn->prepare('SELECT * FROM buku WHERE id_buku = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$b = $stmt->get_result()->fetch_assoc();
if (!$b) {
    header('Location: index.php');
    exit;
}

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
        // UPDATE
        $stmt = $conn->prepare('UPDATE buku SET judul = ?, pengarang = ?, tahun = ?, stok = ? WHERE id_buku = ?');
        $stmt->bind_param('ssiii', $b['judul'], $b['pengarang'], $b['tahun'], $b['stok'], $id);
        $stmt->execute();
        $_SESSION['pesan'] = 'Data buku berhasil diperbarui.';
        header('Location: index.php');
        exit;
    }
}

$judul_halaman = 'Edit Buku';
$judul_form = 'Edit Buku';
require 'header.php';
require '_form.php';
require 'footer.php';
