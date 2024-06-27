<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once('connect.php');
    
    $user_id = $_POST['user_id'];
    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $quantity = $_POST['quantity'];
    $tanggal = $_POST['tanggal'];
    $total_harga = $harga * $quantity;

    $query = "INSERT INTO transaksi (user_id, nama_produk, harga, quantity, tanggal, total_harga) VALUES ('$user_id', '$nama_produk', '$harga', '$quantity', '$tanggal', '$total_harga')";

    if ($conn->query($query) === TRUE) {
        header("Location: transaksi.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi</title>
</head>
<body>
    <h2>Tambah Transaksi</h2>
    <form method="POST" action="">
        <label for="user_id">User ID:</label>
        <input type="text"        id="user_id" name="user_id" required><br><br>

<label for="nama_produk">Nama Produk:</label>
<input type="text" id="nama_produk" name="nama_produk" required><br><br>

<label for="harga">Harga:</label>
<input type="number" id="harga" name="harga" required><br><br>

<label for="quantity">Quantity:</label>
<input type="number" id="quantity" name="quantity" required><br><br>

<label for="tanggal">Tanggal:</label>
<input type="date" id="tanggal" name="tanggal" required><br><br>

<button type="submit">Simpan</button>
</form>
</body>
</html>

