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
    <link rel="stylesheet" href="../css/themsanpham.css">
    <title>Thêm sản phẩm</title>
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <div class="menu-container">
                <a href="./thongtincanhan.php">Thông tin cá nhân</a> |
                <a href="./danhsachsanpham.php">Danh sách sản phẩm</a> |
                <a href="./themsanpham.php">Thêm sản phẩm</a> |
                <a href="../../buoi-4/php/bai4.php">Bài 2 (Buổi 4)</a>
            </div>
            <h3>Thêm sản phẩm mới</h3>
            <div class="align-center">Vui lòng điền đầy đủ thông tin bên dưới để thêm sản phẩm mới</div>
            <div class="add-product-form">
                <form action="./xulythemsanpham.php" method="POST" enctype="multipart/form-data">
                    <div class="grid-col-4-6">
                        <div>Tên sản phẩm</div>
                        <div><input type="text" name="tensp" required></div>
                    </div>
                    <div class="grid-col-4-6">
                        <div>Chi tiết sản phẩm</div>
                        <div><textarea name="chitietsp" cols="20" rows="5" required></textarea></div>
                    </div>
                    <div class="grid-col-4-6">
                        <div>Giá sản phẩm</div>
                        <div><input type="number" name="giasp" required> (VND)</div>
                    </div>
                    <div class="grid-col-4-6">
                        <div>Hình đại diện</div>
                        <div><input type="file" name="hinhsp" required></div>
                    </div>
                    <div class="sub-btn-container">
                        <input type="submit" value="Lưu sản phẩm">
                        <input type="reset" value="Làm lại">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>