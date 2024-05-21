<?php
    use Carbon\Carbon;
    use Carbon\CarbonInterval;
    require('../carbon/vendor/autoload.php');
    $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
    if(isset($_POST['capnhatdonhang'])) {
        $tinhtrang = $_POST['tinhtrang'];
        $mahang = $_POST['mahang'];
        $sql_update_donhang = mysqli_query($mysqli,"UPDATE tbl_donhang SET tinhtrang='$tinhtrang' WHERE mahang='$mahang' ");
        if($tinhtrang==1) {
            $sql_lietkedh = mysqli_query($mysqli,"SELECT * FROM tbl_donhang,tbl_sanpham WHERE 
            tbl_donhang.sanpham_id = tbl_sanpham.sanpham_id AND tbl_donhang.mahang='$mahang'");
            $sql_thongke = mysqli_query($mysqli,"SELECT * FROM tbl_thongke WHERE ngaydat='$now'");
            $soluongmua = 0;
            $doanhthu = 0;
            while($row = mysqli_fetch_array($sql_lietkedh)) {
                $soluongmua += $row['soluong'];
                if($row['sanpham_giakhuyenmai']==0) {
                    $gia = $row['sanpham_gia'];
                } else {
                    $gia = $row['sanpham_gia'] - (($row['sanpham_gia']*$row['sanpham_giakhuyenmai'])/100);
                }
                $doanhthu += $gia;
            }
            if(mysqli_num_rows($sql_thongke)==0) {
                $soluongban = $soluongmua;
                $doanhthu = $doanhthu;
                $donhang = 1;
                $sql_update_thongke = mysqli_query($mysqli,"INSERT INTO tbl_thongke
                (ngaydat,soluongban,doanhthu,donhang) VALUES ('$now','$soluongban','$doanhthu','$donhang') ");
            } elseif(mysqli_num_rows($sql_thongke)!=0) {
                while($row = mysqli_fetch_array($sql_thongke)) {
                    $soluongban = $row['soluongban']+$soluongmua;
                    $doanhthu = $row['doanhthu']+$doanhthu;
                    $donhang = $row['donhang']+1;
                    $sql_update_thongke = mysqli_query($mysqli,"UPDATE tbl_thongke SET 
                    soluongban='$soluongban',doanhthu='$doanhthu',donhang='$donhang' WHERE ngaydat='$now' ");
                }
            }
        } 
    }
?>
<?php
    if(isset($_GET['xoadonhang'])) {
        $mahang = $_GET['xoadonhang'];
        $sql_delete = mysqli_query($mysqli,"DELETE FROM tbl_donhang WHERE mahang='$mahang'");
    }
?>
<?php
    if(isset($_GET['yeucauhuy']) && isset($_GET['mahang']) && isset($_GET['soluong']) && isset($_GET['sanpham_id'])) {
        $huydon = $_GET['yeucauhuy'];
        $mahang = $_GET['mahang'];
        $soluong = $_GET['soluong'];
        $sanpham_id = $_GET['sanpham_id'];
    } else {
        $huydon = '';
        $mahang = '';
        $soluong = '';
        $sanpham_id = '';
    }
    // echo $sanpham_id;
    $sql_huydon = mysqli_query($mysqli,"UPDATE tbl_donhang SET huydon='$huydon' WHERE mahang='$mahang'");
    $sql_update = mysqli_query($mysqli,"UPDATE tbl_sanpham SET sanpham_soluong=sanpham_soluong+'$soluong' WHERE sanpham_id='$sanpham_id'");

?>

    <div class="container">
        <div class="row">
            <?php
            if(isset($_GET['xemdonhang']) == 'xemdonhang') {
                $mahang = $_GET['mahang'];
                $sql_chitiet = mysqli_query($mysqli,"SELECT * FROM tbl_donhang,tbl_sanpham WHERE 
                tbl_donhang.sanpham_id = tbl_sanpham.sanpham_id AND tbl_donhang.mahang='$mahang'
                ");
                
                
                ?>
                    <div class="col-md-12">
                        <p>Xem chi tiết đơn hàng</p>
                        <form action="" method="POST">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Mã hàng</td>
                                    <th>Tên sản phẩm</td>
                                    <th>Số lượng</td>
                                    <th>Giá</td>
                                    <th>Tổng tiền</td>
                                    
                                </tr>
                                <?php
                                $i = 0;
                                while($row_chitiet = mysqli_fetch_array($sql_chitiet)) {
                                    if($row_chitiet['sanpham_giakhuyenmai']==0) {
                                        $gia = $row_chitiet['sanpham_gia'];
                                    } else {
                                        $gia = $row_chitiet['sanpham_gia'] - (($row_chitiet['sanpham_gia']*$row_chitiet['sanpham_giakhuyenmai'])/100);
                                    }
                                    $i++;
                                ?>
                                <tr>
                                    <td><?php echo $row_chitiet['mahang']; ?></td>
                                    <td><?php echo $row_chitiet['sanpham_name']; ?></td>
                                    <td><?php echo $row_chitiet['soluong']; ?></td>
                                    <td><?php echo number_format($gia).'vnđ'; ?></td>
                                    <td><?php echo number_format($row_chitiet['soluong']*$gia).'vnđ'; ?></td>
                                    <input type="hidden" name="mahang" value="<?php echo $row_chitiet['mahang']; ?>">
                                </tr>
                                <?php
                                }
                                ?>
                                <?php
                                $sql_khachhang = mysqli_query($mysqli,"SELECT * FROM tbl_donhang,tbl_khachhang WHERE 
                                tbl_khachhang.khachhang_id=tbl_donhang.khachhang_id");
                                $row_khachhang = mysqli_fetch_array($sql_khachhang);
                                ?>
                                <tr>
                                    <td colspan="6">Địa chỉ: <?php echo $row_khachhang['khachhang_address']; ?> </td>
                                </tr>
                                <tr>
                                    <td colspan="6">Số điện thoại: <?php echo $row_khachhang['phone']; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="6">Hình thức thanh toán: <?php if ($row_khachhang['giaohang'] == 0) echo 'Trả tiền khi nhận hàng';
                                     else echo 'Thanh toán ATM'; ?></td>
                                </tr>
                            </table>
                            <select name="tinhtrang" class="form-control">
                                <option value="0">Chưa xử lý</option>
                                <option value="1">Đã xử lý</option>
                            </select>
                            <input type="submit" value="Cập nhật đơn hàng" name="capnhatdonhang" class="btn btn-success mt-2 mb-2">
                        </form>
                    </div>
                <?php
            ?>
                
            <?php
            } else {
                ?> 
                    <div class="col-md-5">
                        <p>Đơn hàng</p>
                    </div>
                <?php
            }
            ?>
            
            <div class="col-md-12">
                <h4>Liệt kê đơn hàng</h4>
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
                $btn_daxuly = $btn_chuaxuly = 'btn-secondary';
                if(isset($_GET['daxuly'])) {
                    $sql_select = mysqli_query($mysqli,"SELECT * FROM tbl_sanpham,tbl_donhang,tbl_khachhang
                    WHERE tbl_donhang.sanpham_id=tbl_sanpham.sanpham_id AND tbl_donhang.khachhang_id=tbl_khachhang.khachhang_id 
                    GROUP BY tbl_donhang.mahang ORDER BY tbl_donhang.tinhtrang DESC LIMIT $begin,5");
                    $btn_daxuly = 'btn-primary';
                } elseif(isset($_GET['chuaxuly'])) {
                    $sql_select = mysqli_query($mysqli,"SELECT * FROM tbl_sanpham,tbl_donhang,tbl_khachhang
                    WHERE tbl_donhang.sanpham_id=tbl_sanpham.sanpham_id AND tbl_donhang.khachhang_id=tbl_khachhang.khachhang_id 
                    GROUP BY tbl_donhang.mahang ORDER BY tbl_donhang.tinhtrang ASC LIMIT $begin,5");
                    $btn_chuaxuly = 'btn-primary';
                } else {
                    $sql_select = mysqli_query($mysqli,"SELECT * FROM tbl_sanpham,tbl_donhang,tbl_khachhang
                    WHERE tbl_donhang.sanpham_id=tbl_sanpham.sanpham_id AND tbl_donhang.khachhang_id=tbl_khachhang.khachhang_id 
                    GROUP BY tbl_donhang.mahang ORDER BY tbl_donhang.donhang_id DESC LIMIT $begin,5");
                }
                ?>
                <a href="dashboard.php?quanly=xulydonhang&daxuly" class="btn <?= $btn_daxuly ?> mt-2 mb-2">Đã xử lý</a>
                <a href="dashboard.php?quanly=xulydonhang&chuaxuly" class="btn <?= $btn_chuaxuly ?> mt-2 mb-2">Chưa xử lý</a>
                <table class="table table-bordered">
                    <tr>
                        <th>Thứ tự</td>
                        <th>Mã hàng</td>
                        <th>Tên khách hàng</td>
                        <th>Ngày đặt</td>
                        <th>Tình trạng đơn hàng</td>
                        <th>Huỷ đơn</td>
                        <th>Quản lý</td>
                    </tr>
                    <?php
                    $i = 0;
                    while($row_donhang = mysqli_fetch_array($sql_select)) {
                        $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row_donhang['mahang']; ?></td>
                        <td><?php echo $row_donhang['khachhang_name']; ?></td>
                        <td><?php echo $row_donhang['ngaythang']; ?></td>
                        <td><?php
                            if($row_donhang['tinhtrang'] == '0') {
                                echo 'Chưa xử lý';
                            } else {
                                echo 'Đã xử lý';
                            }
                        ?></td>
                        <td><?php  
                                if($row_donhang['huydon'] == 0) {echo 'Không';} 
                                elseif($row_donhang['huydon'] == 1) {
                                    ?>
                                    <a href="?quanly=xulydonhang&xemdonhang&mahang=<?php echo $row_donhang['mahang']; ?>&sanpham_id=<?php echo $row_donhang['sanpham_id']; ?>&soluong=<?php echo $row_donhang['soluong']; ?>&yeucauhuy=2">Xác nhận huỷ đơn</a>
                                    <?php
                                } else {
                                    ?>
                                    <p class="text text-danger">Đã huỷ</p>
                                    <?php
                                }
                         ?></td>
                        <td>
                            <a data-toggle="modal" data-target="#exampleModal" href="" class="border-right pr-2">
                            <span class="pl-2 pr-2 pt-1 pb-1 roundeded bg-danger text-white"><i class="fa fa-close"></i></span>
                            </a>
                            <a href="?quanly=xulydonhang&xemdonhang&mahang=<?php echo $row_donhang['mahang']; ?>">
                            <span class="pl-2 pr-2 pt-1 pb-1 roundeded bg-info text-white"><i class="fa fa-search"></i></span>
                            </a>
                        </td>
                    </tr>
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-center">Xoá khỏi giỏ hàng</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            
                                                <div class="right-w3l">
                                                    <a href="?quanly=xulydonhang&xoadonhang=<?php echo $row_donhang['mahang']; ?>" class="btn btn-primary form-control">Xoá</a>
                                                </div>
                                                
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                    }
                    ?>
                </table>
                <nav aria-label="Page navigation example" class="mx-auto" style="width:300px;">
                    <?php
                   if(isset($_GET['daxuly'])) {
                        $sql_trang = mysqli_query($mysqli,"SELECT * FROM tbl_sanpham,tbl_donhang,tbl_khachhang
                        WHERE tbl_donhang.sanpham_id=tbl_sanpham.sanpham_id AND tbl_donhang.khachhang_id=tbl_khachhang.khachhang_id 
                        GROUP BY tbl_donhang.mahang ORDER BY tbl_donhang.tinhtrang DESC");
                        $btn_daxuly = 'btn-primary';
                    } elseif(isset($_GET['chuaxuly'])) {
                        $sql_trang = mysqli_query($mysqli,"SELECT * FROM tbl_sanpham,tbl_donhang,tbl_khachhang
                        WHERE tbl_donhang.sanpham_id=tbl_sanpham.sanpham_id AND tbl_donhang.khachhang_id=tbl_khachhang.khachhang_id 
                        GROUP BY tbl_donhang.mahang ORDER BY tbl_donhang.tinhtrang ASC");
                        $btn_chuaxuly = 'btn-primary';
                    } else {
                        $sql_trang = mysqli_query($mysqli,"SELECT * FROM tbl_sanpham,tbl_donhang,tbl_khachhang
                        WHERE tbl_donhang.sanpham_id=tbl_sanpham.sanpham_id AND tbl_donhang.khachhang_id=tbl_khachhang.khachhang_id 
                        GROUP BY tbl_donhang.mahang ORDER BY tbl_donhang.donhang_id DESC");
                    }
                    $row_count = mysqli_num_rows($sql_trang);
                    $trang = ceil($row_count/5);
                    if($trang > 1) {
                    ?>
                    <ul class="pagination">
                        <li class="page-item">
                        <a class="page-link" 
                        href="?quanly=xulydonhang&trang=<?php $trang_previous = $trang_active-1;
                         if($trang_previous>1) echo $trang_previous;
                          else echo 1; ?><?php if(isset($_GET['daxuly'])) echo '&daxuly'; elseif(isset($_GET['chuaxuly'])) echo '&chuaxuly';?>" 
                          aria-label="">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                        </li>
                        <?php
                        for($i=1;$i<=$trang;$i++) {
                        ?>
                        <li class="page-item <?php if($trang_active==$i) echo 'active'; ?>"><a class="page-link" 
                        href="?quanly=xulydonhang&trang=<?= $i; ?><?php
                        if(isset($_GET['daxuly'])) echo '&daxuly'; elseif(isset($_GET['chuaxuly'])) echo '&chuaxuly';
                        ?>">
                            <?php echo $i; ?></a></li>
                        <?php
                        }
                        ?>
                        <li class="page-item">
                        <a class="page-link" 
                        href="?quanly=xulydonhang&trang=<?php $trang_next = $trang_active+1; 
                        if($trang_next<=$trang) echo $trang_next; 
                        else echo $trang; ?><?php if(isset($_GET['daxuly'])) echo '&daxuly'; elseif(isset($_GET['chuaxuly'])) echo '&chuaxuly';?>">
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
    </div>
