<?php
session_start();
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    header('Location:' . '../login.html');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/thongtincanhan.css">
    <title>Thông tin cá nhân</title>
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
            <h3>
                Chào bạn <?php echo $username ?> !
            </h3>
            <div>
                <?php
                require 'connect-db.php';

                $sql = 'SELECT * FROM thanhvien WHERE tendangnhap = ?';

                $stmt = $con->prepare($sql);
                $stmt->bind_param('s', $username);
                $stmt->execute();

                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $avatar_path = $row['hinhanh'];
                    $gender = $row['gioitinh'];
                    $job = $row['nghenghiep'];
                    $hobby = $row['sothich'];
                }

                $stmt->close();
                $con->close();
                ?>

                <div class="grid-col-4-6">
                    <div class="avatar-container">
                        <img src="<?php echo $avatar_path ?>" alt="avatar" class="avatar">
                    </div>
                    <div class="info">
                        <div>Tên tài khoản: <?php echo $username ?></div>
                        <div>Giới tính: <?php echo $gender ?></div>
                        <div>Nghề nghiệp: <?php echo $job ?></div>
                        <div>Sở thích: <?php echo $hobby ?></div>
                        <div class="logout-btn">
                            <a href="logout.php"><input type="button" value="Đăng xuất"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>