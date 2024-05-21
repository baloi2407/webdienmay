<!-- top Products -->
<div class="ads-grid py-sm-5 py-4">
    <div class="container py-xl-4 py-lg-2">
        <!-- tittle heading -->
        <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
            Danh mục sản phẩm
        </h3>
        <!-- //tittle heading -->
        <div class="row">
            <!-- product left -->
            <div class="agileinfo-ads-display col-lg-9 col-lg-12">
                <div class="wrapper">
                    <!-- first section -->
                    <?php
                    $sql_danhmuc_sanpham = mysqli_query($mysqli,"SELECT * FROM tbl_danhmuc ORDER BY danhmuc_id DESC");
                    while($row_danhmuc_sanpham = mysqli_fetch_array($sql_danhmuc_sanpham)) {
                    ?>
                    <div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
                        <h3 class="heading-tittle text-center font-italic">
                            <?php echo $row_danhmuc_sanpham['danhmuc_ten']; ?></h3>
                        <div class="row">
                            <?php
                            $danhmuc_id = $row_danhmuc_sanpham['danhmuc_id'];
                            $sql_sanpham = mysqli_query($mysqli,"SELECT * FROM tbl_sanpham WHERE danhmuc_id='$danhmuc_id' ORDER BY RAND() LIMIT 3");
                            while($row_sanpham = mysqli_fetch_array($sql_sanpham)) {
                                if($row_sanpham['sanpham_giakhuyenmai']==0) {
                                    $gia = $row_sanpham['sanpham_gia'];
                                } else {
                                    $gia = $row_sanpham['sanpham_gia'] - (($row_sanpham['sanpham_gia']*$row_sanpham['sanpham_giakhuyenmai'])/100);
                                }
                            ?>
                            <div class="col-md-4 product-men mt-5">
                                <div class="men-pro-item simpleCart_shelfItem">
                                    <div class="men-thumb-item text-center" style="min-height:134px !important">
                                        <img src="images/<?php echo $row_sanpham['sanpham_image']; ?>" alt="" style="max-width:200px !important;max-height:200px !important">
                                        <div class="men-cart-pro">
                                            <div class="inner-men-cart-pro">
                                                <a href="./index.php?quanly=chitietsp&id=<?php echo $row_sanpham['sanpham_id']; ?>"
                                                    class="link-product-add-cart">Xem chi tiết</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item-info-product text-center border-top mt-4">
                                        <h4 class="pt-1 text-truncate">
                                            <a class=""
                                                href="./index.php?quanly=chitietsp&id=<?php echo $row_sanpham['sanpham_id']; ?>" >
                                                <?php echo $row_sanpham['sanpham_name']; ?></a>

                                        </h4>
                                        <div class="info-product-price my-2">
                                            <span
                                                class="item_price"><?php echo number_format($gia).'vnđ'; ?></span>
                                            <del><?php
                                                if($row_sanpham['sanpham_giakhuyenmai']==0) echo '';
                                                else echo number_format($row_sanpham['sanpham_gia']).'vnđ'; 
                                             ?>
                                             </del>
                                        </div>
                                        <div
                                            class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
                                            <form action="./index.php?quanly=giohang" method="POST">
                                                <fieldset>
                                                    <input type="hidden" name="tensanpham"
                                                        value="<?php echo $row_sanpham['sanpham_name']; ?>" />
                                                    <input type="hidden" name="sanpham_id"
                                                        value="<?php echo $row_sanpham['sanpham_id']; ?>" />
                                                    <input type="hidden" name="giasanpham"
                                                        value="<?php echo $gia; ?>" />
                                                    <input type="hidden" name="hinhanh"
                                                        value="<?php echo $row_sanpham['sanpham_image']; ?>" />
                                                    <input type="hidden" name="soluong" value="1" />
                                                    <?php
                                                    if($row_sanpham['sanpham_soluong'] < 1) {
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
                            <?php
                            }
                            ?>
                        </div>
                        <div class="mt-5 ml-5">
                            <a href="index.php?quanly=danhmuc&id=<?=$row_danhmuc_sanpham['danhmuc_id'];?>">Xem thêm</a>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                    <!-- //first section -->
                </div>
            </div>
            <!-- //product left -->

            <!-- product right -->

        </div>
    </div>
</div>
<!-- //top products -->
<script>
function btnHetHang() {
    alert('Hết hàng');

}
</script>