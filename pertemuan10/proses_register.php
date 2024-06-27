<?php
// Cek apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lakukan operasi penyimpanan data ke database
    require_once('connect.php'); // Sesuaikan dengan nama file koneksi
    
    // Ambil nilai dari form
    $nama_lengkap = $_POST['nama_lengkap'];
    $no_hp = $_POST['no_hp'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Hash password sebelum disimpan ke database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Query untuk menyimpan data pengguna baru ke tabel pengguna
    $query = "INSERT INTO pengguna (nama_lengkap, no_hp, email, password) VALUES ('$nama_lengkap', '$no_hp', '$email', '$hashed_password')";
    
    if ($conn->query($query) === TRUE) {
        // Jika penyimpanan berhasil, redirect ke halaman login.php
        header("Location: login.php");
        exit();
    } else {
        // Jika terjadi error dalam proses penyimpanan data
        echo "Error: " . $query . "<br>" . $conn->error;
    }
    
    // Tutup koneksi database
    $conn->close();
}
?>
