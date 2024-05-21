<?php
if(isset($_GET['id_baiviet'])) {
    $id_baiviet = $_GET['id_baiviet'];
} else {
    $id_baiviet = '';
}
?>

<div class="services-breadcrumb">
    <div class="agile_inner_breadcrumb">
        <div class="container">
            <ul class="w3_short">
                <li>
                    <a href="index.php">Trang chủ</a>
                    <i>|</i>
                </li>
                <?php
                $sql_tenbaiviet = mysqli_query($mysqli,"SELECT * FROM tbl_baiviet WHERE baiviet_id='$id_baiviet'");
                $row_tenbaiviet = mysqli_fetch_array($sql_tenbaiviet);
                ?>
                <li><?php echo $row_tenbaiviet['tenbaiviet']; ?></li>
            </ul>
        </div>
    </div>
</div>
<div class="welcome py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
            
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
                <?php echo $row_tenbaiviet['tenbaiviet']; ?>
            </h3>
			<!-- //tittle heading -->
            
			<div class="row">
                <div class="col-lg-12 col-md-12 mt-lg-0 mt-sm-5 mt-4 text-center">
                    <img src="images/<?php echo $row_tenbaiviet['baiviet_image']; ?>" class=" mw-100" alt=" ">
                </div>
				<div class="col-lg-12 col-md-12">
					<p class="my-sm-3 my-2 text-dark"><?php echo $row_tenbaiviet['noidung']; ?></p>
				</div>
			</div><br>
            
		</div>
	</div>