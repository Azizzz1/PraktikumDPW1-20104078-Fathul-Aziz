<?php
require_once('connect.php');

$transaksi_id = $_GET['id'];
$query = "DELETE FROM transaksi WHERE transaksi_id='$transaksi_id'";

if ($conn->query($query) === TRUE) {
    header("Location: transaksi.php");
    exit();
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}

$conn->close();
?>
