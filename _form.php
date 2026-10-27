<?php /* Form bersama untuk tambah & edit. Variabel: $b (data), $judul_form */ ?>
<div class="row justify-content-center">
  <div class="col-md-6">
    <div class="card shadow-sm">
      <div class="card-body p-4">
        <h5 class="mb-3"><?= e($judul_form) ?></h5>
        <?php if (!empty($error)): ?>
          <div class="alert alert-danger"><?= e($error) ?></div>
        <?php endif; ?>
        <form method="post">
          <div class="mb-3">
            <label class="form-label">Judul Buku</label>
            <input type="text" name="judul" class="form-control" value="<?= e($b['judul']) ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Pengarang</label>
            <input type="text" name="pengarang" class="form-control" value="<?= e($b['pengarang']) ?>" required>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label class="form-label">Tahun</label>
              <input type="number" name="tahun" class="form-control" min="1900" max="2100" value="<?= e($b['tahun']) ?>" required>
            </div>
            <div class="col mb-3">
              <label class="form-label">Stok</label>
              <input type="number" name="stok" class="form-control" min="0" value="<?= e($b['stok']) ?>" required>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Simpan</button>
          <a href="index.php" class="btn btn-secondary">Batal</a>
        </form>
      </div>
    </div>
  </div>
</div>
