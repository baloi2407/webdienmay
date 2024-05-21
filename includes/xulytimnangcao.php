<?php
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
    $danhmuc = $_GET['danhmuc'];
    $gia = $_GET['gia'];
    $tensanpham = $_GET['tensanpham'];
    if($danhmuc == '' && $gia == '' && $tensanpham == '') {
        $gia = '';
        $sql = "SELECT * FROM tbl_sanpham ORDER BY sanpham_id DESC LIMIT $begin,5";
        $sql_sanpham = mysqli_query($mysqli,$sql);
    } 
    elseif($danhmuc != '' && $gia == '' && $tensanpham == '') {
        $sql = "SELECT * FROM tbl_sanpham WHERE tbl_sanpham.danhmuc_id='$danhmuc' ORDER BY sanpham_id DESC LIMIT $begin,5";
        $sql_sanpham = mysqli_query($mysqli,$sql);
    } 
    elseif($gia != '' && $danhmuc == '' && $tensanpham == '') {
        if($gia == 2) {
            $sql = "SELECT * FROM tbl_sanpham WHERE tbl_sanpham.sanpham_gia > 10000000 LIMIT $begin,5";
        } else {
            $sql = "SELECT * FROM tbl_sanpham WHERE tbl_sanpham.sanpham_gia <= $gia LIMIT $begin,5";
        }
        $sql_sanpham = mysqli_query($mysqli,$sql);
    } 
    elseif($gia != '' && $danhmuc != '' && $tensanpham == '') {
        if($gia == 2) {
            $sql = "SELECT * FROM tbl_sanpham WHERE tbl_sanpham.sanpham_gia > 10000000 AND tbl_sanpham.danhmuc_id='$danhmuc' LIMIT $begin,5";
        } else {
            $sql = "SELECT * FROM tbl_sanpham WHERE tbl_sanpham.sanpham_gia <= $gia AND tbl_sanpham.danhmuc_id='$danhmuc' LIMIT $begin,5";
        }
        $sql_sanpham = mysqli_query($mysqli,$sql);
    } 
    elseif($tensanpham != '' && $gia == '' && $danhmuc == '') {
        $sql = "SELECT * FROM tbl_sanpham WHERE tbl_sanpham.sanpham_name LIKE '%$tensanpham%' LIMIT $begin,5";
        $sql_sanpham = mysqli_query($mysqli,$sql);
    } 
    elseif($tensanpham != '' && $gia != '' && $danhmuc == '') {
        $sql = "SELECT * FROM tbl_sanpham WHERE tbl_sanpham.sanpham_name LIKE '%$tensanpham%' AND tbl_sanpham.sanpham_gia <= $gia LIMIT $begin,5";
        $sql_sanpham = mysqli_query($mysqli,$sql);
    } 
    elseif($tensanpham != '' && $danhmuc != '' && $gia == '') {
        $sql = "SELECT * FROM tbl_sanpham WHERE tbl_sanpham.sanpham_name LIKE '%$tensanpham%' AND tbl_sanpham.danhmuc_id='$danhmuc' LIMIT $begin,5";
        $sql_sanpham = mysqli_query($mysqli,$sql);
    } 
    else {
        if($gia == 2) {
            $sql = "SELECT * FROM tbl_sanpham WHERE tbl_sanpham.danhmuc_id='$danhmuc' AND  tbl_sanpham.sanpham_name LIKE '%$tensanpham%'
        AND tbl_sanpham.sanpham_gia > 10000000 LIMIT $begin,5";
        } else {
        $sql = "SELECT * FROM tbl_sanpham WHERE tbl_sanpham.danhmuc_id='$danhmuc' AND  tbl_sanpham.sanpham_name LIKE '%$tensanpham%'
        AND tbl_sanpham.sanpham_gia <= $gia LIMIT $begin,5";
        }
        $sql_sanpham = mysqli_query($mysqli,$sql);
    }
    ?>
    <div class="ads-grid py-sm-5 py-4">
        <div class="container py-xl-4 py-lg-2">
            <!-- tittle heading -->
            <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3"></h3>
            <!-- //tittle heading -->
            <div class="row">
                <!-- product left -->
                <div class="agileinfo-ads-display col-lg-9">
                    <div class="wrapper">
                        <!-- first section -->
                        <div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
                            <div class="row">
                                <?php
                                while($row_sanpham = mysqli_fetch_array($sql_sanpham)) {
                                    if($row_sanpham['sanpham_giakhuyenmai']==0) {
                                        $gia_ = $row_sanpham['sanpham_gia'];
                                    } else {
                                        $gia_ = $row_sanpham['sanpham_gia'] - (($row_sanpham['sanpham_gia']*$row_sanpham['sanpham_giakhuyenmai'])/100);
                                    }
                                ?>
                                <div class="col-md-4 product-men mb-5">
                                    <div class="men-pro-item simpleCart_shelfItem">
                                        <div class="men-thumb-item text-center" style="min-height:134px !important">
                                            <img src="../images/<?php echo $row_sanpham['sanpham_image']; ?>" alt="" style="max-width:200px !important;max-height:200px !important">
                                            <div class="men-cart-pro">
                                                <div class="inner-men-cart-pro">
                                                    <a href="../index.php?quanly=chitietsp&id=<?php echo $row_sanpham['sanpham_id']; ?>" class="link-product-add-cart">Xem chi tiết</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item-info-product text-center border-top mt-4">
                                            <h4 class="pt-1 text-truncate">
                                                <a href="../index.php?quanly=chitietsp&id=<?php echo $row_sanpham['sanpham_id']; ?>"><?php echo $row_sanpham['sanpham_name']; ?></a>
                                            </h4>
                                            <div class="info-product-price my-2">
                                                <span class="item_price"><?php echo number_format($gia_).'vnđ'; ?></span>
                                                <br>
                                                <del><?php
                                                if($row_sanpham['sanpham_giakhuyenmai']==0) echo '';
                                                else echo number_format($row_sanpham['sanpham_gia']).'vnđ'; 
                                                ?></del>
                                            </div>
                                            <div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
                                                <form action="../index.php?quanly=giohang" method="POST">
                                                    <fieldset>
                                                        <input type="hidden" name="tensanpham" value="<?php echo $row_sanpham['sanpham_name']; ?>" />
                                                        <input type="hidden" name="sanpham_id" value="<?php echo $row_sanpham['sanpham_id']; ?>" />
                                                        <input type="hidden" name="giasanpham" value="<?php echo $gia_; ?>" />
                                                        <input type="hidden" name="hinhanh" value="<?php echo $row_sanpham['sanpham_image']; ?>" />
                                                        <input type="hidden" name="soluong" value="1" />
                                                        <input type="submit" name="themgiohang" value="Thêm vào giỏ hàng" class="button btn" />
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
                            <?php
                            if($danhmuc == '' && $gia == '' && $tensanpham == '') {
                                $gia = '';
                                $sql_select = "SELECT * FROM tbl_sanpham ORDER BY sanpham_id DESC";
                                $sql_trang = mysqli_query($mysqli,$sql_select);
                            } 
                            elseif($danhmuc != '' && $gia == '' && $tensanpham == '') {
                                $sql_select = "SELECT * FROM tbl_sanpham WHERE tbl_sanpham.danhmuc_id='$danhmuc' ORDER BY sanpham_id DESC";
                                $sql_trang = mysqli_query($mysqli,$sql_select);
                            } 
                            elseif($gia != '' && $danhmuc == '' && $tensanpham == '') {
                                if($gia == 2) {
                                    $sql_select = "SELECT * FROM tbl_sanpham WHERE tbl_sanpham.sanpham_gia > 10000000";
                                } else {
                                    $sql_select = "SELECT * FROM tbl_sanpham WHERE tbl_sanpham.sanpham_gia <= $gia";
                                }
                                $sql_trang = mysqli_query($mysqli,$sql_select);
                            } 
                            elseif($gia != '' && $danhmuc != '' && $tensanpham == '') {
                                if($gia == 2) {
                                    $sql_select = "SELECT * FROM tbl_sanpham WHERE tbl_sanpham.sanpham_gia > 10000000 AND tbl_sanpham.danhmuc_id='$danhmuc'";
                                } else {
                                    $sql_select = "SELECT * FROM tbl_sanpham WHERE tbl_sanpham.sanpham_gia <= $gia AND tbl_sanpham.danhmuc_id='$danhmuc'";
                                }
                                $sql_trang = mysqli_query($mysqli,$sql_select);
                            } 
                            elseif($tensanpham != '' && $gia == '' && $danhmuc == '') {
                                $sql_select = "SELECT * FROM tbl_sanpham WHERE tbl_sanpham.sanpham_name LIKE '%$tensanpham%'";
                                $sql_trang = mysqli_query($mysqli,$sql_select);
                            } 
                            elseif($tensanpham != '' && $gia != '' && $danhmuc == '') {
                                $sql_select = "SELECT * FROM tbl_sanpham WHERE tbl_sanpham.sanpham_name LIKE '%$tensanpham%' AND tbl_sanpham.sanpham_gia <= $gia";
                                $sql_trang = mysqli_query($mysqli,$sql_select);
                            } 
                            elseif($tensanpham != '' && $danhmuc != '' && $gia == '') {
                                $sql_select = "SELECT * FROM tbl_sanpham WHERE tbl_sanpham.sanpham_name LIKE '%$tensanpham%' AND tbl_sanpham.danhmuc_id='$danhmuc'";
                                $sql_trang = mysqli_query($mysqli,$sql_select);
                            } 
                            else {
                                if($gia == 2) {
                                    $sql_select = "SELECT * FROM tbl_sanpham WHERE tbl_sanpham.danhmuc_id='$danhmuc' AND  tbl_sanpham.sanpham_name LIKE '%$tensanpham%'
                                AND tbl_sanpham.sanpham_gia > 10000000";
                                } else {
                                $sql_select = "SELECT * FROM tbl_sanpham WHERE tbl_sanpham.danhmuc_id='$danhmuc' AND  tbl_sanpham.sanpham_name LIKE '%$tensanpham%'
                                AND tbl_sanpham.sanpham_gia <= $gia";
                                }
                                $sql_trang = mysqli_query($mysqli,$sql_select);
                            }
                            $row_count = mysqli_num_rows($sql_trang);
                            $trang = ceil($row_count/5);
                            ?>
                            <?php
                            if($trang>1) {
                                ?>
                                <nav aria-label="Page navigation example" class="mx-auto" style="width:300px;">
                                    <ul class="pagination">
                                        <li class="page-item">
                                        <a class="page-link" 
                                        href="http://localhost/webdienmay2/includes/timnangcao.php?tensanpham=<?php 
                                        if(isset($tensanpham)) echo $tensanpham; ?>&danhmuc=<?php 
                                        if(isset($danhmuc)) echo $danhmuc; ?>&gia=<?php 
                                        if(isset($gia)) echo $gia; ?>&trang=<?php $trang_previous = $trang_active-1; if($trang_previous>1) echo $trang_previous; else echo 1; ?>" aria-label="">
                                            <span aria-hidden="true">&laquo;</span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        </li>
                                        <?php
                                        for($i=1;$i<=$trang;$i++) {
                                        ?>
                                        <li class="page-item <?php if($trang_active==$i) echo 'active'; ?>">
                                        <a class="page-link" 
                                        href="http://localhost/webdienmay2/includes/timnangcao.php?tensanpham=<?php 
                                        if(isset($tensanpham)) echo $tensanpham; ?>&danhmuc=<?php 
                                        if(isset($danhmuc)) echo $danhmuc; ?>&gia=<?php if(isset($gia)) echo $gia; ?>&trang=<?php echo $i; ?>">
                                            <?php echo $i; ?>
                                            </a>
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        <li class="page-item">
                                        <a class="page-link" 
                                        href="http://localhost/webdienmay2/includes/timnangcao.php?tensanpham=<?php 
                                        if(isset($tensanpham)) echo $tensanpham; ?>&danhmuc=<?php 
                                        if(isset($danhmuc)) echo $danhmuc; ?>&gia=<?php 
                                        if(isset($gia)) echo $gia; ?>&trang=<?php $trang_next = $trang_active+1; if($trang_next<=$trang) echo $trang_next; else echo $trang; ?>">
                                            <span aria-hidden="true">&raquo;</span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                        </li>
                                    </ul>
                                </nav>
                                <?php
                            }
                            ?>
                        </div>
                        <!-- //first section -->
                    </div>
                </div>
                <!-- //product left -->
                <!-- product right -->
                <div class="col-lg-3 mt-lg-0 mt-4 p-lg-0">
                    <div class="side-bar p-sm-4 p-3">
                        <div class=" border-bottom py-2">
                            <h3 class="agileits-sear-head mb-3">Tìm kiếm nâng cao</h3>
                            <form action="" method="get">
                                <input type="text" name="tensanpham" class="form-control" placeholder="Tên sản phẩm">
                                <br>
                                <?php
                                $sql_danhmuc = mysqli_query($mysqli,"SELECT * FROM tbl_danhmuc ORDER BY danhmuc_id DESC");
                                ?>
                                <select name="danhmuc" class="form-control" >
                                    <option value="">--Chọn danh mục--</option>
                                    <?php
                                    while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)) {
                                    ?>
                                    <option value="<?php echo $row_danhmuc['danhmuc_id']; ?>"><?php echo $row_danhmuc['danhmuc_ten']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <br>
                                <select name="gia" class="form-control" >
                                    <option value="">--Chọn gía--</option>
                                    <option value="1000000">Dưới 1 triệu</option>
                                    <option value="5000000">Dưới 5 triệu</option>
                                    <option value="10000000">Dưới 10 triệu</option>
                                    <option value="2">Trên 10 triệu</option>
                                </select>
                                <br>
                                <input type="submit" value="Tìm kiếm" class="btn btn-primary">
                            </form>
                            
                        </div>
                        <!-- //price -->
                        
                        <!-- //arrivals -->
                    </div>
                    <!-- //product right -->
                </div>
            </div>
        </div>
    </div>
    <?php
?>
