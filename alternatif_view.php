<?php 
require_once '../config/koneksi.php';
include '../includes/header_petugas.php'; 
$conn = mysqli_connect($host, $user, $pass, $db);
// Ambil data laundry
$query = mysqli_query($conn, "SELECT * FROM alternatif ORDER BY id_alternatif DESC");
?>

<div class="row mb-4 align-items-center">
    <div class="col-md-6">
        <h4 class="fw-bold mb-1">Daftar Laundry</h4>
        <p class="text-muted small">Kelola data laundry yang akan dimasukkan ke sistem SPK.</p>
    </div>
    <div class="col-md-6 text-md-end">
        <button class="btn rounded-pill shadow-sm px-4 py-2 fw-bold text-white border-0" 
                style="background: var(--dusty-pink);" 
                data-bs-toggle="modal" data-bs-target="#addAlt">
            + Laundry Baru
        </button>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4 p-4">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr class="small text-muted">
                    <th>NO</th>
                    <th>NAMA LAUNDRY</th>
                    <th>ALAMAT</th>
                    <th>KONTAK (WA)</th>
                    <th class="text-center">AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; while($row = mysqli_fetch_assoc($query)): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td class="fw-bold"><?= $row['nama_laundry']; ?></td>
                    <td class="small"><?= $row['alamat']; ?></td>
                    <td><span class="badge bg-light text-dark"><?= $row['keterangan']; ?></span></td>
                    <td class="text-center">
                        <a href="aksi.php?act=alt_hapus&id=<?= $row['id_alternatif']; ?>" 
                           class="btn btn-sm btn-light text-danger rounded-circle p-2"
                           onclick="return confirm('Hapus laundry ini?')">🗑️</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="addAlt" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4">
            <form action="aksi.php?act=alt_tambah" method="POST">
                <div class="modal-body p-4">
                    <h5 class="fw-bold mb-4">Tambah Laundry</h5>
                    <div class="mb-3">
                        <label class="small fw-bold">Nama Laundry</label>
                        <input type="text" name="nama" class="form-control rounded-3" required>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold">Alamat</label>
                        <textarea name="alamat" class="form-control rounded-3" rows="2" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold">Nomor WA (Contoh: 0812...)</label>
                        <input type="text" name="kontak" class="form-control rounded-3" required>
                    </div>
                    <button type="submit" class="btn w-100 rounded-pill text-white fw-bold py-2" style="background: var(--dusty-pink);">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>