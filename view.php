<?php 
require_once '../config/koneksi.php';
include '../includes/header.php'; 

$conn = mysqli_connect($host, $user, $pass, $db);

// 1. Ambil Kriteria
$query_k = mysqli_query($conn, "SELECT * FROM kriteria");
$kriteria = [];
while($k = mysqli_fetch_assoc($query_k)) { $kriteria[] = $k; }

// 2. Ambil bobot (Slider logic)
$w = [];
foreach($kriteria as $krit) {
    $id_k = $krit['id_kriteria'];
    $w[$id_k] = $_GET['w_'.$id_k] ?? ($krit['bobot'] > 0 ? $krit['bobot'] : 1);
}

// 3. Hitung Skor SAW
$ambil_alt = mysqli_query($conn, "SELECT * FROM alternatif");
$data_rekomendasi = [];

while($alt = mysqli_fetch_assoc($ambil_alt)) {
    $id_a = $alt['id_alternatif'];
    $skor_total = 0;
    $ada_nilai = false;

    foreach($kriteria as $krit) {
        $id_k = $krit['id_kriteria'];
        $q_n = mysqli_query($conn, "SELECT nilai FROM penilaian WHERE id_alternatif='$id_a' AND id_kriteria='$id_k'");
        $d_n = mysqli_fetch_assoc($q_n);
        
        $nilai = (isset($d_n['nilai']) && $d_n['nilai'] > 0) ? $d_n['nilai'] : 1; 
        if(isset($d_n['nilai'])) $ada_nilai = true;

        $skor_total += ($nilai / 5) * $w[$id_k];
    }
    
    $alt['skor'] = ($ada_nilai) ? round($skor_total, 2) : 0.05;
    $data_rekomendasi[] = $alt;
}

// Urutkan Skor Tertinggi
usort($data_rekomendasi, function($a, $b) { return $b['skor'] <=> $a['skor']; });
?>

<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold" style="color: #4a4a4a;">Cari Laundry Terbaik</h2>
        <p class="text-muted">Sesuaikan prioritas Anda untuk mendapatkan rekomendasi terbaik di Bekasi.</p>
    </div>

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 sticky-top" style="top: 100px; z-index: 10;">
                <h5 class="fw-bold mb-4"><i class="bi bi-sliders me-2"></i>Prioritas Anda</h5>
                <form action="" method="GET">
                    <?php foreach($kriteria as $krit): ?>
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label class="small fw-bold mb-0"><?= $krit['nama_kriteria']; ?></label>
                            <span class="badge rounded-pill px-2 py-1" style="background: #faedcd; color: #d4a373;">
                                <span id="val_<?= $krit['id_kriteria']; ?>"><?= $w[$krit['id_kriteria']]; ?></span>
                            </span>
                        </div>
                        <input type="range" class="form-range custom-range" 
                               min="1" max="5" step="1"
                               name="w_<?= $krit['id_kriteria']; ?>" 
                               value="<?= $w[$krit['id_kriteria']]; ?>"
                               oninput="document.getElementById('val_<?= $krit['id_kriteria']; ?>').innerText = this.value">
                    </div>
                    <?php endforeach; ?>
                    <button type="submit" class="btn btn-pink w-100 rounded-pill fw-bold shadow-sm py-2 mt-2">
                        Update Hasil Rekomendasi
                    </button>
                </form>
            </div>
        </div>

        <div class="col-lg-8">
            <?php 
            $index = 0;
            foreach($data_rekomendasi as $row): 
                $is_top = ($index === 0); 
            ?>
            <div class="card border-0 shadow-sm rounded-4 mb-3 position-relative overflow-hidden card-hover 
                <?= $is_top ? 'p-4 border-start border-pink border-5' : 'p-3'; ?>" 
                style="<?= $is_top ? 'background: linear-gradient(to right, #fff9fb, #ffffff);' : ''; ?>">
                
                <?php if($is_top): ?>
                    <div class="position-absolute top-0 end-0 p-2">
                        <span class="badge bg-pink text-white rounded-start-pill shadow-sm py-2 px-3" style="font-size: 0.75rem;">
                            ✨ REKOMENDASI TERBAIK
                        </span>
                    </div>
                <?php endif; ?>

                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="d-flex align-items-center mb-1">
                            <h5 class="fw-bold mb-0 <?= $is_top ? 'text-pink fs-4' : ''; ?>">
                                <?= htmlspecialchars($row['nama_laundry']); ?>
                            </h5>
                            <?php if($is_top): ?>
                                <i class="bi bi-patch-check-fill ms-2 text-primary shadow-sm" title="Peringkat 1"></i>
                            <?php endif; ?>
                        </div>
                        <p class="text-muted small mb-0"><i class="bi bi-geo-alt me-1"></i><?= htmlspecialchars($row['alamat']); ?></p>
                        
                        <?php if($is_top): ?>
                            <p class="mt-2 small text-secondary d-none d-md-block italic">
                                "Laundry ini memiliki skor tertinggi berdasarkan preferensi filter Anda."
                            </p>
                        <?php endif; ?>
                    </div>
                    
                    <div class="col-md-4 text-md-end mt-3 mt-md-0">
                        <div class="mb-3">
                            <span class="badge rounded-pill <?= $is_top ? 'bg-pink' : 'bg-light text-dark'; ?> shadow-sm px-3 py-2">
                                <b>Skor: <?= $row['skor']; ?></b>
                            </span>
                        </div>
                        <button type="button" 
                                class="btn <?= $is_top ? 'btn-dark' : 'btn-outline-pink'; ?> rounded-pill px-4 fw-bold w-100 w-md-auto"
                                data-bs-toggle="modal" 
                                data-bs-target="#modalPesan"
                                onclick="siapkanPesan('<?= htmlspecialchars($row['nama_laundry']); ?>')">
                            Pesan Sekarang
                        </button>
                    </div>
                </div>
            </div>
            <?php 
            $index++;
            endforeach; 
            ?>
        </div>
    </div>
