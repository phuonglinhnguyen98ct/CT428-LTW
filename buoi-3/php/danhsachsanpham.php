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
                <div class="product-search-container">
                    Tìm kiếm sản phẩm:
                    <input type="text" name="productName" onkeyup="searchProduct(this.value)">
                </div>

                <div>Danh sách sản phẩm của bạn là:</div>
                <div id="product-table-container">
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
                                <td><p id="show-product-detail" onclick="showProductDetail(<?php echo $row['idsp'] ?>)">Xem chi tiết</p></td>
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
                </div>

                <div id="product-detail-container"></div>

                <div class="logout-btn">
                    <a href="logout.php"><input type="button" value="Đăng xuất"></a>
                </div>
            </div>
        </div>
    </div>

    <div id="dark-layer"></div>

    <script>
        function searchProduct(productName) {
            let xhttp = new XMLHttpRequest();

            let product_table_container = document.getElementById('product-table-container');

            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    product_table_container.innerHTML = this.responseText;
                }
            };

            xhttp.open("GET", "./searchproduct.php?productName=" + productName, true);
            xhttp.send();
        }

        function popUpImg() {
            document.getElementById('dark-layer').style.display = 'block';
        }

        function normalImg() {
            document.getElementById('dark-layer').style.display = 'none';
        }

        function showProductDetail(idsp) {
            let xhttp = new XMLHttpRequest();

            xhttp.onreadystatechange = function() {
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                    document.getElementById('product-detail-container').innerHTML = xhttp.responseText;
                }
            }

            xhttp.open('GET', './productdetail-ajax.php?idsp=' + idsp, true);
            xhttp.send();
        }
    </script>
</body>

</html>