<?php
require 'koneksi.php';
wajib_login();

// READ: tampilkan data, dengan pencarian opsional
$cari = trim($_GET['cari'] ?? '');
if ($cari !== '') {
    $like = '%' . $cari . '%';
    $stmt = $conn->prepare('SELECT * FROM buku WHERE judul LIKE ? OR pengarang LIKE ? ORDER BY id_buku DESC');
    $stmt->bind_param('ss', $like, $like);
} else {
    $stmt = $conn->prepare('SELECT * FROM buku ORDER BY id_buku DESC');
}
$stmt->execute();
$hasil = $stmt->get_result();

$pesan = $_SESSION['pesan'] ?? '';
unset($_SESSION['pesan']);

$judul_halaman = 'Data Buku';
require 'header.php';
?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <h4 class="mb-0">Data Buku</h4>
  <a href="tambah.php" class="btn btn-success">+ Tambah Buku</a>
</div>

<?php if ($pesan): ?>
  <div class="alert alert-success alert-dismissible fade show">
    <?= e($pesan) ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
<?php endif; ?>

<form method="get" class="input-group mb-3">
  <input type="text" name="cari" class="form-control" placeholder="Cari judul atau pengarang..." value="<?= e($cari) ?>">
  <button class="btn btn-outline-primary">Cari</button>
</form>

<div class="card shadow-sm">
  <div class="table-responsive">
    <table class="table table-striped table-hover mb-0">
      <thead class="table-primary">
        <tr><th>No</th><th>Judul</th><th>Pengarang</th><th>Tahun</th><th>Stok</th><th class="text-center">Aksi</th></tr>
      </thead>
      <tbody>
      <?php $no = 1; while ($b = $hasil->fetch_assoc()): ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= e($b['judul']) ?></td>
          <td><?= e($b['pengarang']) ?></td>
          <td><?= e($b['tahun']) ?></td>
          <td><?= e($b['stok']) ?></td>
          <td class="text-center">
            <a href="edit.php?id=<?= (int)$b['id_buku'] ?>" class="btn btn-warning btn-sm">Edit</a>
            <form action="hapus.php" method="post" class="d-inline"
                  onsubmit="return confirm('Hapus buku ini?')">
              <input type="hidden" name="id" value="<?= (int)$b['id_buku'] ?>">
              <button class="btn btn-danger btn-sm">Hapus</button>
            </form>
          </td>
        </tr>
      <?php endwhile; ?>
      <?php if ($no === 1): ?>
        <tr><td colspan="6" class="text-center text-muted py-4">Data tidak ditemukan.</td></tr>
      <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
<?php require 'footer.php'; ?>
