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
        <h4 class="fw-bold mb-1">Kelola Pengguna</h4>
        <p class="text-muted small">Daftar akun admin dan pelanggan yang terdaftar di sistem.</p>
    </div>
    <div class="col-md-6 text-center text-md-end">
        <button class="btn rounded-pill shadow-sm px-4 py-2 fw-bold text-white border-0" 
                style="background: var(--dusty-pink);" 
                data-bs-toggle="modal" 
                data-bs-target="#modalTambahUser">
            + Tambah User
        </button>
    </div>
</div>

<div class="card p-4 border-0 shadow-sm" style="border-radius: 20px;">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="text-muted" style="font-size: 0.85rem; border-bottom: 2px solid var(--soft-pink);">
                <tr>
                    <th class="py-3">NO</th>
                    <th class="py-3">NAMA LENGKAP</th>
                    <th class="py-3">USERNAME</th>
                    <th class="py-3">LEVEL</th>
                    <th class="py-3 text-center">AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                // Query disesuaikan dengan kolom database kamu: nama_lengkap
                $query = mysqli_query($conn, "SELECT * FROM users ORDER BY level ASC, nama_lengkap ASC");
                
                if(mysqli_num_rows($query) == 0): ?>
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted small">Belum ada pengguna terdaftar.</td>
                    </tr>
                <?php else: 
                    while($row = mysqli_fetch_assoc($query)): ?>
                    <tr style="border-bottom: 1px solid #f8f1f1;">
                        <td class="text-muted small"><?= $no++; ?></td>
                        <td>
                            <span class="fw-bold" style="color: var(--admin-dark);">
                                <?= htmlspecialchars($row['nama_lengkap']); ?>
                            </span>
                        </td>
                        <td class="text-muted small"><?= htmlspecialchars($row['username']); ?></td>
                        <td>
                            <span class="badge rounded-pill px-3 py-2" 
                                  style="background: <?= ($row['level'] == 'admin') ? 'var(--soft-pink)' : '#e9ecef'; ?>; 
                                         color: <?= ($row['level'] == 'admin') ? 'var(--dusty-pink)' : '#6c757d'; ?>;
                                         font-size: 0.75rem;">
                                <?= strtoupper($row['level']); ?>
                            </span>
                        </td>
                        <td class="text-center">
                            <?php if($row['username'] !== $_SESSION['username']): ?>
                                <a href="aksi.php?act=user_hapus&id=<?= $row['id_user']; ?>" 
                                   class="btn btn-sm btn-light rounded-circle p-2 text-danger border-0 shadow-sm d-inline-flex align-items-center justify-content-center" 
                                   style="width: 32px; height: 32px;"
                                   onclick="return confirm('Hapus user <?= $row['nama_lengkap']; ?>?')">
                                   🗑️
                                </a>
                            <?php else: ?>
                                <span class="badge bg-light text-muted small fw-normal">Sesi Aktif</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endwhile; 
                endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modalTambahUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="fw-bold">Tambah Pengguna Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="aksi.php?act=user_tambah" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="small fw-bold mb-1">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control rounded-3" placeholder="Masukkan nama lengkap" required>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold mb-1">Username</label>
                        <input type="text" name="username" class="form-control rounded-3" placeholder="Masukkan username" required>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold mb-1">Password</label>
                        <input type="password" name="password" class="form-control rounded-3" placeholder="********" required>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold mb-1">Level Akses</label>
                        <select name="level" class="form-select rounded-3">
                            <option value="pelanggan">Pelanggan</option>
                            <option value="admin">Admin</option>
                            <option value="petugas">Petugas</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn rounded-pill px-4 text-white border-0" style="background: var(--dusty-pink);">Simpan User</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>