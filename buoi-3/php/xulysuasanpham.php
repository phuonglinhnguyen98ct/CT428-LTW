<?php
session_start();
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    header('Location: ' . '../login.html');
}
require './connect-db.php';

$tensp = $_POST['tensp'];
$chitietsp = $_POST['chitietsp'];
$giasp = $_POST['giasp'];
$hinhsp = $_FILES['hinhsp'];

// Get user's ID
$sql = 'SELECT * FROM thanhvien WHERE tendangnhap = "' . $username . '"';
$result = $con->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $userid = $row['id'];
} 

if ($hinhsp['name']) {
    $path = '../sanpham/' . $hinhsp['name'];
    move_uploaded_file($hinhsp['tmp_name'], $path);
    $sql = 'UPDATE sanpham SET tensp = "' . $tensp . '", chitietsp = "' . $chitietsp . '", giasp = "' . $giasp . '", hinhanhsp = "' . $path . '" WHERE idsp = "' . $_GET['idsp'] . '"';
    // echo $sql;
    $con->query($sql);
}
else {
    $sql = 'UPDATE sanpham SET tensp = "' . $tensp . '", chitietsp = "' . $chitietsp . '", giasp = "' . $giasp . '" WHERE idsp = "' . $_GET['idsp'] . '"';
    // echo $sql;
    $con->query($sql);
}

$con->close();
header('Location: ' . './danhsachsanpham.php');
?>