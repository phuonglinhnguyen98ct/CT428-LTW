<?php
session_start();

require 'connect-db.php';

$username = $_POST['username'];
$password = $_POST['password'];

$sql = 'SELECT * FROM thanhvien WHERE tendangnhap = ?';
$stmt = $con->prepare($sql);
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();

$check = true;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (md5($password) != $row['matkhau']) {
        $check = false;
    }
} else {
    $check = false;
}

$stmt->close();
$con->close();

if ($check) {
    $_SESSION['username'] = $username;
    header('Location:' . './thongtincanhan.php');
} else {
    echo '<script>
            alert("Sai tên tài khoản hoặc mật khẩu"); 
            window.location.href = "../login.html";
        </script>';
}
