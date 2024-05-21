<?php
if(isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = '';
}
if(isset($_GET['trang'])) {
    $trang_active = $_GET['trang'];
} else {
    $trang_active = '1';
}
if($trang_active == '' || $trang_active == 1) {
    $begin = 0;
} else {
    $begin = ($trang_active*5)-5;
}
if(isset($_GET['thapdencao'])) {
    $sql_cate = mysqli_query($mysqli,"SELECT * FROM tbl_danhmuc,tbl_sanpham WHERE tbl_danhmuc.danhmuc_id=tbl_sanpham.danhmuc_id
    AND tbl_sanpham.danhmuc_id='$id' ORDER BY tbl_sanpham.sanpham_gia DESC LIMIT $begin,5");
} elseif(isset($_GET['cunhat'])) {
    $sql_cate = mysqli_query($mysqli,"SELECT * FROM tbl_danhmuc,tbl_sanpham WHERE tbl_danhmuc.danhmuc_id=tbl_sanpham.danhmuc_id
    AND tbl_sanpham.danhmuc_id='$id' ORDER BY tbl_sanpham.sanpham_id ASC LIMIT $begin,5");
} elseif(isset($_GET['nhieunhat'])) {
    $sql_cate = mysqli_query($mysqli,"SELECT * FROM tbl_danhmuc,tbl_sanpham WHERE tbl_danhmuc.danhmuc_id=tbl_sanpham.danhmuc_id
    AND tbl_sanpham.danhmuc_id='$id' ORDER BY tbl_sanpham.luotmua DESC LIMIT $begin,5");
} else {
    $sql_cate = mysqli_query($mysqli,"SELECT * FROM tbl_danhmuc,tbl_sanpham WHERE tbl_danhmuc.danhmuc_id=tbl_sanpham.danhmuc_id
    AND tbl_sanpham.danhmuc_id='$id' ORDER BY tbl_sanpham.sanpham_id DESC LIMIT $begin,5");
}
$sql_title = mysqli_query($mysqli,"SELECT * FROM tbl_danhmuc,tbl_sanpham WHERE tbl_danhmuc.danhmuc_id=tbl_sanpham.danhmuc_id
AND tbl_sanpham.danhmuc_id='$id' ORDER BY tbl_sanpham.sanpham_id DESC");
$row_title = mysqli_fetch_array($sql_title);
?>
<!-- top Products -->
<div class="ads-grid py-sm-5 py-4">
    <div class="container py-xl-4 py-lg-2">
        <!-- tittle heading -->
        <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3"><?php echo $row_title['danhmuc_ten']; ?></h3>
        <!-- //tittle heading -->
        <div class="row">
            <!-- product left -->
            <div class="agileinfo-ads-display col-lg-12">
                <div class="wrapper">
                    <!-- first section -->
                    
                    <a href="./index.php?quanly=danhmuc&id=<?= $id; ?>&cunhat">
                        <button type="button" class="btn <?php if(isset($_GET['cunhat'])) echo 'btn-primary'; ?> mb-3 d-inline">Cũ nhất</button>
                    </a>
                    <a href="./index.php?quanly=danhmuc&id=<?= $id; ?>&nhieunhat">
                        <button type="button" class="btn <?php if(isset($_GET['nhieunhat'])) echo 'btn-primary'; ?> mb-3 d-inline">Mua nhiều nhất</button>
                    </a>
                    <div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
                        <div class="row">
                            <?php
                            while($row_cate = mysqli_fetch_array($sql_cate)) {
                                if($row_cate['sanpham_giakhuyenmai']==0) {
                                    $gia = $row_cate['sanpham_gia'];
                                } else {
                                    $gia = $row_cate['sanpham_gia'] - (($row_cate['sanpham_gia']*$row_cate['sanpham_giakhuyenmai'])/100);
                                }
                            ?>
                            <div class="col-md-4 product-men mb-5">
                                <div class="men-pro-item simpleCart_shelfItem">
                                    <div class="men-thumb-item text-center" style="min-height:134px !important">
                                        <img src="images/<?php echo $row_cate['sanpham_image']; ?>" alt="" style="max-width:200px !important;max-height:200px !important;">
                                        <div class="men-cart-pro">
                                            <div class="inner-men-cart-pro">
                                                <a href="./index.php?quanly=chitietsp&id=<?php echo $row_cate['sanpham_id']; ?>"
                                                    class="link-product-add-cart">Xem chi tiết</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item-info-product text-center border-top mt-4">
                                        <h4 class="pt-1 text-truncate">
                                            <a
                                                href="./index.php?quanly=chitietsp&id=<?php echo $row_cate['sanpham_id']; ?>"><?php echo $row_cate['sanpham_name']; ?></a>
                                        </h4>
                                        <div class="info-product-price my-2">
                                            <span
                                                class="item_price"><?php echo number_format($gia).'vnđ'; ?></span>
                                            <del><?php
                                                if($row_cate['sanpham_giakhuyenmai']==0) echo '';
                                                else echo number_format($row_cate['sanpham_gia']).'vnđ'; 
                                             ?></del>
                                        </div>
                                        <div
                                            class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
                                            <form action="./index.php?quanly=giohang" method="POST">
                                                <fieldset>
                                                    <input type="hidden" name="tensanpham"
                                                        value="<?php echo $row_cate['sanpham_name']; ?>" />
                                                    <input type="hidden" name="sanpham_id"
                                                        value="<?php echo $row_cate['sanpham_id']; ?>" />
                                                    <input type="hidden" name="giasanpham"
                                                        value="<?php echo $gia; ?>" />
                                                    <input type="hidden" name="hinhanh"
                                                        value="<?php echo $row_cate['sanpham_image']; ?>" />
                                                    <input type="hidden" name="soluong" value="1" />
                                                    <?php
                                                    if($row_cate['sanpham_soluong'] == 0) {
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
                    </div>
                    <!-- //first section -->
                </div>
            </div>
            <!-- //product left -->
            <!-- product right -->

        </div>
        
        <nav aria-label="Page navigation example" class="mx-auto" style="width:300px;">
        <?php
        $sql_trang = mysqli_query($mysqli,"SELECT * FROM tbl_sanpham WHERE danhmuc_id='$id'");
        $row_count = mysqli_num_rows($sql_trang);
        $trang = ceil($row_count/5);
        if($trang > 1) {
        ?>
            <ul class="pagination">
                <li class="page-item">
                <a class="page-link" 
                href="index.php?quanly=danhmuc&id=<?php echo 
                $id; ?><?php if(isset($_GET['cunhat'])) echo '&cunhat';?><?php if(isset($_GET['nhieunhat'])) echo '&nhieunhat';?>&trang=<?php 
                $trang_previous = $trang_active-1; if($trang_previous>1) echo $trang_previous; else echo 1; ?>" aria-label="">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
                </li>
                <?php
                for($i=1;$i<=$trang;$i++) {
                ?>
                <li class="page-item <?php if($trang_active==$i) echo 'active'; ?>">
                <a class="page-link" 
                href="index.php?quanly=danhmuc&id=<?php echo 
                $id; ?><?php if(isset($_GET['cunhat'])) echo '&cunhat';?><?php if(isset($_GET['nhieunhat'])) echo '&nhieunhat';?>&trang=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php
                }
                ?>
                <li class="page-item">
                <a class="page-link" 
                href="index.php?quanly=danhmuc&id=<?php echo 
                $id; ?><?php if(isset($_GET['cunhat'])) echo '&cunhat';?><?php if(isset($_GET['nhieunhat'])) echo '&nhieunhat';?>&trang=<?php 
                $trang_next = $trang_active+1; if($trang_next<=$trang) echo $trang_next; else echo $trang; ?>">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
                </li>
            </ul>
            <?php
        }
            ?>
        </nav>
    </div>
</div>
<!-- //top products -->