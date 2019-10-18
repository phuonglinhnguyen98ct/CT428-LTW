<?php
    session_start();
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
    } else {
        header('Location: ' . '../login.html');
    }
    require './connect-db.php';
    $sql = 'DELETE FROM sanpham WHERE idsp = ' . $_GET['idsp'];
    $con->query($sql);

    $con->close();
    header('Location: ' . './danhsachsanpham.php');
?>