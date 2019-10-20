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
    $idsp = $_GET['idsp'];

    // Get user's ID
    $sql = 'SELECT * FROM thanhvien WHERE tendangnhap = ?';

    $stmt = $con->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();

    $result = $stmt->get_result();
        
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $idtv = $row['id'];
    } 

    if ($hinhsp['name']) {
        $path = '../sanpham/' . $hinhsp['name'];
        move_uploaded_file($hinhsp['tmp_name'], $path);
        $sql = 'UPDATE sanpham SET tensp = ?, chitietsp = ?, giasp = ?, hinhanhsp = ? WHERE idsp = ? AND idtv = ?';
        $stmt = $con->prepare($sql);
        $stmt->bind_param('ssisii', $tensp, $chitietsp, $giasp, $path, $idsp, $idtv);
        $stmt->execute();
    }
    else {
        $sql = 'UPDATE sanpham SET tensp = ?, chitietsp = ?, giasp = ? WHERE idsp = ? AND idtv = ?';
        $stmt = $con->prepare($sql);
        $stmt->bind_param('ssiii', $tensp, $chitietsp, $giasp, $idsp, $idtv);
        $stmt->execute();
    }

    $stmt->close();
    $con->close();
    header('Location: ' . './danhsachsanpham.php');
?>