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
    <link rel="stylesheet" href="../css/chitietsanpham.css">
    <title>Chi tiết sản phẩm</title>
</head>

<body>
    <?php
    require './connect-db.php';
    $idsp = $_GET['idsp'];
    $sql = 'SELECT * FROM sanpham WHERE idsp = ?';
    $stmt = $con->prepare($sql);
    $stmt->bind_param('i', $idsp);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }

    $stmt->close();
    $con->close();
    ?>
    <div class="wrapper">
        <div class="container">
            <div class="menu-container">
                <a href="./thongtincanhan.php">Thông tin cá nhân</a> |
                <a href="./danhsachsanpham.php">Danh sách sản phẩm</a> |
                <a href="./themsanpham.php">Thêm sản phẩm</a>
            </div>
            <h3>Thông tin sản phẩm</h3>
            <div class="product-info">
                <div class="grid-col-4-6">
                    <div>Tên sản phẩm</div>
                    <div><input type="text" name="tensp" value="<?php echo $row['tensp'] ?>" readonly></div>
                </div>
                <div class="grid-col-4-6">
                    <div>Chi tiết sản phẩm</div>
                    <div><textarea name="chitietsp" cols="20" rows="5" readonly><?php echo $row['chitietsp'] ?></textarea></div>
                </div>
                <div class="grid-col-4-6">
                    <div>Giá sản phẩm</div>
                    <div><input type="number" name="giasp" value="<?php echo $row['giasp'] ?>" readonly>(VND)</div>
                </div>
                <div class="grid-col-4-6">
                    <div>Hình đại diện</div>
                    <div><img src="<?php echo $row['hinhanhsp'] ?>" alt="hinhsp"></div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>