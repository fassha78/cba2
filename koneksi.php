<?php
session_start();

$conn = new mysqli('localhost', 'root', '', 'perpustakaan');
if ($conn->connect_error) {
    die('Koneksi gagal: ' . $conn->connect_error);
}
$conn->set_charset('utf8mb4');

// Escape output agar aman dari XSS
function e($teks) {
    return htmlspecialchars((string)$teks, ENT_QUOTES, 'UTF-8');
}

// Halaman yang wajib login
function wajib_login() {
    if (empty($_SESSION['user'])) {
        header('Location: login.php');
        exit;
    }
}
