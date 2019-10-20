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
    <link rel="stylesheet" href="../css/suasanpham.css">
    <title>Thay đổi thông tin sản phẩm</title>
</head>

<body>
    <?php
    require './connect-db.php';
    $idsp = $_GET['idsp'];
    $sql = 'SELECT * FROM sanpham WHERE idsp = ?';

    $stmt = $con->prepare($sql);
    $stmt->bind_param('i', $_GET['idsp']);
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
            <h3>Thay đổi thông tin sản phẩm</h3>
            <div class="edit-product-form">
                <form action="./xulysuasanpham.php?idsp= <?php echo $_GET['idsp'] ?>" method="POST" enctype="multipart/form-data">
                    <div class="grid-col-4-6">
                        <div>Tên sản phẩm</div>
                        <div><input type="text" name="tensp" required value="<?php echo $row['tensp'] ?>"></div>
                    </div>
                    <div class="grid-col-4-6">
                        <div>Chi tiết sản phẩm</div>
                        <div><textarea name="chitietsp" cols="20" rows="5" required><?php echo $row['chitietsp'] ?></textarea></div>
                    </div>
                    <div class="grid-col-4-6">
                        <div>Giá sản phẩm</div>
                        <div><input type="number" name="giasp" required value="<?php echo $row['giasp'] ?>">(VND)</div>
                    </div>
                    <div class="grid-col-4-6">
                        <div>Hình đại diện</div>
                        <div><input type="file" name="hinhsp"></div>
                    </div>
                    <div class="sub-btn-container">
                        <input type="submit" value="Lưu thay đổi">
                        <input type="reset" value="Mặc định">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>