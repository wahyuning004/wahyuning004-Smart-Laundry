<?php 
$path_koneksi = '../config/koneksi.php';
if (file_exists($path_koneksi)) {
    require_once $path_koneksi;
} else {
    die("<div style='color:red; font-family:sans-serif; padding:20px; border:2px solid red;'>
            <h3>Fatal Error: Koneksi Tidak Ditemukan!</h3>
            <p>File <b>koneksi.php</b> tidak ada di folder config atau path salah.</p>
            <p>Jalur yang dicari: " . realpath('../') . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "koneksi.php</p>
         </div>");
}

// 2. Cek Variabel Koneksi
if (!isset($conn)) {
    die("<div style='color:orange; font-family:sans-serif; padding:20px; border:2px solid orange;'>
            <h3>Warning: Variabel \$conn Mati!</h3>
            <p>File koneksi ditemukan, tapi variabel <b>\$conn</b> tidak terbaca. 
            Pastikan di dalam file config/koneksi.php kamu menggunakan nama variabel <b>\$conn</b>.</p>
         </div>");
}

// 3. Cek Header
$path_header = '../includes/header_petugas.php';
if (file_exists($path_header)) {
    include $path_header;
} else {
    echo "<p style='color:red;'>Warning: Header petugas tidak ditemukan!</p>";
}

// 4. Proteksi Session
if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'petugas') {
    // Jika debug gagal karena session, kita tampilkan infonya daripada langsung redirect
    echo "<div style='background:#fff3cd; padding:15px; border:1px solid #ffeeba; margin-bottom:20px;'>
            <strong>Session Info:</strong><br>
            Level Anda: " . ($_SESSION['level'] ?? 'Tidak Terdeteksi') . "<br>
            Nama: " . ($_SESSION['nama'] ?? 'Tidak Terdeteksi') . "
          </div>";
    
    if (!isset($_GET['skip_protect'])) {
        header("location: ../login.php?pesan=denied");
        exit();
    }
}

// 5. Cek Query Database
$q_laundry = mysqli_query($conn, "SELECT * FROM alternatif");
if (!$q_laundry) {
    die("<p style='color:red;'>Query Error (Alternatif): " . mysqli_error($conn) . "</p>");
}
$jml_laundry = mysqli_num_rows($q_laundry);

$q_nilai = mysqli_query($conn, "SELECT * FROM penilaian");
if (!$q_nilai) {
    die("<p style='color:red;'>Query Error (Penilaian): " . mysqli_error($conn) . "</p>");
}
$jml_dinilai = mysqli_num_rows($q_nilai);
?>

<div class="row mb-4">
    <div class="col-md-12">
        <div class="card border-0 shadow-sm rounded-4 p-4" style="background: linear-gradient(135deg, #DBA39A 0%, #f0dbdb 100%); color: white;">
            <h3 class="fw-bold mb-1">Selamat Datang, Petugas! ✨</h3>
            <p class="mb-0 opacity-75">Hari ini adalah hari yang baik untuk mendata laundry berkualitas.</p>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h6 class="text-muted small fw-bold text-uppercase">Data Alternatif</h6>
                    <h2 class="fw-bold mb-0"><?= $jml_laundry; ?></h2>
                    <p class="small text-muted mt-2">Total jasa laundry yang terdaftar.</p>
                </div>
                <div class="fs-1">🏠</div>
            </div>
            <a href="alternatif_view.php" class="btn btn-sm btn-pink w-100 rounded-pill mt-3 py-2 fw-bold text-decoration-none text-center" style="background-color: var(--dusty-pink); color: white;">
                Kelola Alternatif
            </a>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h6 class="text-muted small fw-bold text-uppercase">Status Penilaian</h6>
                    <h2 class="fw-bold mb-0"><?= $jml_dinilai; ?></h2>
                    <p class="small text-muted mt-2">Laundry yang sudah diberikan nilai kriteria.</p>
                </div>
                <div class="fs-1">📝</div>
            </div>
            <a href="penilaian_view.php" class="btn btn-sm btn-outline-secondary w-100 rounded-pill mt-3 py-2 fw-bold text-decoration-none text-center">
                Input Penilaian
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4 p-4">
            <h6 class="fw-bold mb-3"><span class="me-2">💡</span> Tips Petugas</h6>
            <ul class="small text-muted mb-0">
                <li>Pastikan alamat laundry yang diinput sudah lengkap (Kelurahan/Kecamatan).</li>
                <li>Gunakan angka 1-5 saat memberikan penilaian kriteria agar akurasi SPK terjaga.</li>
                <li>Cek kembali data sebelum disimpan untuk menghindari duplikasi nama laundry.</li>
            </ul>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>