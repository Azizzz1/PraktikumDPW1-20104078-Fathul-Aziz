<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once('admin/connect.php');

    // Filter dan ambil nilai dari form
    $nama_lengkap = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Contoh menggunakan bcrypt

    // Query SQL untuk menyimpan data ke dalam tabel user
    $query = "INSERT INTO user (nama_lengkap, email, no_hp, password)
              VALUES ('$nama_lengkap', '$email', '$no_hp', '$password')";

    if ($conn->query($query) === TRUE) {
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }

    // Tutup koneksi database
    $conn->close();
}
?>
