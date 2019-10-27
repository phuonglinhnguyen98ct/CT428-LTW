<?php
session_start();
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    header('Location: ' . '../login.html');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/danhsachsanpham.css">
    <title>Danh sách sản phẩm</title>
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <div class="menu-container">
                <a href="./thongtincanhan.php">Thông tin cá nhân</a> |
                <a href="./danhsachsanpham.php">Danh sách sản phẩm</a> |
                <a href="./themsanpham.php">Thêm sản phẩm</a> |
                <a href="../../buoi-4/php/bai4.php">Bài 4 (Buổi 4)</a>
            </div>
            <h3>Chào bạn <?php echo $username ?> !</h3>
            <div class="product-info">
                <div>Danh sách sản phẩm của bạn là:</div>
                <table>
                    <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá sản phẩm</th>
                        <th colspan="3">Lựa chọn</th>
                    </tr>
                    <?php
                    require './connect-db.php';
                    $sql = 'SELECT * FROM sanpham as sp JOIN thanhvien as tv ON sp.idtv = tv.id WHERE tendangnhap = ?';
                    $stmt = $con->prepare($sql);
                    $stmt->bind_param('s', $username);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    $i = 1;
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $row['tensp'] ?></td>
                            <td><?php echo $row['giasp'] ?> (VND)</td>
                            <td><a href="chitietsanpham.php?idsp=<?php echo $row['idsp'] ?>">Xem chi tiết</a></td>
                            <td><a href="suasanpham.php?idsp=<?php echo $row['idsp'] ?>"><img src="../img/icon/edit.png" alt="icon-edit"></a></td>
                            <td><a href="xoasanpham.php?idsp=<?php echo $row['idsp'] ?>"><img src="../img/icon/delete.png" alt="icon-delete"></a></td>
                        </tr>
                    <?php
                        $i++;
                    }

                    $stmt->close();
                    $con->close();
                    ?>
                </table>
                <div class="logout-btn">
                    <a href="logout.php"><input type="button" value="Đăng xuất"></a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>