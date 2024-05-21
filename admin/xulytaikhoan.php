<?php
$errBirth=$errEmail=$errHoTen=$errPass=$errUN = $loi = '';
if(isset($_POST['themtaikhoan'])) {
    $tendangnhap = $_POST['tendangnhap'];
    $hoten = $_POST['hoten'];
    $matkhau = $_POST['matkhau'];
    $email = $_POST['email'];
    $phai = $_POST['phai'];
    $ngaysinh = $_POST['ngaysinh'];

    $sql_check_un = mysqli_query($mysqli,"SELECT * FROM tbl_khachhang_account WHERE tendangnhap='$tendangnhap'");
    $check_un = mysqli_num_rows($sql_check_un);
    if($check_un > 0) {
        $errUN = "Tên đăng nhập đã được sử dụng! Vui lòng chọn tên đăng nhập khác";
    } else {
        if(strlen($tendangnhap)==0) {$errUN="Tên đăng nhập chưa nhập vào";}
        elseif(strlen($tendangnhap)<6) {$errUN="Tên đăng nhập quá ngắn";}
        elseif(strlen($tendangnhap)>100) {$errUN="Tên đăng nhập quá dài";}
    }
    if(strlen($hoten)==0) {$errHoTen="Họ tên chưa nhập vào";}
    if(empty($ngaysinh)) {$errBirth="Ngày sinh chưa nhập vào";}
    if(strlen($matkhau)==0) {$errPass = "Mật khẩu chưa nhập vào";}
    elseif(strlen($matkhau)<8) {$errPass = "Mật khẩu quá ngắn. Vui lòng nhập mật khẩu có độ dài trên 8 ký tự.";}
    $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";  
    if (!preg_match ($pattern, $email) ){  
        $errEmail= "Email không hợp lệ";  
    }
    $sql_check_e = mysqli_query($mysqli,"SELECT * FROM tbl_khachhang_account WHERE email='$email'");
    $check_e = mysqli_num_rows($sql_check_e);
    if($check_e > 0) {
        $errEmail = "Email đã được sử dụng! Vui lòng chọn Email khác";
    }
    
    if($errBirth==''&& $errEmail=='' && $errHoTen=='' && $errPass=='' && $errUN=='') {
    $matkhau = md5($matkhau);
    $random_key = substr(md5(rand(0,99999)), 0, 20);
    $sql_dangky = mysqli_query($mysqli,"INSERT INTO tbl_khachhang_account SET tendangnhap='$tendangnhap',matkhau='$matkhau',hoten='$hoten',email='$email',phai='$phai',
    ngaysinh='$ngaysinh',randomkey='$random_key'");
    $sql_select = mysqli_query($mysqli,"SELECT * FROM tbl_khachhang_account ORDER BY id DESC");
    $row = mysqli_fetch_array($sql_select);
    $id_user = $row['id'];
    $sql_diachi = mysqli_query($mysqli,"INSERT INTO tbl_diachi SET user_id='$id_user'");
    
    }
}
?>
<?php
    if(isset($_POST['capnhattaikhoan'])) {
        $id = $_GET['id'];
        $nhomquyen = $_POST['nhomquyen'];
        $tendangnhap = $_POST['tendangnhap'];
        $hoten = $_POST['hoten'];
        $matkhau = $_POST['matkhau'];
        $email = $_POST['email'];
        $phai = $_POST['phai'];
        $ngaysinh = $_POST['ngaysinh'];

        $sql_check_un = mysqli_query($mysqli,"SELECT * FROM tbl_khachhang_account WHERE tendangnhap='$tendangnhap'");
        $check_un = mysqli_num_rows($sql_check_un);
        if($check_un > 0) {
            $errUN = "Tên đăng nhập đã được sử dụng! Vui lòng chọn tên đăng nhập khác";
        } else {
            if(strlen($tendangnhap)==0) {$errUN="Tên đăng nhập chưa nhập vào";}
            elseif(strlen($tendangnhap)<6) {$errUN="Tên đăng nhập quá ngắn";}
            elseif(strlen($tendangnhap)>100) {$errUN="Tên đăng nhập quá dài";}
        }
        if(strlen($hoten)==0) {$errHoTen="Họ tên chưa nhập vào";}
        if(empty($ngaysinh)) {$errBirth="Ngày sinh chưa nhập vào";}
        if(strlen($matkhau)==0) {$errPass = "Mật khẩu chưa nhập vào";}
        elseif(strlen($matkhau)<8) {$errPass = "Mật khẩu quá ngắn";}
        $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";  
        if (!preg_match ($pattern, $email) ){  
            $errEmail= "Email không hợp lệ";  
        }
        $sql_check_e = mysqli_query($mysqli,"SELECT * FROM tbl_khachhang_account WHERE email='$email'");
        $check_e = mysqli_num_rows($sql_check_e);
        if($check_e > 0) {
            $errEmail = "Email đã được sử dụng! Vui lòng chọn Email khác";
        }
        
        if($errBirth==''&& $errEmail=='' && $errHoTen=='' && $errPass=='' && $errUN=='') {
            $matkhau = md5($matkhau);
            if($nhomquyen == '') {
                $sql_update = mysqli_query($mysqli,"UPDATE tbl_khachhang_account SET tendangnhap='$tendangnhap',matkhau='$matkhau',hoten='$hoten',email='$email',phai='$phai',
                ngaysinh='$ngaysinh' WHERE id='$id'");
            } else {
                $sql_update = mysqli_query($mysqli,"UPDATE tbl_khachhang_account SET tendangnhap='$tendangnhap',matkhau='$matkhau',hoten='$hoten',email='$email',phai='$phai',
                ngaysinh='$ngaysinh',idgroup='$nhomquyen' WHERE id='$id'");
            }
        }
    }
?>
<?php
    $loi = '';
    if(isset($_POST['capquyentaikhoan'])) {
        $id = $_GET['id'];
        $quanlysp = $_POST['quyenquanlysp'];
        $quanlydh = $_POST['quyenquanlydh'];
        $quanlybv = $_POST['quyenquanlybv'];
        $quanlykh = $_POST['quyenquanlykh'];

        if($quanlybv == '' || $quanlydh == '' || $quanlysp == '' || $quanlykh == '' || $taikhoankh == '') {
            $loi.="Vui lòng xác minh để cập nhật<br/>";
        }
        if($loi == '') {
            $select = mysqli_query($mysqli,"SELECT * FROM tbl_quyen WHERE user_id='$id'");
            $count = mysqli_num_rows($select);
            if($count > 0) {
                $sql_update = mysqli_query($mysqli,"UPDATE tbl_quyen SET quanlysp='$quanlysp',quanlybaiviet='$quanlybv',quanlydonhang='$quanlydh',quanlykh='$quanlykh' WHERE user_id='$id'");
            } else {
                $sql = mysqli_query($mysqli,"INSERT INTO tbl_quyen (user_id,quanlysp,quanlybaiviet,quanlydonhang,quanlykh) VALUES('$id','$quanlysp','$quanlybv','$quanlydh','$quanlykh')");
            }
        }
    }
?>
<?php
if(isset($_GET['xoa'])) {
    $id = $_GET['id'];
    $sql_delete = mysqli_query($mysqli,"DELETE FROM tbl_khachhang_account WHERE id='$id'");
}
?>

    <div class="container py-xl-4 py-lg-2">
        <div class="row">
            <?php
                if(isset($_GET['trangthai'])) {
                    $temp = $_GET['trangthai'];
                } else {
                    $temp = '';
                }
                if($temp=='chitiet') {
                    $id = $_GET['id'];
                    $sql = mysqli_query($mysqli,"SELECT * FROM tbl_khachhang_account WHERE id='$id'");
                    $row = mysqli_fetch_array($sql);
                    ?>
                     <div class="col-md-12">
                        <h4 class="mb-2">Chi tiết tài khoản</h4>
                        <div class="row">
                            <div class="col-md-6 mb-1">
                                <label for="" class="font-weight-bold">Tên tài khoản</label>
                                <p class="text-dark border border-secondary p-1"><?php echo $row['tendangnhap']; ?></p>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label class="font-weight-bold" for="">Họ tên</label>
                                <p class="text-dark border border-secondary p-1"><?php echo $row['hoten']; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-1">
                                <label class="font-weight-bold" for="">Ngày sinh</label>
                                <p class="text-dark border border-secondary p-1"><?php echo $row['ngaysinh']; ?></p>
                            </div>
                                <div class="col-md-6 mb-1"><label class="font-weight-bold" for="">Phái</label>
                                <p class="text-dark border border-secondary p-1"><?php if($row['phai']==0) echo 'Nữ';elseif($row['phai']==1) echo 'Nam'; ?></p></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-1">
                                <label class="font-weight-bold" for="">Email</label>
                                <p class="text-dark border border-secondary p-1"><?php echo $row['email']; ?></p>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label class="font-weight-bold" for="">Ngày đăng ký</label>
                                <p class="text-dark border border-secondary p-1"><?php echo $row['ngaydangky']; ?></p>
                            </div>
                        </div> 
                        <label class="font-weight-bold" for="">Nhóm quyền</label>
                        <p class="text-dark border border-secondary p-1">
                            <?php if($row['idgroup']==0) echo 'Khách hàng';
                            elseif($row['idgroup']==1) echo 'Quản lý tổng';
                            elseif($row['idgroup']==2) echo 'Quản trị viên';
                            elseif($row['idgroup']==3) echo 'Nhân viên'; 
                            ?>
                        </p>
                    </div>
                    <?php
                } elseif($temp=='capnhat') {
                    $id = $_GET['id'];
                    $sql = mysqli_query($mysqli,"SELECT * FROM tbl_khachhang_account WHERE id='$id'");
                    $row = mysqli_fetch_array($sql);
                    ?>
                     <div class="col-md-12">
                        <h4 class="mb-2">Cập nhật tài khoản</h4>
                        <form action="" method="post">
                           <div class="row">
                                <div class="col-md-6 mb-1">
                                    <label class="font-weight-bold" for="">Tên tài khoản</label>
                                    <input  value="<?php echo $row['tendangnhap'];?>" type="text" class="form-control" name="tendangnhap" placeholder="Tên tài khoản" >
                                    <p class="text text-danger"><?= $errUN; ?></p>
                                </div>
                                <div class="col-md-6 mb-1">
                                    <label class="font-weight-bold" for="">Họ tên</label>
                                    <input value="<?php echo $row['hoten'];?>" type="text" class="form-control" name="hoten" placeholder="Họ tên" >
                                    <p class="text text-danger"><?= $errHoTen; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-1">
                                    <label class="font-weight-bold" for="">Ngày sinh</label>
                                    <input value="<?php echo $row['ngaysinh'];?>" type="date" class="form-control" name="ngaysinh" placeholder="Ngày sinh" >
                                    <p class="text text-danger"><?= $errBirth; ?></p>
                                </div>
                                <div class="col-md-6 mb-1">
                                    <label class="font-weight-bold" for="">Phái</label>
                                    <select id="phai" name="phai" class="form-control">
                                        <option value="<?php echo $row['phai']; ?>" selected><?php if($row['phai']==0) echo 'Nữ'; else echo 'Nam'; ?></option>
                                        <option value="<?php if($row['phai']==0) echo '1'; elseif($row['phai']==1) echo '0' ?>">
                                            <?php if($row['phai']==0) echo 'Nam';elseif($row['phai']==1) echo 'Nữ'?>
                                        </option>
                                    </select>
                                </div>
                            </div>    
                            <div class="row">
                                <div class="col-md-12 mb-1">
                                    <label class="font-weight-bold" for="">Email</label>
                                    <input value="<?php echo $row['email'];?>" type="text" class="form-control" name="email" placeholder="Email" >
                                    <p class="text text-danger"><?= $errEmail; ?></p>
                                </div>
                            </div>                            
                            <label class="font-weight-bold" for="">Mật khẩu</label>
                            <div class="input-group mb-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                                </div>
                                <input name="matkhau" type="password" value="<?php echo md5($row['matkhau']);?>" class="input form-control" id="matkhau" placeholder="Mật khẩu" required="true" aria-label="password" aria-describedby="basic-addon1" />
                                <div class="input-group-append">
                                    <span class="input-group-text" onclick="password_show_hide();">
                                    <i class="fas fa-eye" id="show_eye"></i>
                                    <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                                    </span>
                                </div>
                            </div>
                            <p class="text text-danger"><?= $errPass; ?></p>
                            <select name="nhomquyen" id="" class="form-control mt-2">
                                <option value="">--Chọn nhóm quyền--</option>
                                <option value="1">Quản lý cấp quyền</option>
                                <option value="2">Quản trị viên</option>
                                <option value="3">Nhân viên</option>
                            </select>
                            <input type="submit" value="Câp nhật tài khoản" name="capnhattaikhoan" class="btn btn-success mt-2">
                        </form>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="col-md-12">
                        <h4>Thêm tài khoản</h4>
                        <?php
                        if(isset($_GET['themtaikhoan'])) {
                        ?>
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-md-6 mb-1">
                                    <label for="">Tên tài khoản</label>
                                    <input type="text" class="form-control" name="tendangnhap" placeholder="Tên tài khoản" value="<?php  if(isset($tendangnhap)) echo $tendangnhap;?>" >
                                    <p class="text text-danger"><?= $errUN; ?></p>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Họ tên</label>
                                    <input type="text" class="form-control" name="hoten" placeholder="Họ tên" value="<?php  if(isset($hoten)) echo $hoten;?>">
                                    <p class="text text-danger"><?= $errHoTen; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Ngày sinh</label>
                                    <input type="date" class="form-control" name="ngaysinh" placeholder="Ngày sinh" value="<?php  if(isset($ngaysinh)) echo $ngaysinh;?>">
                                    <p class="text text-danger"><?= $errBirth; ?></p>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Phái</label>
                                    <select id="phai" name="phai" class="form-control">
                                        <option value="0">Nữ</option>
                                        <option value="1">Nam</option>
                                    </select>
                                </div>
                            </div>
                            <label for="">Email</label>
                            <input type="text" class="form-control" name="email" placeholder="Email" value="<?php  if(isset($email)) echo $email;?>">
                            <p class="text text-danger"><?= $errEmail; ?></p><br>
                            <div class="input-group mb-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                                </div>
                                <input name="matkhau" type="password" class="input form-control" id="matkhau" placeholder="Mật khẩu" aria-label="password" aria-describedby="basic-addon1"
                                value="<?php  if(isset($matkhau)) echo $matkhau;?>"/>
                                <div class="input-group-append">
                                    <span class="input-group-text" onclick="password_show_hide();">
                                    <i class="fas fa-eye" id="show_eye"></i>
                                    <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                                    </span>
                                </div><br>
                            </div>
                            <p class=" text-danger"><?= $errPass; ?></p>
                            <input type="submit" value="Thêm tài khoản" name="themtaikhoan" class="btn btn-success mt-2">
                        </form>
                        <?php
                        } else {
                            ?>
                            <a href="dashboard.php?quanly=xulytaikhoan&themtaikhoan" class="btn btn-success">Thêm tài khoản</a>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
            ?>
            
            <div class="col-md-12 py-xl-4 py-lg-2">
                <h4>Liệt kê tài khoản</h4>
                <?php 
                $id_session = $_SESSION['admin_id'];
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
                $sql_select = mysqli_query($mysqli,"SELECT * FROM tbl_khachhang_account WHERE id!=$id_session ORDER BY id DESC LIMIT $begin,5");
                ?>
                <table class="table table-bordered">
                    <tr>
                        <th>Thứ tự</th>
                        <th>Tên tài khoản</th>
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>Phái</th>
                        <th>Quản lý</th>
                    </tr>
                    <?php
                    $i = 0;
                    while($row_select = mysqli_fetch_array($sql_select)) {
                        $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row_select['tendangnhap']; ?></td>
                        <td><?php echo $row_select['hoten']; ?></td>
                        <td><?php echo $row_select['email']; ?></td>
                        <td><?php if($row_select['phai']==0) echo 'Nữ';else echo 'Nam'; ?></td>
                        <td>
                            <a href="?quanly=xulytaikhoan&xoa&id=<?php echo $row_select['id']; ?>" class="">
                            <span class="pl-2 pr-2 pt-1 pb-1 roundeded bg-danger text-white"><i class="fa fa-close"></i></span>
                        </a>
                            <a href="?quanly=xulytaikhoan&trangthai=chitiet&id=<?php echo $row_select['id']; ?>" class="">
                            <span class="pl-2 pr-2 pt-1 pb-1 roundeded bg-info text-white"><i class="fa fa-search"></i></span>
                        </a>
                            <a href="?quanly=xulytaikhoan&trangthai=capnhat&id=<?php echo $row_select['id']; ?>">
                            <span class="pl-2 pr-2 pt-1 pb-1 roundeded bg-success text-white"><i class="fa fa-wrench"></i></span>
                        </a>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </table>
                <nav aria-label="Page navigation example" class="mx-auto" style="width:300px;">
                    <?php
                    $sql_trang = mysqli_query($mysqli,"SELECT * FROM tbl_khachhang_account WHERE id!=$id_session ORDER BY id DESC");
                    $row_count = mysqli_num_rows($sql_trang);
                    $trang = ceil($row_count/5);
                    if($trang > 1) {
                    ?>
                    <ul class="pagination">
                        <li class="page-item">
                        <a class="page-link" href="?quanly=xulytaikhoan&trang=<?php $trang_previous = $trang_active-1; if($trang_previous>1) echo $trang_previous; else echo 1; ?>" aria-label="">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                        </li>
                        <?php
                        for($i=1;$i<=$trang;$i++) {
                        ?>
                        <li class="page-item <?php if($trang_active==$i) echo 'active'; ?>"><a class="page-link" href="?quanly=xulytaikhoan&trang=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php
                        }
                        ?>
                        <li class="page-item">
                        <a class="page-link" 
                        href="?quanly=xulytaikhoan&trang=<?php $trang_next = $trang_active+1; if($trang_next<=$trang) echo $trang_next; else echo $trang; ?>">
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

<script>
function password_show_hide() {
    var x = document.getElementById("matkhau");
    var show_eye = document.getElementById("show_eye");
    var hide_eye = document.getElementById("hide_eye");
    hide_eye.classList.remove("d-none");
    if (x.type === "password") {
        x.type = "text";
        show_eye.style.display = "none";
        hide_eye.style.display = "block";
    } else {
        x.type = "password";
        show_eye.style.display = "block";
        hide_eye.style.display = "none";
    }
}

</script>