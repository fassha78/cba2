<?php
require 'koneksi.php';
wajib_login();

// DELETE (hanya lewat POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)($_POST['id'] ?? 0);
    $stmt = $conn->prepare('DELETE FROM buku WHERE id_buku = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $_SESSION['pesan'] = 'Buku berhasil dihapus.';
}
header('Location: index.php');
exit;
