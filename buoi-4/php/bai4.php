<?php
session_start();
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    header('Location: ' . '../../buoi-3/login.html');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/bai2.css">
    <title>Images from database</title>
</head>

<body>
    <div class="container">
        <?php
            require './connect-db.php';
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
        <div>
            <input type="button" value="Previous" onclick="previousSlide()">
            <input type="button" value="Next" onclick="nextSlide()">
        </div>
        <div>
            <select name="productList" id="product-list">
            <?php
                for ($i = 0; $i < count($productNames); $i++) {
            ?>
                    <option value="<?php echo $productNames[$i]?>"><?php echo $productNames[$i]?></option>
            <?php 
                }
            ?>
            </select>
        </div>
    </div>

    <script>
        let productList = document.getElementById('product-list');
        let currentSlideIndex = 0;
        showSlide(0);

        function previousSlide() {
            showSlide(currentSlideIndex - 1);
        }

        function nextSlide() {
            showSlide(currentSlideIndex + 1);
        }

        /* 
        Show the slide n
        n begin from 0
        */
        function showSlide(n) {
            let images = document.getElementsByClassName("image-container");
            currentSlideIndex = n;
            if (currentSlideIndex < 0) {
                currentSlideIndex = images.length - 1;
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