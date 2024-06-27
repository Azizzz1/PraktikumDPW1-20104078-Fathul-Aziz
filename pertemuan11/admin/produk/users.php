<?php
require_once('connect.php');

$query = "SELECT * FROM users";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Users</title>
</head>
<body>
    <h2>Daftar Users</h2>
    <a href="tambah_user.php">Tambah User</a><br><br>
    <table border="1">
        <thead>
            <tr>
                <th>User ID</th>
                <th>Role ID</th>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>No. HP</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['user_id'] ?></td>
                    <td><?= $row['role_id'] ?></td>
                    <td><?= $row['nama_lengkap'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['no_hp'] ?></td>
                    <td>
                        <a href="edit_user.php?id=<?= $row['user_id'] ?>">Edit</a>
                        <a href="hapus_user.php?id=<?= $row['user_id'] ?>" onclick="return confirm('Apakah Anda yakin?')">Hapus</a>
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
