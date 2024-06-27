<?php
// Cek apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start(); // Memulai session
    
    // Lakukan operasi pengecekan login di database
    require_once('admin/connect.php');
    
    // Prevent SQL Injection dengan menggunakan prepared statement
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verifikasi password jika menggunakan hashing
        if (password_verify($password, $user['password'])) {
            // Login berhasil, simpan data pengguna ke dalam session
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
            
            // Redirect ke halaman utama setelah login berhasil
            header("Location: index.php");
            exit();
        } else {
            echo "Login gagal. Silakan cek kembali email dan password Anda.";
        }
    } else {
        echo "Login gagal. Silakan cek kembali email dan password Anda.";
    }
    
    // Tutup statement dan koneksi database
    $stmt->close();
    $conn->close();
}
?>
