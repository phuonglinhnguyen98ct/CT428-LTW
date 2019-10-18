<?php
    session_start();

    require 'connect-db.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = 'SELECT * FROM thanhvien WHERE tendangnhap = "' . $username . '"';
    // echo $sql;
    $result = $con->query($sql);
    $check = true;

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (md5($password) != $row['matkhau']) {
            $check = false;
        }
    } else {
        $check = false;
    }

    if ($check) {
        $_SESSION['username'] = $username;
        header('Location:' . './thongtincanhan.php');
    } else {
        header('Location:' . '../signup.html');
    }
?>
