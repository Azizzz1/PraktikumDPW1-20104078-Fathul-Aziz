<?php
require_once('connect.php');

$user_id = $_GET['id'];
$query = "DELETE FROM users WHERE user_id='$user_id'";

if ($conn->query($query) === TRUE) {
    header("Location: users.php");
    exit();
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}

$conn->close();
?>
