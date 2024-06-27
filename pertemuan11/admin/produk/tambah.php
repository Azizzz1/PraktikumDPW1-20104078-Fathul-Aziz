<?php
require_once('connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $role_id = $_POST['role_id'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];

    $query = "UPDATE users SET role_id='$role_id', nama_lengkap='$nama_lengkap', email='$email', no_hp='$no_hp' WHERE user_id='$user_id'";

    if ($conn->query($query) === TRUE) {
        header("Location: users.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    $user_id = $_GET['id'];
    $query = "SELECT * FROM users WHERE user_id='$user_id'";
    $result = $conn->query($query);
    $user = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <h2>Edit User</h2>
    <form method="POST" action="">
        <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
        
        <label for="role_id">Role ID:</label>
        <input type="text" id="role_id" name="role_id" value="<?= $user['role_id'] ?>" required><br><br>

        <label for="nama_lengkap">Nama Lengkap:</label>
        <input type="text" id="nama_lengkap" name="nama_lengkap" value="<?= $user['nama_lengkap'] ?>" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?= $user['email'] ?>" required><br><br>

        <label for="no_hp">No. HP:</label>
        <input type="text" id="no_hp" name="no_hp" value="<?= $user['no_hp'] ?>" required><br><br>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>
