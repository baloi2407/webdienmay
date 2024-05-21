<?php
use Carbon\Carbon;
use Carbon\CarbonInterval;
require('./carbon/vendor/autoload.php');
$now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
$errAddress = '';
if(isset($_POST['themgiohang'])) {
    $tensanpham = $_POST['tensanpham'];
    $sanpham_id = $_POST['sanpham_id'];
    $giasanpham = $_POST['giasanpham'];
    $hinhanh = $_POST['hinhanh'];
    $soluong = $_POST['soluong'];
    $user_id = $_SESSION['login_id'];
    echo "<script>history.back();</script>";
    
    $sql_select_giohang = mysqli_query($mysqli,"SELECT * FROM tbl_giohang WHERE sanpham_id='$sanpham_id' AND user_id='$user_id' ");
    $count = mysqli_num_rows($sql_select_giohang);
    if($count>0) {
        $row_sanpham = mysqli_fetch_array($sql_select_giohang);
        $soluong = $row_sanpham['soluong'] + 1;
        $sql_giohang = "UPDATE tbl_giohang SET soluong='$soluong' WHERE sanpham_id='$sanpham_id' AND user_id='$user_id' ";
    } else {
        $soluong = $soluong;
        $sql_giohang = "INSERT INTO tbl_giohang(sanpham_id,tensanpham,giasanpham,hinhanh,soluong,user_id) 
        values('$sanpham_id','$tensanpham','$giasanpham','$hinhanh','$soluong','$user_id') ";
    }
    $insert_rows = mysqli_query($mysqli,$sql_giohang);
    if($insert_rows==0) {
        header('Location:index.php?quanly=chitietsp&id='.$sanpham_id);
    }
} 
elseif(isset($_POST['capnhatsanpham'])) {
    $user_id = $_SESSION['login_id'];
    for($i = 0;$i < count($_POST['product_id']);$i++) {
        $sanpham_id = $_POST['product_id'][$i];
        $soluong = $_POST['soluong'][$i];
        $sql_select = mysqli_query($mysqli,"SELECT * FROM tbl_sanpham WHERE sanpham_id='$sanpham_id'");
        $row_sl = mysqli_fetch_array($sql_select);
        $ten_sp = $row_sl['sanpham_name'];
        $sl = $row_sl['sanpham_soluong'];
        if($soluong > $sl) {
            echo "<script>alert('Sản phẩm {$ten_sp} không đủ hàng.')</script>";

            $soluong = 1;
            $sql_capnhatsp = mysqli_query($mysqli,"UPDATE tbl_giohang SET soluong='$soluong' WHERE sanpham_id='$sanpham_id' AND user_id='$user_id' "); 
        } else {
            $sql_capnhatsp = mysqli_query($mysqli,"UPDATE tbl_giohang SET soluong='$soluong' WHERE sanpham_id='$sanpham_id' AND user_id='$user_id' "); 
        }
    }
    
}
elseif(isset($_GET['xoa'])) {
    $giohang_id = $_GET['xoa'];
    $sql_delete = mysqli_query($mysqli,"DELETE FROM tbl_giohang WHERE giohang_id='$giohang_id' ");
    echo "<script>document.location='index.php?quanly=giohang'</script>";
}
elseif(isset($_POST['thanhtoangiohang'])) {
    $user_id = $_SESSION['login_id'];
    $sql_kttien = mysqli_query($mysqli,"SELECT * FROM tbl_khachhang_account WHERE id='$user_id'");
    $row_kttien = mysqli_fetch_array($sql_kttien);
    $giaohang = $_POST['giaohang'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    
    if($giaohang != '') {
        $sql_lay_giohang = mysqli_query($mysqli,"SELECT * FROM tbl_giohang WHERE user_id='$user_id' ORDER BY giohang_id DESC");
        $subtotal = 0;
        while($row_lay_giohang = mysqli_fetch_array($sql_lay_giohang)) {
            $total = $row_lay_giohang['giasanpham']*$row_lay_giohang['soluong'];
            $subtotal += $total;
        }
        if($row_kttien['sodutk'] < $subtotal) {
            echo "<script>alert('Không đủ tiền để thanh toán')</script>";
        } else {
            $sql_diachi = mysqli_query($mysqli,"UPDATE tbl_diachi SET diachi='$address',tennguoinhan='$name',phone='$phone' WHERE user_id='$user_id' ");
            $sql_laydiachi = mysqli_query($mysqli,"SELECT * FROM tbl_diachi WHERE user_id='$user_id'");
            $row_laydiachi = mysqli_fetch_array($sql_laydiachi);
            $khachhang_name = $row_laydiachi['tennguoinhan'];
            $address_ = $row_laydiachi['diachi'];
            $phone_ = $row_laydiachi['phone'];
            $sql_khachhang = mysqli_query($mysqli,"INSERT INTO
                tbl_khachhang(khachhang_name,phone,khachhang_address,giaohang,user_id)
                values('$khachhang_name','$phone_','$address_','$giaohang','$user_id')");
            if($sql_khachhang) {
                $sql_select_khachhang = mysqli_query($mysqli,"SELECT * FROM tbl_khachhang ORDER BY khachhang_id DESC LIMIT 1");
                $row_khachhang = mysqli_fetch_array($sql_select_khachhang);
                $khachhang_id = $row_khachhang['khachhang_id'];
                $user_id = $_SESSION['login_id'];
                $tong = 0;               
                for($i = 0;$i < count($_POST['thanhtoan_product_id']);$i++) {
                    $soluong = $_POST['thanhtoan_soluong'][$i];
                    $tongtien = $_POST['tongtien'][$i];
                    $tong += $tongtien*$soluong;
    
                    $mahang = rand(0,99999);
                    $sanpham_id = $_POST['thanhtoan_product_id'][$i];
    
                    $sql_sanpham = mysqli_query($mysqli,"SELECT * FROM tbl_sanpham WHERE sanpham_id='$sanpham_id'");
                    $row_sp = mysqli_fetch_array($sql_sanpham);
                    $danhmuc_id = $row_sp['danhmuc_id'];
                    $sql_danhmuc = mysqli_query($mysqli,"SELECT * FROM tbl_sanpham,tbl_danhmuc WHERE sanpham_id='$sanpham_id' and tbl_sanpham.danhmuc_id = tbl_danhmuc.danhmuc_id");
                    $row_danhmuc = mysqli_fetch_array($sql_danhmuc);
                    $danhmuc_ten = $row_danhmuc['danhmuc_ten'];
                    
                    $sql_update_luotmua = mysqli_query($mysqli,"UPDATE tbl_sanpham SET luotmua=luotmua+1 WHERE sanpham_id='$sanpham_id'");
                    $update_soluong = $row_sp['sanpham_soluong'] - $soluong;
                    $sql_update_soluongSP = mysqli_query($mysqli,"UPDATE tbl_sanpham SET sanpham_soluong='$update_soluong' WHERE sanpham_id='$sanpham_id' ");
        
                    $sql_donhang = mysqli_query($mysqli,"INSERT INTO tbl_donhang(sanpham_id,khachhang_id,soluong,mahang,user_id)
                    values('$sanpham_id','$khachhang_id','$soluong','$mahang','$user_id')");
                    $sql_thongkesp = mysqli_query($mysqli,"INSERT INTO tbl_thongkesp(sanpham_id,danhmuc_id,soluong,tongtien,ngaythang,danhmuc_ten) VALUES('$sanpham_id','$danhmuc_id','$soluong','$tongtien','$now','$danhmuc_ten')");
                    
                    $sql_delete_giohang = mysqli_query($mysqli,"DELETE FROM tbl_giohang WHERE sanpham_id='$sanpham_id'");
                    $sql_trutien = mysqli_query($mysqli,"UPDATE tbl_khachhang_account SET sodutk=sodutk-$tong WHERE id='$user_id'");
                    
                }
        }
        }
    } else {$errAddress = "Vui lòng chọn phương thức thanh toán";};
}

?>

<?php
    $user_id = $_SESSION['login_id'];
?>

<!-- checkout page -->
<div class="privacy py-sm-5 py-4">
    <div class="container py-xl-4 py-lg-2">
        <!-- tittle heading -->
        <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
            Giỏ Hàng
        </h3>
        
        
        
        <!-- //tittle heading -->
        <div class="checkout-right">
            <?php
            $sql_lay_giohang = mysqli_query($mysqli,"SELECT * FROM tbl_giohang WHERE user_id='$user_id' ORDER BY giohang_id DESC");
            ?>

            <div class="table-responsive">
                <form action="" method="POST">
                    <table class="timetable_sub">
                        <thead>
                            <tr>
                                <th class="w-10">Thứ tự</th>
                                <th class="w-10">Sản phẩm</th>
                                <th class="w-10">Số lượng</th>
                                <th class="w-25">Tên sản phẩm</th>
                                <th>Giá</th>
                                <th>Giá tổng</th>
                                <th>Quản lý</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $subtotal = 0;
                            $i = 0;
                            while($row_lay_giohang = mysqli_fetch_array($sql_lay_giohang)) {
                                $total = $row_lay_giohang['giasanpham']*$row_lay_giohang['soluong'];
                                $subtotal += $total;
                                $i++;
                            ?>
                            <tr class="rem1">
                                <td class="invert" style="width:80px;"><?php echo $i; ?></td>
                                <td class="invert-image" style="width:200px;">
                                    
                                        <img style="max-height:200px;max-width:200px"
                                            src="images/<?php echo $row_lay_giohang['hinhanh']; ?>" alt=" "
                                            class="img-responsive">
                                    
                                </td>
                                <td class="invert">
                                    <div class="quantity">
                                        <div class="quantity-select">
                                            <input style="width:50px;" type="number" name="soluong[]" min="1"
                                                value="<?php echo $row_lay_giohang['soluong']; ?>" onchange="capnhatsl()" onkeyup="capnhatsl()" id="soluongsp">
                                            <input type="hidden" name="product_id[]"
                                                value="<?php echo $row_lay_giohang['sanpham_id']; ?>">
                                        </div>
                                    </div>
                                </td>
                                <td class="invert"><?php echo $row_lay_giohang['tensanpham']; ?>
                                </td>
                                <td class="invert"><?php echo number_format($row_lay_giohang['giasanpham']).'vnđ'; ?>
                                <input type="hidden" id="giasp" value="<?php echo $row_lay_giohang['giasanpham']; ?>">
                                </td>
                                <td class="invert" id="tongtiensp"><?php echo number_format($total).'vnđ'; ?></td>
                                <td class="invert">
                                    <div class="rem">
                                        <a data-toggle="modal" data-target="#exampleModal"
                                            href="./index.php?quanly=giohang&xoa=<?php echo $row_lay_giohang['giohang_id']; ?>">
                                            <span class="pl-2 pr-2 pt-1 pb-1 roundeded bg-danger text-white"><i class="fa fa-close"></i></span>
                                        </a>
                                    </div>
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
                                                    <a href="./index.php?quanly=giohang&xoa=<?php echo $row_lay_giohang['giohang_id']; ?>" class="btn btn-primary form-control">Xoá</a>
                                                </div>
                                                
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            }
                            ?>
                            <!-- <tr>
                                <td colspan="7">Tổng tiền: <?php echo number_format($subtotal).'vnđ'; ?></td>
                            </tr> -->
                            <!-- <tr>
                                <td colspan="7"><input type="submit" name="capnhatsanpham" value="Cập nhật sản phẩm"
                                        class="btn btn-success"></td>
                                
                            </tr> -->
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
        <?php
        $id = $_SESSION['login_id'];
        $sql_diachi = mysqli_query($mysqli,"SELECT * FROM tbl_diachi WHERE user_id='$id'");
        $count = mysqli_num_rows($sql_diachi);
        
        $row_diachi = mysqli_fetch_array($sql_diachi);
        if($row_diachi['diachi'] == '' && $row_diachi['tennguoinhan'] == '' && $row_diachi['phone'] == '' || isset($_POST['doidiachi'])) {
            ?>
            <div class="checkout-left">
                <div class="address_form_agile mt-sm-5 mt-4">
                    <h4 class="mb-sm-4 mb-3">Điền thông tin địa chỉ giao hàng</h4>
                    <form action="" method="POST" class="creditly-card-form agileinfo_form">
                        <div class="creditly-wrapper wthree, w3_agileits_wrapper">
                            <div class="information-wrapper">
                                <div class="first-row">
                                    <div class="controls form-group">
                                        <input class="billing-address-name form-control" type="text" name="name"
                                            placeholder="Họ tên" required="">
                                    </div>
                                    <div class="w3_agileits_card_number_grids">
                                        <div class="w3_agileits_card_number_grid_left form-group">
                                            <div class="controls">
                                                <input type="text" class="form-control" placeholder="Số điện thoại"
                                                    name="phone" required="">
                                            </div>
                                        </div>
                                        <div class="w3_agileits_card_number_grid_right form-group">
                                            <div class="controls">
                                                <input type="text" class="form-control" placeholder="Địa chỉ giao hàng"
                                                    name="address" required="" value="">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="controls form-group">
                                        <select class="option-w3ls" name="giaohang">
                                            <option>Chọn hình thức thanh toán</option>
                                            <option value="1">Chuyển khoản</option>
                                            <option value="0">Trả tiền khi nhận hàng</option>
                                        </select>
                                    </div>
                                </div>
                                <?php
                                $user_id = $_SESSION['login_id'];
                                $sql_giohang = mysqli_query($mysqli,"SELECT * FROM tbl_giohang WHERE user_id='$user_id' ORDER BY giohang_id DESC");
                                while($row_thanhtoan = mysqli_fetch_array($sql_giohang)) {
                                ?>
                                <input type="hidden" name="thanhtoan_soluong[]"
                                    value="<?php echo $row_thanhtoan['soluong']; ?>">
                                <input type="hidden" name="thanhtoan_product_id[]"
                                    value="<?php echo $row_thanhtoan['sanpham_id']; ?>">
                                <input type="hidden" name="tongtien[]"
                                    value="<?php echo $row_thanhtoan['giasanpham']; ?>">
                                <?php
                                }
                                ?>
                                <button type="submit" class="btn btn-success" name="thanhtoangiohang">Giao hàng tới địa chỉ
                                    này</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php
        } else {
            $sql_giohang = mysqli_query($mysqli,"SELECT * FROM tbl_giohang WHERE user_id='$user_id' ORDER BY giohang_id DESC");
            $count = mysqli_num_rows($sql_giohang);
            if($count > 0) {
            ?>
            <div class="checkout-left">
                <div class="address_form_agile mt-sm-5 mt-4">
                    <form action="" method="POST" class="creditly-card-form agileinfo_form">
                        <div class="creditly-wrapper wthree, w3_agileits_wrapper">
                            <div class="information-wrapper">
                                <div class="first-row">
                                    <div class="controls form-group">
                                        <input class="billing-address-name form-control" type="hidden" name="name"
                                            placeholder="Họ tên" value="<?= $row_diachi['tennguoinhan']; ?>">
                                    </div>
                                    <div class="w3_agileits_card_number_grids">
                                        <div class="w3_agileits_card_number_grid_left form-group">
                                            <div class="controls">
                                                <input type="hidden" class="form-control" placeholder="Số điện thoại"
                                                    name="phone" value="<?= $row_diachi['phone']; ?>">
                                            </div>
                                        </div>
                                        <div class="w3_agileits_card_number_grid_right form-group">
                                            <div class="controls">
                                                <input type="hidden" class="form-control" placeholder="Địa chỉ giao hàng"
                                                    name="address" value="<?= $row_diachi['diachi']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="controls form-group">
                                        <select class="option-w3ls" name="giaohang">
                                            <option value="">Chọn hình thức thanh toán</option>
                                            <option value="1">Chuyển khoản</option>
                                            <option value="0">Trả tiền khi nhận hàng</option>
                                        </select>
                                        <div class="form-text text-danger"><?= $errAddress; ?></div>
                                    </div>
                                </div>
                                <?php
                                // $user_id = $_SESSION['login_id'];
                                
                                    while($row_thanhtoan = mysqli_fetch_array($sql_giohang)) {
                                    ?>
                                    <input type="hidden" name="thanhtoan_soluong[]"
                                        value="<?php echo $row_thanhtoan['soluong']; ?>">
                                    <input type="hidden" name="thanhtoan_product_id[]"
                                        value="<?php echo $row_thanhtoan['sanpham_id']; ?>">
                                    <input type="hidden" name="tongtien[]"
                                        value="<?php echo $row_thanhtoan['giasanpham']; ?>">
                                    <?php
                                    }
                                    ?>
                                    <button type="submit" class="btn btn-success" name="thanhtoangiohang">Giao hàng tới địa chỉ
                                        này</button>
                                    <button type="submit" class="btn btn-primary" name="doidiachi">Đổi dịa chỉ</button>
                                    <?php
                                
                                ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php
            }
        }
        ?>
        

    </div>
</div>
<!-- //checkout page -->
<script>
    function capnhatsl() {
        var soluongsp = document.getElementById('soluongsp').value;
        if(soluongsp > 0) {
            var tien =  document.getElementById('giasp').value;
            var tongtien = soluongsp*tien;
            document.getElementById('tongtiensp').innerHTML = tongtien.toFixed(3) + 'vnđ';
        } else {
            soluongsp = 1;
            var tien =  document.getElementById('giasp').value;
            var tongtien = soluongsp*tien;
            document.getElementById('tongtiensp').innerHTML = tongtien.toFixed(3) + 'vnđ';   
        }
    }
</script>