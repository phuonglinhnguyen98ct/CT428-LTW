<?php
session_start();
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    header('Location: ' . '../login.html');
}

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

echo '<div class="grid-col-4-6">';
    echo '<div>Chi tiết sản phẩm</div>';
    echo '<div><textarea name="chitietsp" cols="30" rows="8" readonly>' . $row['chitietsp'] . '</textarea></div>';
echo '</div>';

echo '<div class="grid-col-4-6">';
    echo '<div>Hình ảnh sản phẩm</div>';
    echo '<div><img src="' . $row['hinhanhsp'] . '" alt="hinhsp" id="product-img" onmouseover="popUpImg()" onmouseout="normalImg()"></div>';
echo '</div>';
