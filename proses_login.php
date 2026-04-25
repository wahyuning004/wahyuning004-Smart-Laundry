<?php 
session_start();
include 'config/koneksi.php';

// Pastikan data dikirim melalui POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query mencari user berdasarkan username & password
    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    $cek = mysqli_num_rows($query);

    if($cek > 0){
        $data = mysqli_fetch_assoc($query);

        // Simpan data ke Session
        $_SESSION['id_user']  = $data['id_user'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['nama']     = $data['nama_lengkap'];
        $_SESSION['level']    = $data['level'];

        // REDIRECT OTOMATIS SESUAI ROLE & FOLDER
        if($data['level'] == "admin"){
            // Masuk ke folder admin
            header("location: admin/dashboard.php");
        } else if($data['level'] == "petugas"){
            // Masuk ke folder petugas
            header("location: petugas/dashboard.php");
        } else {
            // Jika ada role lain atau pelanggan, lempar ke index
            header("location: index.php");
        }
        exit();

    } else {
        // Jika login gagal
        header("location: login.php?pesan=gagal");
        exit();
    }
} else {
    // Jika akses file ini tanpa form
    header("location: login.php");
    exit();
}
?>