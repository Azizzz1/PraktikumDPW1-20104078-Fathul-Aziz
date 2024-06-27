<?php
session_start(); // Memulai session jika belum dimulai

// Cek apakah pengguna sudah login, jika ya redirect ke index.php
if (isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

// Cek apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lakukan operasi pengecekan login di database
    require_once('connect.php'); // Sesuaikan dengan nama file koneksi
    
    // Ambil nilai dari form
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Query untuk memeriksa kecocokan email dan password di tabel pengguna
    $query = "SELECT * FROM pengguna WHERE email='$email'";
    $result = $conn->query($query);
    
    if ($result->num_rows > 0) {
        // Jika email ditemukan, verifikasi password
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Login berhasil, simpan data pengguna ke dalam session
            $_SESSION['user_id'] = $user['user_id']; // Simpan user_id ke session
            $_SESSION['email'] = $user['email']; // Simpan email ke session
            $_SESSION['nama_lengkap'] = $user['nama_lengkap']; // Simpan nama lengkap ke session
            
            // Redirect ke halaman utama (index.php)
            header("Location: index.php");
            exit();
        } else {
            // Jika password tidak cocok
            echo "Login gagal. Silakan cek kembali email dan password Anda.";
        }
    } else {
        // Jika email tidak ditemukan
        echo "Login gagal. Silakan cek kembali email dan password Anda.";
    }
    
    // Tutup koneksi database
    $conn->close();
}
?>
