<?php
$conn = new mysqli("localhost", "root", "", "your_database");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM credentials WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    header("Location: index.html");
    exit();
} else {
    echo "<script>alert('Incorrect credentials. Please try again.'); window.location.href='login.html';</script>";
}

$stmt->close();
$conn->close();
?>