<?php
session_start();
require_once '../config/koneksi.php';
$conn = mysqli_connect($host, $user, $pass, $db);
$act = $_GET['act'] ?? '';

switch ($act) {
    // ==========================================
    // PROSES DATA LAUNDRY (ALTERNATIF)
    // ==========================================

    case 'alt_tambah':
        $nama    = mysqli_real_escape_string($conn, $_POST['nama']);
        $alamat  = mysqli_real_escape_string($conn, $_POST['alamat']);
        $kontak  = mysqli_real_escape_string($conn, $_POST['kontak']); 
        $id_user = $_SESSION['id_user']; 

        $sql = "INSERT INTO alternatif (id_user, nama_laundry, alamat, keterangan) 
                VALUES ('$id_user', '$nama', '$alamat', '$kontak')";
        
        if(mysqli_query($conn, $sql)) {
            header("location: alternatif_view.php?status=success");
        } else {
            die("Gagal Tambah: " . mysqli_error($conn));
        }
        break;

    case 'alt_hapus':
        if (isset($_GET['id'])) {
            $id = mysqli_real_escape_string($conn, $_GET['id']);
            
            // 1. Matikan pengecekan relasi agar bisa dihapus meskipun ada data di tabel penilaian
            mysqli_query($conn, "SET FOREIGN_KEY_CHECKS = 0");
            
            // 2. Hapus data di tabel penilaian dulu yang berhubungan dengan id_alternatif ini
            mysqli_query($conn, "DELETE FROM penilaian WHERE id_alternatif = '$id'");
            
            // 3. Baru hapus data di tabel alternatif
            $hapus = mysqli_query($conn, "DELETE FROM alternatif WHERE id_alternatif = '$id'");
            
            // 4. Hidupkan kembali pengecekan relasi
            mysqli_query($conn, "SET FOREIGN_KEY_CHECKS = 1");

            if($hapus) {
                header("location: alternatif_view.php?status=deleted");
                exit();
            } else {
                die("Gagal Hapus: " . mysqli_error($conn));
            }
        }
        break;


    // ==========================================
    // PROSES PENILAIAN KRITERIA
    // ==========================================
    case 'simpan_nilai':
        $id_alt = mysqli_real_escape_string($conn, $_POST['id_alternatif']);
        
        // Validasi apakah array nilai ada untuk menghindari error "Undefined array key"
        if (isset($_POST['nilai']) && is_array($_POST['nilai'])) {
            $nilaiz = $_POST['nilai'];
            foreach ($nilaiz as $id_k => $nilai) {
                $id_k = mysqli_real_escape_string($conn, $id_k);
                $nilai = mysqli_real_escape_string($conn, $nilai);

                $cek = mysqli_query($conn, "SELECT * FROM penilaian WHERE id_alternatif='$id_alt' AND id_kriteria='$id_k'");
                
                if (mysqli_num_rows($cek) > 0) {
                    mysqli_query($conn, "UPDATE penilaian SET nilai='$nilai' WHERE id_alternatif='$id_alt' AND id_kriteria='$id_k'");
                } else {
                    mysqli_query($conn, "INSERT INTO penilaian (id_alternatif, id_kriteria, nilai) VALUES ('$id_alt', '$id_k', '$nilai')");
                }
            }
            header("location: penilaian_view.php?status=success");
        } else {
            die("ID Alternatif atau Nilai Kosong!");
        }
        break;

    case 'hapus_nilai':
        if (isset($_GET['id'])) {
            $id = mysqli_real_escape_string($conn, $_GET['id']);
            // Menghapus semua baris nilai di tabel penilaian berdasarkan id_alternatif
            $query = mysqli_query($conn, "DELETE FROM penilaian WHERE id_alternatif = '$id'");
            
            if ($query) {
                header("location: penilaian_view.php?status=deleted");
            } else {
                die("Gagal Hapus: " . mysqli_error($conn));
            }
        }
        break;
}