<?php include 'includes/header.php'; ?>

<?php if(isset($_GET['pesan']) && $_GET['pesan'] == 'logout'): ?>
    <div class="alert alert-success alert-dismissible fade show rounded-pill px-4 shadow-sm border-0 mb-4" role="alert" style="background-color: #d1e7dd; color: #0f5132;">
        <strong>Selesai!</strong> Anda telah berhasil keluar dari sistem.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="row justify-content-center align-items-center" style="min-height: 75vh;">
    <div class="col-md-4">
        <div class="text-center mb-4">
            <h1 class="fw-bold" style="color: var(--dusty-pink); font-size: 2.5rem;">🌸</h1>
            <h4 class="fw-bold">Portal Staff</h4>
            <p class="text-muted small">Khusus untuk Admin & Petugas Laundry</p>
        </div>
        
        <div class="card card-aesthetic p-4 shadow-lg border-0 rounded-4">
            <?php if(isset($_GET['pesan']) && $_GET['pesan'] == 'gagal'): ?>
                <div class="alert alert-danger py-2 small rounded-pill text-center border-0 mb-4">
                    Username atau Password salah!
                </div>
            <?php endif; ?>

            <form action="proses_login.php" method="POST">
                <div class="mb-3">
                    <label class="form-label small fw-bold">Username</label>
                    <input type="text" name="username" class="form-control rounded-pill border-pink px-3 shadow-sm" placeholder="Masukkan username" required>
                </div>
                <div class="mb-4">
                    <label class="form-label small fw-bold">Password</label>
                    <input type="password" name="password" class="form-control rounded-pill border-pink px-3 shadow-sm" placeholder="********" required>
                </div>
                
                <button type="submit" class="btn btn-pink w-100 shadow-sm fw-bold py-2 rounded-pill mb-3">
                    Masuk ke Sistem
                </button>
                
                <div class="text-center">
                    <a href="index.php" class="text-decoration-none text-muted small">
                        ← Kembali ke Beranda
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>