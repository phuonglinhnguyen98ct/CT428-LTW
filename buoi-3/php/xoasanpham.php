<?php
    session_start();
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
    } else {
        header('Location: ' . '../login.html');
    }

    require './connect-db.php';

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

    $idsp = $_GET['idsp'];

    $sql = 'DELETE FROM sanpham WHERE idsp = ? AND idtv = ?';
    $stmt = $con->prepare($sql);
    $stmt->bind_param('ii', $idsp, $idtv);
    $stmt->execute();

    $stmt->close();
    $con->close();
    header('Location: ' . './danhsachsanpham.php');
?>