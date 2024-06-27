<?php
require_once('connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $transaksi_id = $_POST['transaksi_id'];
    $user_id = $_POST['user_id'];
    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $quantity = $_POST['quantity'];
    $tanggal = $_POST['tanggal'];
    $total_harga = $harga * $quantity;

    $query = "UPDATE transaksi SET user_id='$user_id', nama_produk='$nama_produk', harga='$harga', quantity='$quantity', tanggal='$tanggal', total_harga='$total_harga' WHERE transaksi_id='$transaksi_id'";

    if ($conn->query($query) === TRUE) {
        header("Location: transaksi.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    $transaksi_id = $_GET['id'];
    $query = "SELECT * FROM transaksi WHERE transaksi_id='$transaksi_id'";
    $result = $conn->query($query);
    $transaksi = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaksi</title>
</head>
<body>
    <h2>Edit Transaksi</h2>
    <form method="POST" action="">
        <input type="hidden" name="transaksi_id" value="<?= $transaksi['transaksi_id'] ?>">
        
        <label for="user_id">User ID:</label>
        <input type="text" id="user_id" name="user_id" value="<?= $transaksi['user_id'] ?>" required><br><br>

        <label for="nama_produk">Nama Produk:</label>
        <input type="text" id="nama_produk" name="nama_produk" value="<?= $transaksi['nama_produk'] ?>" required><br><br>

        <label for="harga">Harga:</label>
        <input type="number" id="harga" name="harga" value="<?= $transaksi['harga'] ?>" required><br><br>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" value="<?= $transaksi['quantity'] ?>" required><br><br>

        <label for="tanggal">Tanggal:</label>
        <input type="date" id="tanggal" name="tanggal" value="<?= $transaksi['tanggal'] ?>" required><br><br>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>
