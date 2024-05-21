<?php
if(isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = '';
}
$sql = mysqli_query($mysqli,"SELECT * FROM tbl_khachhang_account WHERE id='$id'");
$row = mysqli_fetch_array($sql);
if(isset($_POST['capnhattaikhoan'])) {
    $hoten = $_POST['hoten'];
    $email = $_POST['email'];
    $ngaysinh = $_POST['ngaysinh'];
    $phai = $_POST['phai'];
    $sql = mysqli_query($mysqli,"UPDATE tbl_khachhang_account SET hoten='$hoten',email='$email',ngaysinh='$ngaysinh',phai='$phai' WHERE id='$id'");
    
}
?>
<?php
$loi = '';
if(isset($_POST['doimatkhau'])) {
    $matkhaucu = md5($_POST['matkhaucu']);
    if($matkhaucu == '') {
        $loi = 'Chưa nhập mật khẩu';
    } else {
        $sql_select_admin = mysqli_query($mysqli,"SELECT * FROM tbl_khachhang_account WHERE id='$id' AND matkhau='$matkhaucu' ");
        $count = mysqli_num_rows($sql_select_admin);
        $row_danhnhap = mysqli_fetch_array($sql_select_admin);
        if($count>0) {
            echo "<script>document.location='dashboard.php?quanly=doimatkhau&id={$id}'</script>";
        } else {
            $loi = 'Mật khẩu sai';
        }
    }
}
?>
<div class="container mt-5">
    <div class="row gutters-sm">
        <div class="col-md-12 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                        <div class="mt-3">
                            <h4 class="mb-2"><?php echo $row['hoten']; ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if(isset($_GET['chinhsua'])) {
            
            ?>
             <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <?php
                        if(isset($_GET['doimatkhau'])) {
                            ?>
                            <form action="" method="POST">
                                <div class="form-group">
                                    <label for="">Mật khẩu cũ</label>
                                    <input type="password" class="form-control" id="" aria-describedby="" placeholder="Nhập mật khẩu" name="matkhaucu" >
                                    <p class="text-danger"><?php echo $loi; ?></p>
                                </div>                                
                                <button type="submit" class="btn btn-primary" name="doimatkhau">Tiếp tục</button>
                            </form>
                            <?php
                        } else {
                            ?>
                            <form action="" method="POST">
                                <div class="form-group">
                                    <label for="">Họ tên</label>
                                    <input type="text" class="form-control" id="" aria-describedby="" placeholder="Nhập họ tên" value="<?php echo $row['hoten'];?>" name="hoten" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" class="form-control" id="" placeholder="Nhập vào email" value="<?php echo $row['email']; ?>" name="email" required>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Ngày sinh</label>
                                        <input type="date" class="form-control" id="" placeholder="Nhập ngày sinh" name="ngaysinh" value="<?php echo $row['ngaysinh']; ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Phái</label>
                                        <select id="phai" name="phai" class="form-control">
                                            <option value="<?php echo $row['phai']; ?>" selected><?php if($row['phai']==0) echo 'Nữ'; else echo 'Nam'; ?></option>
                                            <option value="<?php if($row['phai']==0) echo '1'; elseif($row['phai']==1) echo '0' ?>">
                                                <?php if($row['phai']==0) echo 'Nam';elseif($row['phai']==1) echo 'Nữ'?>
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <a href="?quanly=taikhoanadmin&chinhsua&id=<?php echo $id; ?>&doimatkhau" class="d-block mt-2">Đổi mật khẩu?</a>
                                </div>
                                <button type="submit" class="btn btn-primary" name="capnhattaikhoan">Cập nhật</button>
                            </form>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php
        }
        else {
            ?>
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Họ tên</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                            <?php echo $row['hoten']; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                            <?php echo $row['email']; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Ngày sinh</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                            <?php echo $row['ngaysinh']; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Phái</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                            <?php if($row['phai']==0) echo 'Nữ';elseif($row['phai']==1) echo 'Nam'; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Cấp độ</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                            <?php if($row['idgroup']==1) echo 'Chủ cấp quyền';elseif($row['idgroup']==2) echo 'Quản trị';elseif($row['idgroup']==3) echo 'Nhân viên'; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Ngày đăng ký</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                            <?php echo $row['ngaydangky']; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <a class="btn btn-info " target="" href="?quanly=taikhoanadmin&chinhsua&id=<?php echo $id; ?>">Chỉnh sửa</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>    
    </div>
</div>
