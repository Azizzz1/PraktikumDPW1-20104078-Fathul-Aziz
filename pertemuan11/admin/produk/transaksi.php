<?php
require_once('connect.php');

$query = "SELECT * FROM transaksi";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Transaksi</title>
</head>
<body>
    <h2>Daftar Transaksi</h2>
    <a href="tambah_transaksi.php">Tambah Transaksi</a><br><br>
    <table border="1">
        <thead>
            <tr>
                <th>Transaksi ID</th>
                <th>User ID</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Quantity</th>
                <th>Tanggal</th>
                <th>Total Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['transaksi_id'] ?></td>
                    <td><?= $row['user_id'] ?></td>
                    <td><?= $row['nama_produk'] ?></td>
                    <td><?= $row['harga'] ?></td>
                    <td><?= $row['quantity'] ?></td>
                    <td><?= $row['tanggal'] ?></td>
                    <td><?= $row['total_harga'] ?></td>
                    <td>
                        <a href="edit_transaksi.php?id=<?= $row['transaksi_id'] ?>">Edit</a>
                        <a href="hapus_transaksi.php?id=<?= $row['transaksi_id'] ?>" onclick="return confirm('Apakah Anda yakin?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>

<?php
$conn->close();
?>
