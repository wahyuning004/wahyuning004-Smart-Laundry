<?php 
if (session_status() === PHP_SESSION_NONE) { session_start(); }
$base_url = "http://localhost/laundry_spk/"; 
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - SPK Laundry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <style>
        :root {
            --admin-dark: #4B4453;
            --dusty-pink: #DBA39A;
            --soft-pink: #F0DBDB;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fcf8f8;
            color: var(--admin-dark);
        }

        /* Navbar Styling */
        .navbar-admin {
            background-color: #ffffff;
            padding: 15px 0;
        }

        .nav-admin-link {
            color: var(--admin-dark) !important;
            font-weight: 500;
            font-size: 0.9rem;
            margin: 0 15px;
            transition: 0.3s;
            text-decoration: none !important; 
        }

        .nav-admin-link:hover, 
        .nav-admin-link.active {
            color: var(--dusty-pink) !important;
        }

        .btn-user-profile {
            background-color: #fff;
            border: 1px solid var(--soft-pink);
            color: var(--admin-dark);
            text-decoration: none !important;
            transition: 0.3s;
        }

        .btn-user-profile:hover {
            background-color: var(--soft-pink);
        }

        .main-content {
            padding-bottom: 50px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-admin sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="<?= $base_url; ?>admin/dashboard.php" style="color: var(--dusty-pink); letter-spacing: 1px;">
            🌸 ADMIN<span style="color: var(--admin-dark);">PANEL</span>
        </a>
        
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#adminNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="adminNav">
            <ul class="navbar-nav mx-auto text-center">
                <li class="nav-item">
                    <a class="nav-admin-link <?= $current_page == 'dashboard.php' ? 'active' : ''; ?>" href="<?= $base_url; ?>admin/dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-admin-link <?= $current_page == 'kriteria_view.php' ? 'active' : ''; ?>" href="<?= $base_url; ?>admin/kriteria_view.php">Kriteria</a>
                </li>
                <li class="nav-item">
                    <a class="nav-admin-link <?= $current_page == 'alternatif_view.php' ? 'active' : ''; ?>" href="<?= $base_url; ?>admin/alternatif_view.php">Data Laundry</a>
                </li>
                <li class="nav-item">
                    <a class="nav-admin-link <?= $current_page == 'users_view.php' ? 'active' : ''; ?>" href="<?= $base_url; ?>admin/users_view.php">Kelola User</a>
                </li>
            </ul>
            
            <div class="dropdown text-center mt-3 mt-lg-0">
                <a class="btn btn-user-profile rounded-pill px-3 py-2 small dropdown-toggle shadow-sm" href="#" role="button" data-bs-toggle="dropdown">
                    <span class="badge rounded-pill me-1" style="background: var(--soft-pink); color: var(--dusty-pink);">Admin</span> 
                    <span class="fw-bold"><?= explode(' ', $_SESSION['nama'])[0]; ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-3 p-2 rounded-4">
                    <li><a class="dropdown-item rounded-3 small py-2" href="<?= $base_url; ?>index.php">🌐 Lihat Website</a></li>
                    <li><hr class="dropdown-divider opacity-50"></li>
                    <li><a class="dropdown-item rounded-3 small py-2 text-danger" href="<?= $base_url; ?>logout.php">🚪 Keluar</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <?php if(isset($_SESSION['notif'])): ?>
        <div class="alert alert-<?= $_SESSION['status']; ?> alert-dismissible fade show rounded-4 border-0 shadow-sm mb-5 animate__animated animate__fadeInDown" role="alert">
            <div class="d-flex align-items-center p-1">
                <span class="me-3 fs-5"><?= ($_SESSION['status'] == 'success') ? '✅' : '❌'; ?></span>
                <small class="fw-bold"><?= $_SESSION['notif']; ?></small>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['notif']); unset($_SESSION['status']); ?>
    <?php endif; ?>

    <div class="main-content">