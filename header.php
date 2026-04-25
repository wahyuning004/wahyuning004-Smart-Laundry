<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Sesuaikan base_url jika folder project kamu berbeda
$base_url = "http://localhost/laundry_spk/"; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Laundry - Solusi Cuci Bersih</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        :root {
            --dusty-pink: #DBA39A;
            --soft-pink: #F0DBDB;
            --cream: #FEFCF3;
            --dark-text: #6D5D6E;
            --pink-hover: #c98a80;
        }

        body { 
            font-family: 'Poppins', sans-serif; 
            background-color: var(--cream); 
            color: var(--dark-text);
            overflow-x: hidden; 
        }

        /* Navbar Styling */
        .navbar { 
            background: rgba(255, 255, 255, 0.9) !important; 
            backdrop-filter: blur(10px); 
            border-bottom: 2px solid var(--soft-pink); 
            transition: all 0.3s;
        }

        .navbar-brand { 
            font-weight: 700; 
            color: var(--dusty-pink) !important; 
            letter-spacing: -1px;
        }

        .nav-link { 
            font-weight: 500; 
            color: var(--dark-text) !important; 
            margin: 0 10px;
            transition: 0.3s; 
        }

        .nav-link:hover { 
            color: var(--dusty-pink) !important; 
        }

        /* Button Custom */
        .btn-pink { 
            background-color: var(--dusty-pink); 
            color: white !important; 
            border-radius: 50px; 
            padding: 10px 28px; 
            border: none; 
            font-weight: 600; 
            transition: 0.3s; 
            display: inline-block;
        }

        .btn-pink:hover { 
            background-color: var(--pink-hover); 
            transform: translateY(-2px); 
            box-shadow: 0 5px 15px rgba(219, 163, 154, 0.4);
        }

        /* Responsive Fixes */
        .navbar-toggler { border: none; }
        .navbar-toggler:focus { box-shadow: none; }
        
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='%23DBA39A' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 8h24M4 16h24M4 24h24'/%3E%3C/svg%3E");
        }

        .dropdown-menu { 
            border-radius: 15px; 
            border: none; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.08); 
            padding: 10px;
        }

        .dropdown-item {
            border-radius: 8px;
            padding: 8px 15px;
            transition: 0.2s;
        }

        .dropdown-item:hover {
            background-color: var(--soft-pink);
            color: var(--dark-text);
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg sticky-top py-3">
    <div class="container">
        <a class="navbar-brand fs-4" href="<?= $base_url; ?>index.php">
            🌸 LAUNDRY<span style="color: var(--dark-text);">SMART</span>
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link" href="<?= $base_url; ?>index.php">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $base_url; ?>index.php#cara-kerja">Cara Kerja</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $base_url; ?>index.php#testimoni">Apa Kata Mereka</a>
                </li>
                
                <?php if(!isset($_SESSION['level'])): ?>
                    <li class="nav-item ms-lg-3">
                        <a class="btn-pink text-decoration-none shadow-sm" href="<?= $base_url; ?>login.php">
                            <i class="bi bi-person-badge me-2"></i>Akses Admin
                        </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item dropdown ms-lg-3">
                        <a class="nav-link dropdown-toggle btn btn-outline-secondary rounded-pill px-4" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i> Hi, <?= explode(' ', $_SESSION['nama'])[0]; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end mt-2 animate__animated animate__fadeInUp animate__faster">
                            <?php if($_SESSION['level'] == 'admin'): ?>
                                <li>
                                    <a class="dropdown-item small" href="<?= $base_url; ?>admin/dashboard.php">
                                        <i class="bi bi-speedometer2 me-2"></i>Dashboard Admin
                                    </a>
                                </li>
                            <?php else: ?>
                                <li>
                                    <a class="dropdown-item small" href="<?= $base_url; ?>petugas_dashboard.php">
                                        <i class="bi bi-grid-1x2 me-2"></i>Dashboard Petugas
                                    </a>
                                </li>
                            <?php endif; ?>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item small text-danger" href="<?= $base_url; ?>logout.php">
                                    <i class="bi bi-box-arrow-right me-2"></i>Keluar
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">