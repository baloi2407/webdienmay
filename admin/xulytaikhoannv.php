<?php
$errBirth=$errEmail=$errHoTen=$errPass=$errUN = '';
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
    $random_key = substr(md5(rand(0,99999)), 0, 20);
    $sql_dangky = mysqli_query($mysqli,"INSERT INTO tbl_khachhang_account SET tendangnhap='$tendangnhap',matkhau='$matkhau',hoten='$hoten',email='$email',phai='$phai',
    ngaysinh='$ngaysinh',randomkey='$random_key',idgroup=3");
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
        $tendangnhap = $_POST['tendangnhap'];
        $hoten = $_POST['hoten'];
        $matkhau = md5($_POST['matkhau']);
        $email = $_POST['email'];
        $phai = $_POST['phai'];
        $ngaysinh = $_POST['ngaysinh'];
        $nhomquyen = $_POST['nhomquyen'];
        if(strlen($tendangnhap)==0) {$loi.="Tên đăng nhập chưa nhập vào<br/>";}
        if(strlen($tendangnhap)<6) {$loi.="Tên đăng nhập quá ngắn<br/>";}
        if(strlen($matkhau)<6) {$loi.="Mật khẩu quá ngắn<br/>";}
        
        if($loi == '') {
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
        $taikhoankh = $_POST['taikhoankh'];
        $quanlyslider = $_POST['quanlybanner'];


        if($quanlybv == '' || $quanlydh == '' || $quanlysp == '' || $quanlykh == '' || $taikhoankh == '' || $quanlyslider == '') {
            $loi.="Vui lòng xác minh để cập nhật<br/>";
        }
        if($loi == '') {
            $select = mysqli_query($mysqli,"SELECT * FROM tbl_quyen WHERE user_id='$id'");
            $count = mysqli_num_rows($select);
            if($count > 0) {
                $sql_update = mysqli_query($mysqli,"UPDATE tbl_quyen SET quanlyslider= '$quanlyslider' ,quanlysp='$quanlysp',quanlybaiviet='$quanlybv',quanlydonhang='$quanlydh',quanlykh='$quanlykh',taikhoankh='$taikhoankh' WHERE user_id='$id'");
            } else {
                $sql = mysqli_query($mysqli,"INSERT INTO tbl_quyen (user_id,quanlysp,quanlybaiviet,quanlydonhang,quanlykh,takhoankh,quanlyslider) 
                VALUES('$id','$quanlysp','$quanlybv','$quanlydh','$quanlykh','$taikhoankh','$quanlyslider')");
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
                        <h4>Chi tiết tài khoản</h4>
                        <div class="row">
                            <div class="col-md-6 mb-1">
                                <label for="" class="font-weight-bold">Tên tài khoản</label>
                                <p class="text-dark border border-secondary p-1"><?php echo $row['tendangnhap']; ?></p>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label for="" class="font-weight-bold">Họ tên</label>
                                <p class="text-dark border border-secondary p-1"><?php echo $row['hoten']; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-1">
                                <label for="" class="font-weight-bold">Ngày sinh</label>
                                <p class="text-dark border border-secondary p-1"><?php echo $row['ngaysinh']; ?></p>
                            </div>
                                <div class="col-md-6 mb-1"><label for="">Phái</label>
                                <p class="text-dark border border-secondary p-1"><?php if($row['phai']==0) echo 'Nữ';elseif($row['phai']==1) echo 'Nam'; ?></p></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-1">
                                <label for="" class="font-weight-bold">Email</label>
                                <p class="text-dark border border-secondary p-1"><?php echo $row['email']; ?></p>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label for="" class="font-weight-bold">Ngày đăng ký</label>
                                <p class="text-dark border border-secondary p-1"><?php echo $row['ngaydangky']; ?></p>
                            </div>
                        </div> 
                        <label for="" class="font-weight-bold">Nhóm quyền</label>
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
                     <div class="col-md-4">
                        <h4>Cập nhật tài khoản</h4>
                        <form action="" method="post">
                            <?php
                                if ($loi != '') {
                                ?>
                                <div class="alert alert-danger">
                                <?php echo $loi; ?>
                                </div>
                                <?php
                                }
                            ?>
                            <label for="" class="font-weight-bold">Tên tài khoản</label>
                            <input  value="<?php echo $row['tendangnhap'];?>" type="text" class="form-control" name="tendangnhap" placeholder="Tên tài khoản" >
                            <!-- <div class="text text-danger"><?php echo $tendangnhapErr; ?></div> -->
                            <label for="" class="font-weight-bold">Họ tên</label>
                            <input value="<?php echo $row['hoten'];?>" type="text" class="form-control" name="hoten" placeholder="Họ tên" >
                            <label for="" class="font-weight-bold">Email</label>
                            <input value="<?php echo $row['email'];?>" type="text" class="form-control" name="email" placeholder="Email" ><br>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                                </div>
                                <input name="matkhau" type="password" value="<?php echo $row['matkhau'];?>" class="input form-control" id="matkhau" placeholder="Mật khẩu" required="true" aria-label="password" aria-describedby="basic-addon1" />
                                <div class="input-group-append">
                                    <span class="input-group-text" onclick="password_show_hide();">
                                    <i class="fas fa-eye" id="show_eye"></i>
                                    <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                                    </span>
                                </div>
                            </div>
                            <label for="" class="font-weight-bold">Ngày sinh</label>
                            <input value="<?php echo $row['ngaysinh'];?>" type="date" class="form-control" name="ngaysinh" placeholder="Ngày sinh" >
                            
                            <label for="" class="font-weight-bold">Phái</label>
                            <select id="phai" name="phai" class="form-control">
                                <option value="<?php echo $row['phai']; ?>" selected><?php if($row['phai']==0) echo 'Nữ'; else echo 'Nam'; ?></option>
                                <option value="0">Nữ</option>
                                <option value="1">Nam</option>
                            </select>
                            <select name="nhomquyen" id="" class="form-control mt-2">
                                <option value="">--Chọn nhóm quyền--</option>
                                <option value="2">Quản trị viên</option>
                                <option value="3">Nhân viên</option>
                            </select>
                            <input type="submit" value="Câp nhật tài khoản" name="capnhattaikhoan" class="btn btn-success mt-2">
                        </form>
                    </div>
                    <?php
                } elseif($temp=='capquyen') {
                    $id = $_GET['id'];
                    $sql = mysqli_query($mysqli,"SELECT * FROM tbl_khachhang_account WHERE id='$id'");
                    $row = mysqli_fetch_array($sql);
                    ?>
                     <div class="col-md-12">
                        <h4>Cấp quyền tài khoản</h4>
                        <?php
                            if ($loi != '') {
                            ?>
                            <div class="alert alert-danger">
                            <?php echo $loi; ?>
                            </div>
                            <?php
                            }
                        ?>
                        <?php
                        $id = $_GET['id'];
                        $sql = mysqli_query($mysqli,"SELECT * FROM tbl_quyen WHERE user_id='$id'");
                        $row = mysqli_fetch_array($sql);
                        $count = mysqli_num_rows($sql);
                        if($count > 0) {
                            ?>
                            <form action="" method="post">
                                <div class="row">
                                    <div class="col-md-6 mb-1">
                                        <label for="" class="font-weight-bold">Quản lý sản phẩm</label>
                                        <select name="quyenquanlysp" id="" class="form-control">
                                            <option value="<?php echo $row['quanlysp'] ?>"><?php if($row['quanlysp']==0) echo 'Không cho phép';elseif($row['quanlysp']==1) echo 'Cho phép'; ?></option>
                                            <?php
                                            if($row['quanlysp']==0) {
                                                ?>
                                                <option value="1">Cho phép</option>
                                                <?php
                                            } elseif($row['quanlysp']==1) {
                                                ?>
                                                <option value="0">Không cho phép</option>
                                                <?php
                                            }
                                            ?>                                    
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <label for="" class="font-weight-bold">Quản lý bài viết</label>
                                        <select name="quyenquanlybv" id="" class="form-control">
                                            <option value="<?php echo $row['quanlybaiviet'] ?>"><?php if($row['quanlybaiviet']==0) echo 'Không cho phép';elseif($row['quanlybaiviet']==1) echo 'Cho phép'; ?></option>
                                            <?php
                                            if($row['quanlybaiviet']==0) {
                                                ?>
                                                <option value="1">Cho phép</option>
                                                <?php
                                            } elseif($row['quanlybaiviet']==1) {
                                                ?>
                                                <option value="0">Không cho phép</option>
                                                <?php
                                            }
                                            ?>   
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-1">
                                        <label for="" class="font-weight-bold">Quản lý đơn hàng</label>
                                        <select name="quyenquanlydh" id="" class="form-control">
                                            <option value="<?php echo $row['quanlydonhang'] ?>"><?php if($row['quanlydonhang']==0) echo 'Không cho phép';elseif($row['quanlydonhang']==1) echo 'Cho phép'; ?></option>
                                            <?php
                                            if($row['quanlydonhang']==0) {
                                                ?>
                                                <option value="1">Cho phép</option>
                                                <?php
                                            } elseif($row['quanlydonhang']==1) {
                                                ?>
                                                <option value="0">Không cho phép</option>
                                                <?php
                                            }
                                            ?>   
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <label for="" class="font-weight-bold">Quản lý khách hàng</label>
                                        <select name="quyenquanlykh" id="" class="form-control">
                                            <option value="<?php echo $row['quanlykh'] ?>"><?php if($row['quanlykh']==0) echo 'Không cho phép';elseif($row['quanlykh']==1) echo 'Cho phép'; ?></option>
                                            <?php
                                            if($row['quanlykh']==0) {
                                                ?>
                                                <option value="1">Cho phép</option>
                                                <?php
                                            } elseif($row['quanlykh']==1) {
                                                ?>
                                                <option value="0">Không cho phép</option>
                                                <?php
                                            }
                                            ?>   
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-1">
                                        <label for="" class="font-weight-bold">Tài khoản khách hàng</label>
                                        <select name="taikhoankh" id="" class="form-control">
                                            <option value="<?php echo $row['taikhoankh'] ?>"><?php if($row['taikhoankh']==0) echo 'Không cho phép';elseif($row['taikhoankh']==1) echo 'Cho phép'; ?></option>
                                            <?php
                                            if($row['taikhoankh']==0) {
                                                ?>
                                                <option value="1">Cho phép</option>
                                                <?php
                                            } elseif($row['taikhoankh']==1) {
                                                ?>
                                                <option value="0">Không cho phép</option>
                                                <?php
                                            }
                                            ?>   
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <label for="" class="font-weight-bold">Quản lý Banner</label>
                                        <select name="quanlybanner" id="" class="form-control">
                                            <option value="<?php echo $row['quanlyslider'] ?>"><?php if($row['quanlyslider']==0) echo 'Không cho phép';elseif($row['quanlyslider']==1) echo 'Cho phép'; ?></option>
                                            <?php
                                            if($row['quanlyslider']==0) {
                                                ?>
                                                <option value="1">Cho phép</option>
                                                <?php
                                            } elseif($row['quanlyslider']==1) {
                                                ?>
                                                <option value="0">Không cho phép</option>
                                                <?php
                                            }
                                            ?>   
                                        </select>
                                    </div>
                                </div>
                                
                                
                                
                                
                                <input type="submit" value="Câp nhật tài khoản" name="capquyentaikhoan" class="btn btn-success mt-2">
                            </form>
                            <?php
                        } else {
                            ?>
                            <form action="" method="post">
                                <label for="" class="font-weight-bold">Quản lý sản phẩm</label>
                                <select name="quyenquanlysp" id="" class="form-control">
                                    <option value="">--Xác minh--</option>
                                    <option value="0">Không cho phép</option>
                                    <option value="1">Cho phép</option>
                                </select>
                                <label for="" class="font-weight-bold">Quản lý bài viết</label>
                                <select name="quyenquanlybv" id="" class="form-control">
                                    <option value="">--Xác minh--</option>
                                    <option value="0">Không cho phép</option>
                                    <option value="1">Cho phép</option>
                                </select>
                                <label for="" class="font-weight-bold">Quản lý đơn hàng</label>
                                <select name="quyenquanlydh" id="" class="form-control">
                                    <option value="">--Xác minh--</option>
                                    <option value="0">Không cho phép</option>
                                    <option value="1">Cho phép</option>
                                </select>
                                <label for="" class="font-weight-bold">Quản lý khách hàng</label>
                                <select name="quyenquanlykh" id="" class="form-control">
                                    <option value="">--Xác minh--</option>
                                    <option value="0">Không cho phép</option>
                                    <option value="1">Cho phép</option>
                                </select>
                                <label for="" class="font-weight-bold">Tài khoản khách hàng</label>
                                <select name="taikhoankh" id="" class="form-control">
                                    <option value="">--Xác minh--</option>
                                    <option value="0">Không cho phép</option>
                                    <option value="1">Cho phép</option>
                                </select>
                                
                                <input type="submit" value="Câp nhật tài khoản" name="capquyentaikhoan" class="btn btn-success mt-2">
                            </form>
                            <?php
                        }
                        ?>
                        
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="col-md-12">
                        <h4 class="mb-2">Thêm tài khoản nhân viên</h4>
                        <?php
                        if(isset($_GET['themtaikhoan'])) {
                        ?>
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-md-6 mb-1">
                                    <label class="font-weight-bold" for="">Tên tài khoản</label>
                                    <input type="text" class="form-control" name="tendangnhap" placeholder="Tên tài khoản" value="<?php  if(isset($tendangnhap)) echo $tendangnhap;?>" >
                                    <p class="text text-danger"><?= $errUN; ?></p>
                                </div>
                                <div class="col-md-6 mb-1">
                                    <label class="font-weight-bold" for="">Họ tên</label>
                                    <input type="text" class="form-control" name="hoten" placeholder="Họ tên" value="<?php  if(isset($hoten)) echo $hoten;?>">
                                    <p class="text text-danger"><?= $errHoTen; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-1">
                                    <label class="font-weight-bold" for="">Ngày sinh</label>
                                    <input type="date" class="form-control" name="ngaysinh" placeholder="Ngày sinh" value="<?php  if(isset($ngaysinh)) echo $ngaysinh;?>">
                                    <p class="text text-danger"><?= $errBirth; ?></p>
                                </div>
                                <div class="col-md-6 mb-1">
                                    <label class="font-weight-bold" for="">Phái</label>
                                    <select id="phai" name="phai" class="form-control">
                                        <option value="0">Nữ</option>
                                        <option value="1">Nam</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-1">
                                    <label class="font-weight-bold" for="">Email</label>
                                    <input type="text" class="form-control" name="email" placeholder="Email" value="<?php  if(isset($email)) echo $email;?>">
                                    <p class="text text-danger"><?= $errEmail; ?></p>
                                </div>
                            </div>
                            <label class="font-weight-bold" for="">Mật khẩu</label>
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
                            <a href="dashboard.php?quanly=xulytaikhoannv&themtaikhoan" class="btn btn-success">Thêm tài khoản</a>
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
                $sql_select = mysqli_query($mysqli,"SELECT * FROM tbl_khachhang_account WHERE id!=$id_session AND idgroup=3 ORDER BY id DESC LIMIT $begin,5");
                ?>
                <table class="table table-bordered">
                    <tr>
                        <td>Thứ tự</td>
                        <td>Tên tài khoản</td>
                        <td>Họ tên</td>
                        <td>Email</td>
                        <td>Phái</td>
                        <td>Quản lý</td>
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
                            <a href="?quanly=xulytaikhoannv&xoa&id=<?php echo $row_select['id']; ?>" class="">
                            <span class="pl-2 pr-2 pt-1 pb-1 roundeded bg-danger text-white"><i class="fa fa-close"></i></span>
                            </a>
                            <a href="?quanly=xulytaikhoannv&trangthai=chitiet&id=<?php echo $row_select['id']; ?>" class="">
                            <span class="pl-2 pr-2 pt-1 pb-1 roundeded bg-info text-white"><i class="fa fa-search"></i></span>
                            </a>
                            <a href="?quanly=xulytaikhoannv&trangthai=capquyen&id=<?php echo $row_select['id']; ?>"class="">
                            <span class="pl-2 pr-2 pt-1 pb-1 roundeded bg-success text-white"><i class="fa fa-unlock-alt"></i></span>
                            </a> 
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </table>
                <nav aria-label="Page navigation example" class="mx-auto" style="width:300px;">
                    <?php
                    $sql_trang = mysqli_query($mysqli,"SELECT * FROM tbl_khachhang_account WHERE id!=$id_session AND idgroup=3 ORDER BY id DESC");
                    $row_count = mysqli_num_rows($sql_trang);
                    $trang = ceil($row_count/5);
                    if($trang > 1) {
                    ?>
                    <ul class="pagination">
                        <li class="page-item">
                        <a class="page-link" href="?quanly=xulytaikhoannv&trang=<?php $trang_previous = $trang_active-1; if($trang_previous>1) echo $trang_previous; else echo 1; ?>" aria-label="">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                        </li>
                        <?php
                        for($i=1;$i<=$trang;$i++) {
                        ?>
                        <li class="page-item <?php if($trang_active==$i) echo 'active'; ?>"><a class="page-link" href="?quanly=xulytaikhoannv&trang=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php
                        }
                        ?>
                        <li class="page-item">
                        <a class="page-link" 
                        href="?quanly=xulytaikhoannv&trang=<?php $trang_next = $trang_active+1; if($trang_next<=$trang) echo $trang_next; else echo $trang; ?>">
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