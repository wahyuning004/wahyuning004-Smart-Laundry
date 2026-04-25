<?php 
require_once '../config/koneksi.php';
include '../includes/header_petugas.php'; 
$conn = mysqli_connect($host, $user, $pass, $db);

// Cek jika sedang mode EDIT
$edit_id = $_GET['edit'] ?? '';
$data_edit = [];
if($edit_id) {
    $q_edit = mysqli_query($conn, "SELECT * FROM alternatif WHERE id_alternatif='$edit_id'");
    $data_edit = mysqli_fetch_assoc($q_edit);
}

$laundry = mysqli_query($conn, "SELECT * FROM alternatif");
$kriteria = mysqli_query($conn, "SELECT * FROM kriteria");
$list_kriteria = [];
while($k = mysqli_fetch_assoc($kriteria)) { $list_kriteria[] = $k; }
?>

<div class="row mb-5">
    <div class="col-md-12 text-center">
        <h2 class="fw-bold" style="color: #333;">Kelola Penilaian</h2>
        <p class="text-muted">Hanya menampilkan laundry yang sudah dinilai.</p>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 sticky-top" style="top: 100px;">
            <div class="p-4 border-bottom bg-light rounded-top-4">
                <h6 class="fw-bold mb-0"><?= $edit_id ? '✨ Edit Penilaian' : '📝 Input Penilaian Baru' ?></h6>
            </div>
            <div class="p-4">
                <form action="aksi.php?act=simpan_nilai" method="POST">
                    <div class="mb-3">
                        <label class="small fw-bold">Pilih Laundry</label>
                        <select name="id_alternatif_select" class="form-select border-0 bg-light" required <?= $edit_id ? 'disabled' : '' ?> onchange="document.getElementById('id_alt_hidden').value = this.value">
                            <option value="">-- Pilih Laundry --</option>
                            <?php 
                            mysqli_data_seek($laundry, 0);
                            while($l = mysqli_fetch_assoc($laundry)): 
                            ?>
                            <option value="<?= $l['id_alternatif'] ?>" <?= ($edit_id == $l['id_alternatif']) ? 'selected' : '' ?>>
                                <?= $l['nama_laundry'] ?>
                            </option>
                            <?php endwhile; ?>
                        </select>
                        <input type="hidden" name="id_alternatif" id="id_alt_hidden" value="<?= $edit_id ?>">
                    </div>

                    <hr class="text-muted opacity-25">

                    <?php foreach($list_kriteria as $krit): 
                        $id_k = $krit['id_kriteria'];
                        $val = 0;
                        if($edit_id){
                            $cek_n = mysqli_query($conn, "SELECT nilai FROM penilaian WHERE id_alternatif='$edit_id' AND id_kriteria='$id_k'");
                            $dn = mysqli_fetch_assoc($cek_n);
                            $val = $dn['nilai'] ?? 0;
                        }
                    ?>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <label class="small fw-bold"><?= $krit['nama_kriteria'] ?></label>
                            <span class="fw-bold text-primary" id="val_<?= $id_k ?>"><?= $val ?></span>
                        </div>
                        <input type="range" name="nilai[<?= $id_k ?>]" class="form-range" 
                               min="0" max="5" step="1" value="<?= $val ?>"
                               oninput="document.getElementById('val_<?= $id_k ?>').innerText = this.value">
                    </div>
                    <?php endforeach; ?>

                    <button type="submit" class="btn btn-primary w-100 rounded-pill fw-bold py-2 shadow-sm">
                        <?= $edit_id ? 'Simpan Penilaian' : 'Tambah Penilaian' ?>
                    </button>
                    <?php if($edit_id): ?>
                        <a href="penilaian_view.php" class="btn btn-light w-100 rounded-pill small mt-2 border">Batal</a>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>

<div class="col-lg-8">
    <div class="card border-0 shadow-sm rounded-4 p-4">
        <h6 class="fw-bold mb-4">Daftar Penilaian Aktif</h6>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="bg-light">
                    <tr>
                        <th>Nama Laundry</th>
                        <?php foreach($list_kriteria as $k) echo "<th class='text-center small'>".$k['nama_kriteria']."</th>"; ?>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    // Mengambil laundry yang sudah memiliki record di tabel penilaian
                    $q_penilaian = mysqli_query($conn, "SELECT DISTINCT a.id_alternatif, a.nama_laundry 
                                                       FROM alternatif a 
                                                       INNER JOIN penilaian p ON a.id_alternatif = p.id_alternatif");
                    
                    while($row = mysqli_fetch_assoc($q_penilaian)): 
                        $id_a = $row['id_alternatif'];
                    ?>
                    <tr>
                        <td class="fw-bold"><?= $row['nama_laundry'] ?></td>
                        <?php foreach($list_kriteria as $k): 
                            $id_k = $k['id_kriteria'];
                            $q_skor = mysqli_query($conn, "SELECT nilai FROM penilaian WHERE id_alternatif='$id_a' AND id_kriteria='$id_k'");
                            $d_skor = mysqli_fetch_assoc($q_skor);
                            $skor = $d_skor['nilai'] ?? '0';
                        ?>
                        <td class="text-center">
                            <span class="badge rounded-pill bg-primary"><?= $skor ?></span>
                        </td>
                        <?php endforeach; ?>
                        
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="?edit=<?= $id_a ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                                <a href="aksi.php?act=hapus_nilai&id=<?= $id_a ?>" 
                                   class="btn btn-sm btn-outline-danger" 
                                   onclick="return confirm('Hapus semua penilaian untuk laundry ini?')">Hapus</a>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>