<?php
session_start();
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    header('Location: ' . '../login.html');
}

require './connect-db.php';

echo '<table>';
echo '<tr>';
echo '<th>STT</th>';
echo '<th>Tên sản phẩm</th>';
echo '<th>Giá sản phẩm</th>';
echo '<th colspan="3">Lựa chọn</th>';
echo '</tr>';

$product_name = '%' . $_GET['productName'] . '%';

$sql = 'SELECT * FROM sanpham as sp JOIN thanhvien as tv ON sp.idtv = tv.id WHERE tendangnhap = ? AND tensp LIKE ?';
$stmt = $con->prepare($sql);

$stmt->bind_param('ss', $username, $product_name);
$stmt->execute();
$result = $stmt->get_result();

$i = 1;
while ($row = $result->fetch_assoc()) {
    echo '<tr>';
    echo '<td>' . $i . '</td>';
    echo '<td>' . $row['tensp'] . '</td>';
    echo '<td>' . $row['giasp'] . ' (VND)</td>';
    echo '<td><p id="show-product-detail" onclick="showProductDetail(' . $row['idsp'] . ')">Xem chi tiết</p></td>';
    echo '<td><a href="suasanpham.php?idsp=' . $row['idsp'] . '"><img src="../img/icon/edit.png" alt="icon-edit"></a></td>';
    echo '<td><a href="xoasanpham.php?idsp=' . $row['idsp'] . '"><img src="../img/icon/delete.png" alt="icon-delete"></a></td>';
    echo '</tr>';
    $i++;
}

$stmt->close();
$con->close();

echo '</table>';
