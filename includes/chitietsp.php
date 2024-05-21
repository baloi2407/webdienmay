<?php
if(isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = '';
} 
$sql_chitiet = mysqli_query($mysqli,"SELECT * FROM tbl_sanpham,tbl_danhmuc WHERE sanpham_id='$id' ");
$row_chitiet = mysqli_fetch_array($sql_chitiet);
if($row_chitiet['sanpham_giakhuyenmai']==0) {
    $gia = $row_chitiet['sanpham_gia'];
} else {
    $gia = $row_chitiet['sanpham_gia'] - (($row_chitiet['sanpham_gia']*$row_chitiet['sanpham_giakhuyenmai'])/100);
}
?>

<!-- page -->
<div class="services-breadcrumb">
    <div class="agile_inner_breadcrumb">
        <div class="container">
            <ul class="w3_short">
                <li>
                    <a href="index.php">Trang chủ</a>
                    <i>|</i>
                </li>
                <li><?php echo $row_chitiet['danhmuc_ten']; ?></li>
            </ul>
        </div>
    </div>
</div>
<!-- //page -->

<!-- Single Page -->
<div class="banner-bootom-w3-agileits py-5">
    <div class="container py-xl-4 py-lg-2">
        <div class="row">
            <div class="col-lg-5 col-md-8 single-right-left ">
                <div class="grid images_3_of_2">
                    <div class="flexslider">
                        <ul class="slides">
                            <li data-thumb="">
                                <div class="thumb-image">
                                    <img style="width:200px;margin:0 auto;" src="images/<?php echo $row_chitiet['sanpham_image']; ?>" data-imagezoom="" class="img-fluid" alt=""> </div>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 single-right-left simpleCart_shelfItem">
                <h3 class="mb-3"><?php echo $row_chitiet['sanpham_name']; ?></h3>
                <p class="mb-3">
                    <span class="item_price"><?php echo number_format($gia).'vnđ'; ?></span>
                    <del class="mx-2 font-weight-light"><?php if($row_chitiet['sanpham_giakhuyenmai']==0) echo ''; 
                    else echo number_format($row_chitiet['sanpham_gia']).'vnđ'; ?></del>
                </p>
                <div class="single-infoagile">
                    <ul>
                        <li class="mb-3">
                            <?php echo $row_chitiet['sanpham_mota']; ?>
                        </li>
                    </ul>
                </div>
                <div class="product-single-w3l">
                    
                    <ul>
                        <li class="mb-1">
                            <?php echo $row_chitiet['sanpham_chitiet']; ?>
                        </li>
                    </ul>
                </div>
                <div class="occasion-cart mt-5">
                    <div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
                        <form action="./index.php?quanly=giohang" method="POST">
                            <fieldset>
                                <input type="hidden" name="tensanpham" value="<?php echo $row_chitiet['sanpham_name']; ?>" />
                                <input type="hidden" name="sanpham_id" value="<?php echo $row_chitiet['sanpham_id']; ?>" />
                                <input type="hidden" name="giasanpham" value="<?php echo $gia; ?>" />
                                <input type="hidden" name="hinhanh" value="<?php echo $row_chitiet['sanpham_image']; ?>" />
                                <input type="hidden" name="soluong" value="1" />
                                <?php
                                    if($row_chitiet['sanpham_soluong'] == 0) {
                                        ?>
                                    <input type="button" value="Hết hàng" class="btn btn-danger"
                                        onclick="btnHetHang()" />
                                    <?php
                                    } 
                                    else {
                                        ?>
                                        <?php
                                        if(isset($_SESSION['login_user'])) {
                                            ?>
                                            <input type="submit" name="themgiohang" value="Thêm vào giỏ hàng"
                                                class="btn btn-primary" />
                                            <?php
                                        } else {
                                            ?>
                                            <input type="button" onclick="toLogin()" value="Thêm vào giỏ hàng"
                                                class="btn btn-primary" />
                                            <?php
                                        }
                                        ?>
                                    <?php
                                    }
                                ?>

                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- //Single Page -->