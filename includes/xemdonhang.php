<?php
    $huydon = '';
    $mahang = '';
    if(isset($_GET['huydon']) && isset($_GET['mahang'])) {
        $huydon = $_GET['huydon'];
        $mahang = $_GET['mahang'];
        $id = $_SESSION['login_id'];
        $sql_update_donhang = mysqli_query($mysqli,"UPDATE tbl_donhang SET huydon='$huydon' WHERE mahang='$mahang' AND user_id='$id'");
        echo "<script>document.location='index.php?quanly=xemdonhang&user={$id}'</script>";
    } else {
    }
?>
<!-- top Products -->
<div class="ads-grid py-sm-5 py-4">
    <div class="container py-xl-4 py-lg-2">
        <!-- tittle heading -->
        <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">Xem đơn hàng</h3>
        <!-- //tittle heading -->
        <div class="row">
            <!-- product left -->
            <div class="agileinfo-ads-display col-lg-12">
                <div class="wrapper">
                    <!-- first section -->
                    <div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
                        <div class="row">
                            <?php
                            if(isset($_SESSION['login_user'])) {
                                echo 'Đơn hàng của: '.$_SESSION['login_hoten'];
                            }
                            ?>
                            <div class="col-md-12">
                                <?php 
                                if(isset($_GET['user'])) {
                                    $id= $_GET['user'];
                                } else {
                                    $id= '';
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
                                $sql_select = mysqli_query($mysqli,"SELECT * FROM tbl_donhang
                                WHERE user_id='$id'
                                ORDER BY mahang DESC LIMIT $begin,5");
                                ?>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Thứ tự</th>
                                        <th>Mã đơn hàng</th>
                                        <th>Ngày tháng</th>
                                        <th>Quản lý </th>
                                        <th>Tình trạng</th>
                                        <th>Huỷ đơn</th>
                                    </tr>
                                    <?php
                                    $i = 0;
                                    while($row_donhang = mysqli_fetch_array($sql_select)) {
                                        $i++;
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $row_donhang['mahang']; ?></td>
                                        <td><?php echo $row_donhang['ngaythang']; ?></td>
                                        <td>
                                            <a 
                                            href="index.php?quanly=xemdonhang&user=<?php echo $_SESSION['login_id']; ?>
                                            &mahang=<?php echo $row_donhang['mahang']; ?>">
                                            Xem chi tiết
                                            </a>        
                                        </td>
                                        <td>
                                            <?php
                                            if($row_donhang['tinhtrang'] == 0) {
                                                echo 'Đã mua hàng';
                                            } else {
                                                echo 'Đang giao hàng';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if($row_donhang['huydon'] == 0) {
                                                ?>
                                                        <a href="index.php?quanly=xemdonhang&user=<?php echo $_SESSION['login_id']; ?>
                                                        &mahang=<?php echo $row_donhang['mahang']; ?>&huydon=1">Yêu cầu huỷ</a>
                                                <?php
                                                } elseif($row_donhang['huydon'] == 1) {
                                                    ?>
                                                    <p>Đang chờ xác nhận</p>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <p>Đã huỷ</p>
                                                    <?php
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </table>
                                <nav aria-label="Page navigation example" class="mx-auto" style="width:300px;">
                                <?php
                                $sql_trang = mysqli_query($mysqli,"SELECT * FROM tbl_donhang
                                WHERE user_id='$id'
                                ORDER BY mahang DESC");
                                $row_count = mysqli_num_rows($sql_trang);
                                $trang = ceil($row_count/5);
                                if($trang > 1) {
                                ?>
                                    <ul class="pagination">
                                        <li class="page-item">
                                        <a class="page-link" href="?quanly=xemdonhang&user=<?php echo $_SESSION['login_id']; ?>&trang=<?php $trang_previous = $trang_active-1; if($trang_previous>1) echo $trang_previous; else echo 1; ?>" aria-label="">
                                            <span aria-hidden="true">&laquo;</span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        </li>
                                        <?php
                                        for($i=1;$i<=$trang;$i++) {
                                        ?>
                                        <li class="page-item <?php if($trang_active==$i) echo 'active'; ?>"><a class="page-link" href="?quanly=xemdonhang&user=<?php echo $_SESSION['login_id']; ?>&trang=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                        <?php
                                        }
                                        ?>
                                        <li class="page-item">
                                        <a class="page-link" 
                                        href="?quanly=xemdonhang&user=<?php echo $_SESSION['login_id']; ?>&trang=<?php $trang_next = $trang_active+1; if($trang_next<=$trang) echo $trang_next; else echo $trang; ?>">
                                            <span aria-hidden="true">&raquo;</span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                        </li>
                                    </ul>
                                    <?php
                                }
                                    ?>
                                </nav>
                            </div> <br>
                            <div class="col-md-12 mt-5">
                                <h6>Chi tiết đơn hàng</h6><br>
                                <?php 
                                if(isset($_GET['mahang'])) {
                                    $mahang = $_GET['mahang'];
                                } else {
                                    $mahang = '';
                                }
                                $sql_select = mysqli_query($mysqli,"SELECT * FROM tbl_donhang,tbl_khachhang,tbl_sanpham
                                WHERE tbl_donhang.sanpham_id=tbl_sanpham.sanpham_id AND tbl_khachhang.khachhang_id=tbl_donhang.khachhang_id
                                AND tbl_donhang.mahang = '$mahang' 
                                ORDER BY tbl_donhang.donhang_id DESC");
                                ?>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Mã hàng</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Hình ảnh</th>
                                        <th>Số lượng</th>
                                        <th>Giá tiền</th>
                                    </tr>
                                    <?php
                                    $i = 0;
                                    while($row_donhang = mysqli_fetch_array($sql_select)) {
                                        $i++;
                                        if($row_donhang['sanpham_giakhuyenmai']==0) {
                                            $gia = $row_donhang['sanpham_gia'];
                                        } else {
                                            $gia = $row_donhang['sanpham_gia'] - (($row_donhang['sanpham_gia']*$row_donhang['sanpham_giakhuyenmai'])/100);
                                        }
                                    ?>
                                    <tr>
                                        <td><?php echo $row_donhang['mahang']; ?></td>
                                        <td><?php echo $row_donhang['sanpham_name']; ?></td>
                                        <td class="invert-image" >
                                            
                                                <img style="max-height:200px;max-width:100px;"
                                                    src="images/<?php echo $row_donhang['sanpham_image']; ?>" alt=" "
                                                    class="img-responsive">
                                            
                                        </td>
                                        <td><?php echo $row_donhang['soluong']; ?></td>
                                        <td><?php echo number_format($row_donhang['soluong']*$gia).'vnđ'; ?></td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- //first section -->
                </div>
            </div>
            <!-- //product left -->
           
        </div>
    </div>
</div>
	<!-- //top products -->