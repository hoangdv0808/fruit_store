<?php
$host = 'localhost'; 
$user = 'root';
$password = '';
$database = 'fruit_store'; 

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
} else {
    echo "Kết nối thành công!";
}
?>
