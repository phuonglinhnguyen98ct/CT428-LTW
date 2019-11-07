<?php
session_start();
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    header('Location: ' . '../../buoi-3/login.html');
}
?>

<!DOCTYPE html>
<html>
<head> 
	<title> Lập trình web (CT428) </title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="../css/style.css" media="screen" />
</head>	

<body>
<div id="wrap">
	<div id="title">
		<h1>Bài 4 - Buổi 4</h1>
	</div> <!--end div title-->
	<div id="menu">
		<!-- chèn menu của sinh viên vào-->
	</div> <!--end div menu-->
	<div id="content">
		<!--Nội dung trang web-->
		<h1>Slide show</h1>
	
		<form>
		<?php
            require '../../buoi-3/php/connect-db.php';
            $sql = 'SELECT * FROM sanpham as sp JOIN thanhvien as tv ON sp.idtv = tv.id WHERE tendangnhap = ?';
            $stmt = $con->prepare($sql);
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $result = $stmt->get_result();

            $productNames = [];

            while($row = $result->fetch_assoc()) {
                array_push($productNames, $row['tensp']);
        ?>
                <div class="image-container">
                    <img src="../../buoi-3<?php echo substr($row['hinhanhsp'], 2)?>">
                </div>
        <?php 
            }
        ?>

			<br/>
			<input type="button" name="previous" value="Previous" onclick="previousSlide()">
			<input type="button" name="next" value="Next" onclick="nextSlide()">
			<br/>

			<select name="productList" id="product-list">
            <?php
                for ($i = 0; $i < count($productNames); $i++) {
            ?>
                    <option value="<?php echo $productNames[$i]?>"><?php echo $productNames[$i]?></option>
            <?php 
                }
            ?>
            </select>
		</form>
		<p>Yêu cầu:<br/>
		Có 4 hình ảnh về máy tính đính kèm, mặc định hiển thị hình máy HP.<br/>
			<ul>
				<li>Khi người dùng nhấn Next thì hiển thị hình tiếp theo (theo thứ tự Hp -> Dell -> Acer -> Asus).</li>
				<li>Khi người dùng nhấp Previous thì hiển thị hình trước đó.</li>
				<li>Cả nút Next và Previous đều hiển thị vòng tròn (nếu đang xem hình HP mà nhấn Previous thì sẽ chuyển sang hình Asus).</li>
				<li>Người dùng có thể chọn xem một hình nào đó từ danh sách bên dưới nút Previous và Next.</li>
				<li>Khi người dùng thay đổi hình bằng cách nhấn Previous hoặc Next thì tên hiển thị bên dưới cũng thay đổi theo.</li>
			</ul>	
		</p>
	</div> <!--end div content-->
	<div id="footer">
		<p>Họ tên SV: Nguyễn Phương Linh<br/> Email: linhb1606998@student.ctu.edu.vn</p>
	</div> <!--end div footer-->
</div> <!--end div wrap-->

<script>
	let productList = document.getElementById('product-list');
	let currentSlideIndex = 0;
	showSlide(0);

	function previousSlide() {
		showSlide(currentSlideIndex-1);
	}

	function nextSlide() {
		showSlide(currentSlideIndex+1);
	}

	function showSlide(n) {
		let images = document.getElementsByClassName("image-container");
		currentSlideIndex = n;
		if (currentSlideIndex < 0) {
			currentSlideIndex = images.length-1;
		}
		if (currentSlideIndex === images.length) {
			currentSlideIndex = 0;
		}
		for (let i = 0; i < images.length; i++) {
			images[i].style.display = 'none';
		}
		images[currentSlideIndex].style.display = 'block';

		// Change selected option
		productList.selectedIndex = currentSlideIndex;
	}

	productList.onchange = () => {
		showSlide(productList.selectedIndex);
	}
</script>
</body>
</html>