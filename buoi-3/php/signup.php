<?php 
    session_start();
    require 'connect-db.php';

    $username = $_POST['username'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    $avatar = $_FILES['avatar'];
    $gender = $_POST['gender'];
    $job = $_POST['job'];
    $hobby = $_POST['hobby'];

    $check = true;

    $hobby_str = '';
    foreach ($hobby as $iterator => $h) {
        if ($iterator != count($hobby) - 1) {
            $hobby_str .= $h . ', ';
        } else {
            $hobby_str .= $h;
        }
    }

    if (!$con->connect_error) {
        // echo 'Connected MySQL...<br>';
    }

    $path = '';
    if (!$avatar['error']) {
        $path .= '../upload/' . $avatar['name'];
        move_uploaded_file($avatar['tmp_name'], $path);
    }

    // Check username existed
    $sql = 'SELECT * FROM thanhvien WHERE tendangnhap = "' . $username . '";';
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        $check = false;
    }

    // Check 2 passwords match
    if ($password != $repassword) {
        $check = false;
    }
    else {
        $password_encypt = md5($password);
    }

    if ($check) {
        $sql = 'INSERT INTO thanhvien(tendangnhap, matkhau, hinhanh, gioitinh, nghenghiep, sothich) VALUES ("' . $username . '", "' . $password_encypt . '", "' . $path . '", "' . $gender . '", "' . $job . '", "' . $hobby_str . '")';
        $con->query($sql);
        header('Location: ' . '../login.html');
    }
    else {
        header('Location:' . '../signup.html');
    }

    $con->close();
?>