</div>

<div class="modal fade" id="modalPesan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header border-0 p-4 pb-0">
                <h5 class="fw-bold"><i class="bi bi-chat-left-dots me-2"></i>Konfirmasi Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="formLaundry">
                    <div class="mb-3">
                        <label class="small fw-bold text-muted mb-1">Laundry Tujuan</label>
                        <input type="text" id="laundry_tujuan" class="form-control bg-light border-0 fw-bold text-dark" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold text-muted mb-1">Nama Lengkap</label>
                        <input type="text" id="nama_user" class="form-control border-0 bg-light" placeholder="Contoh: Eka Wahyuning" required>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold text-muted mb-1">Alamat Penjemputan</label>
                        <textarea id="alamat_user" class="form-control border-0 bg-light" rows="3" placeholder="Jl. Raya Bekasi No. 123..." required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold text-muted mb-1">Jenis Layanan</label>
                        <select id="layanan" class="form-select border-0 bg-light">
                            <option value="Cuci Kiloan">Cuci Kiloan (Reguler)</option>
                            <option value="Cuci Satuan">Cuci Satuan (Jas/Sepatu/Tas)</option>
                            <option value="Cuci Express">Cuci Express (1 Hari Jadi)</option>
                        </select>
                    </div>
                    <hr class="my-4 text-muted">
                    <button type="button" onclick="kirimWA()" class="btn btn-success w-100 rounded-pill fw-bold py-3 shadow-sm">
                        <i class="bi bi-whatsapp me-2"></i>Kirim ke WhatsApp
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --pink: #e29578;
        --soft-pink: #faedcd;
        --dark-pink: #bc6c4d;
    }

    .btn-pink { background-color: var(--pink); color: white; border: none; transition: 0.3s; }
    .btn-pink:hover { background-color: var(--dark-pink); color: white; transform: translateY(-2px); }
    
    .btn-outline-pink { border: 2px solid var(--pink); color: var(--pink); transition: 0.3s; }
    .btn-outline-pink:hover { background-color: var(--pink); color: white; }

    .bg-pink { background-color: var(--pink) !important; }
    .text-pink { color: var(--pink) !important; }
    .border-pink { border-color: var(--pink) !important; }
    
    .card-hover { transition: all 0.3s ease; border: 1px solid transparent; }
    .card-hover:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0,0,0,0.08) !important; }

    .border-5 { border-left-width: 8px !important; }

    .custom-range::-webkit-slider-thumb { background: var(--pink); }
    .custom-range::-moz-range-thumb { background: var(--pink); }

    input.form-control:focus, textarea.form-control:focus, select.form-select:focus {
        box-shadow: none;
        background-color: #f1f1f1 !important;
    }
</style>

<script>
function siapkanPesan(namaLaundry) {
    document.getElementById('laundry_tujuan').value = namaLaundry;
}

function kirimWA() {
    const laundry = document.getElementById('laundry_tujuan').value;
    const nama = document.getElementById('nama_user').value;
    const alamat = document.getElementById('alamat_user').value;
    const layanan = document.getElementById('layanan').value;
    const no_wa = "628999652543"; 

    if(nama.trim() === "" || alamat.trim() === "") {
        alert("Harap lengkapi Nama dan Alamat penjemputan!");
        return;
    }

    const pesan = `Halo Admin, saya ingin memesan layanan laundry.%0A%0A` +
                  `*--- DETAIL PESANAN ---*%0A` +
                  `• *Laundry Tujuan* : ${laundry}%0A` +
                  `• *Nama Pelanggan* : ${nama}%0A` +
                  `• *Alamat Jemput* : ${alamat}%0A` +
                  `• *Jenis Layanan* : ${layanan}%0A%0A` +
                  `Mohon segera diproses ya, terima kasih!`;

    window.open(`https://wa.me/${no_wa}?text=${pesan}`, '_blank');
}
</script>

<?php include '../includes/footer.php'; ?>