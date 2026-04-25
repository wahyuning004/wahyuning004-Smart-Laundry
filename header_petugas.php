<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$base_url = "http://localhost/laundry_spk/"; 

// Ambil nama file halaman saat ini
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petugas Panel - SPK Laundry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --dusty-pink: #DBA39A;
            --soft-pink: #F0DBDB;
            --cream: #FEFCF3;
            --dark-text: #6D5D6E;
        }
        body { font-family: 'Poppins', sans-serif; background-color: var(--cream); color: var(--dark-text); }
        .navbar-petugas { background: white; border-bottom: 2px solid var(--soft-pink); }
        
        /* Default warna menu */
        .nav-link { 
            color: var(--dark-text) !important; 
            font-weight: 500; 
            transition: 0.3s; 
            position: relative;
        }

        /* Warna saat dihover atau saat halaman aktif */
        .nav-link:hover, 
        .nav-link.active { 
            color: var(--dusty-pink) !important; 
        }

        /* Garis bawah tipis saat aktif (opsional biar makin cantik) */
        .nav-link.active::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 15px;
            right: 15px;
            height: 2px;
            background-color: var(--dusty-pink);
            border-radius: 2px;
        }

        .btn-logout { border: 1.5px solid #dc3545; color: #dc3545; border-radius: 50px; padding: 5px 20px; font-size: 0.85rem; transition: 0.3s; }
        .btn-logout:hover { background: #dc3545; color: white; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-petugas sticky-top py-3 mb-4 shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="<?= $base_url; ?>petugas/dashboard.php" style="color: var(--dusty-pink);">
            🧺 PETUGAS<span style="color: var(--dark-text);">MODE</span>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link px-3 <?= ($current_page == 'dashboard.php') ? 'active' : ''; ?>" href="dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 <?= ($current_page == 'alternatif_view.php') ? 'active' : ''; ?>" href="alternatif_view.php">Kelola Alternatif</a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link px-3 <?= ($current_page == 'penilaian_view.php') ? 'active' : ''; ?>" href="penilaian_view.php">Input penilaian</a>
                </li>
                <li class="nav-item">
                    <span class="me-3 small d-none d-md-inline text-muted">Halo, <strong><?= explode(' ', $_SESSION['nama'] ?? 'User')[0]; ?></strong></span>
                    <a href="<?= $base_url; ?>logout.php" class="btn-logout text-decoration-none">Keluar</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">