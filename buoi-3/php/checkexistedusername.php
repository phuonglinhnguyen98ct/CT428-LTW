<?php
require 'connect-db.php';

$username = $_GET['username'];

$sql = 'SELECT * FROM thanhvien WHERE tendangnhap = ?';

$stmt = $con->prepare($sql);
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();

$check = true;
if ($result->num_rows > 0) {
    echo 'Tên tài khoản đã tồn tại';
}

$stmt->close();
$con->close();

