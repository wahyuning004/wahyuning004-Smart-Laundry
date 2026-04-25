<?php 
require_once '../config/koneksi.php';
include '../includes/header_admin.php'; 
$conn = mysqli_connect($host, $user, $pass, $db);
// Proteksi Admin
if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'admin') {
    header("location: ../login.php?pesan=denied");
    exit();
}
?>

<div class="row mb-4 align-items-center">
    <div class="col-md-6 text-center text-md-start">
        <h4 class="fw-bold mb-1">Daftar Kriteria</h4>
        <p class="text-muted small">Kelola bobot dan jenis kriteria untuk perhitungan SPK.</p>
    </div>
    <div class="col-md-6 text-center text-md-end">
        <button class="btn btn-pink rounded-pill shadow-sm px-4 py-2 fw-bold" style="background: var(--dusty-pink); color:white; border:none;" data-bs-toggle="modal" data-bs-target="#modalTambah">
            + Tambah Kriteria
        </button>
    </div>
</div>

<div class="card card-custom p-4 border-0">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="text-muted" style="font-size: 0.85rem; border-bottom: 2px solid var(--soft-pink);">
                <tr>
                    <th class="py-3">KODE</th>
                    <th class="py-3">NAMA KRITERIA</th>
                    <th class="py-3 text-center">BOBOT (%)</th>
                    <th class="py-3 text-center">JENIS</th>
                    <th class="py-3 text-center">AKSI</th>
                </tr>
            </thead>
            <tbody>
                    <?php 
                    $query = mysqli_query($conn, "SELECT * FROM kriteria ORDER BY id_kriteria ASC");
                    if(mysqli_num_rows($query) == 0) {
                        echo "<tr><td colspan='5' class='text-center py-5 text-muted small'>Belum ada kriteria.</td></tr>";
                    }
                    while($row = mysqli_fetch_assoc($query)):
                    ?>
                    <tr style="border-bottom: 1px solid #f0f0f0;">
                        <td class="fw-bold text-muted small"><?= $row['kode_kriteria']; ?></td>
                        <td class="fw-semibold"><?= $row['nama_kriteria']; ?></td>
                        <td class="text-center">
                            <span class="badge rounded-pill px-3 py-2" style="background: var(--soft-pink); color: var(--dusty-pink);">
                                <?= $row['bobot']; ?>%
                            </span>
                        </td>
                        <td class="text-center text-uppercase small fw-bold text-muted">
                            <?= $row['jenis']; ?>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-light rounded-circle p-2 text-primary border-0 shadow-sm me-1" 
                                    data-bs-toggle="modal" data-bs-target="#modalEdit<?= $row['id_kriteria']; ?>">
                                ✏️
                            </button>

                            <a href="aksi.php?act=kriteria_hapus&id=<?= $row['id_kriteria']; ?>" 
                            class="btn btn-sm btn-light rounded-circle p-2 text-danger border-0 shadow-sm d-inline-flex align-items-center justify-content-center text-decoration-none" 
                            style="width: 32px; height: 32px;"
                            onclick="return confirm('Yakin ingin menghapus kriteria ini?')">
                                🗑️
                            </a>
                        </td>
                    </tr>

                    <div class="modal fade" id="modalEdit<?= $row['id_kriteria']; ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0 rounded-4 shadow">
                                <div class="modal-header border-0 pb-0">
                                    <h5 class="fw-bold">Edit Kriteria</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="aksi.php?act=kriteria_edit" method="POST">
                                    <input type="hidden" name="id" value="<?= $row['id_kriteria']; ?>">
                                    <div class="modal-body text-start">
                                        <div class="mb-3">
                                            <label class="small fw-bold mb-1">Kode Kriteria</label>
                                            <input type="text" name="kode" class="form-control rounded-3" value="<?= $row['kode_kriteria']; ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="small fw-bold mb-1">Nama Kriteria</label>
                                            <input type="text" name="nama" class="form-control rounded-3" value="<?= $row['nama_kriteria']; ?>" required>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="small fw-bold mb-1">Bobot (%)</label>
                                                <input type="number" name="bobot" class="form-control rounded-3" value="<?= $row['bobot']; ?>" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="small fw-bold mb-1">Jenis</label>
                                                <select name="jenis" class="form-select rounded-3">
                                                    <option value="benefit" <?= $row['jenis'] == 'benefit' ? 'selected' : ''; ?>>Benefit</option>
                                                    <option value="cost" <?= $row['jenis'] == 'cost' ? 'selected' : ''; ?>>Cost</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-0">
                                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-pink rounded-pill px-4" style="background: var(--dusty-pink); color:white;">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </tbody>

<form action="aksi.php?act=kriteria_tambah" method="POST">
        </table>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="fw-bold">Tambah Kriteria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="aksi.php" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="small fw-bold mb-1">Kode Kriteria</label>
                        <input type="text" name="kode" class="form-control rounded-3" placeholder="Contoh: C1" required>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold mb-1">Nama Kriteria</label>
                        <input type="text" name="nama" class="form-control rounded-3" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="small fw-bold mb-1">Bobot (%)</label>
                            <input type="number" name="bobot" class="form-control rounded-3" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="small fw-bold mb-1">Jenis</label>
                            <select name="jenis" class="form-select rounded-3">
                                <option value="benefit">Benefit</option>
                                <option value="cost">Cost</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="tambah" class="btn btn-pink rounded-pill px-4" style="background: var(--dusty-pink); color:white;">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>