<?php
if(isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = '';
}
$sql = mysqli_query($mysqli,"SELECT * FROM tbl_khachhang_account WHERE id='$id'");
$row = mysqli_fetch_array($sql);
?>
<?php
$errBirth = $errEmail = $errPass = $ErrMsg = $errMsg = $loi = '';
if(isset($_POST['capnhat'])) {
    $tendangnhap = $_POST['tendangnhap'];
    $hoten = $_POST['hoten'];
    $email = $_POST['email'];
    $phai = $_POST['phai'];
    $ngaysinh = $_POST['ngaysinh'];
    if(strlen($hoten)==0) {$ErrMsg="Chưa nhập vào họ tên";}
    if(strlen($tendangnhap)>100) {$errMsg = "Tên đăng nhập quá dài";}
    if(strlen($tendangnhap)<10) {$errMsg = "Tên đăng nhập quá ngắn";}
    if (!preg_match ("/^[a-zA-z]*$/", $tendangnhap)) {$errMsg = "Tên đăng nhập không chứa ký tự đặc biệt";}
    $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";  
    if (!preg_match ($pattern, $email) ){  
        $errEmail= "Email không hợp lệ";  
    }
    $sql_check_e = mysqli_query($mysqli,"SELECT * FROM tbl_khachhang_account WHERE email='$email'");
    $check_e = mysqli_num_rows($sql_check_e);
    if($check_e > 0) {
        $errEmail = "Email đã tồn tại hoặc được sử dụng! Vui lòng chọn Email khác";
    }
    if(empty($ngaysinh)) {$errBirth="Chưa nhập ngày sinh";}
    
    if($errBirth == '' && $errEmail == '' && $errPass == '' && $ErrMsg == '' && $errMsg == '') {
        $sql_update = mysqli_query($mysqli,"UPDATE tbl_khachhang_account SET tendangnhap='$tendangnhap',hoten='$hoten',email='$email',phai='$phai',ngaysinh='$ngaysinh' WHERE id='$id'");
        echo "<script>document.location='index.php?quanly=user&id={$id}&chinhsua'</script>";
    }
}
?>
<?php
if(isset($_POST['naptienBtn'])) {
    $tiennap = $_POST['tiennap'];
    $sql_naptien = mysqli_query($mysqli,"UPDATE tbl_khachhang_account SET sodutk=sodutk+$tiennap WHERE id='$id'");
    echo "<script>document.location='index.php?quanly=user&id={$id}&vitien'</script>";
    
}
?>
<div class="container py-xl-4 py-lg-2">
    <div class="row gutters-sm">
        <div class="col-md-12 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                        <!-- <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150"> -->
                        <div class="mt-3">
                            <h4 class="mb-3"><?php echo $row['hoten']; ?></h4>
                            <a href="?quanly=xemdonhang">
                                <button class="btn btn-primary">Xem đơn hàng</button>
                            </a>
                            <a href="?quanly=giohang">
                                <button class="btn btn-outline-primary">Xem giỏ hàng</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mb-2">
            <a href="?quanly=user&id=<?php echo $id; ?>&vitien" class="btn btn-warning">Ví tiền</a>
            <a href="?quanly=user&id=<?php echo $id; ?>" class="btn btn-dark">Xem thông tin</a>            
        </div>

        <?php
        if(isset($_GET['vitien'])) {
            ?>
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <?php
                        if(isset($_GET['vitien'])) {
                            ?>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Số dư tài khoản</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                <?php echo number_format($row['sodutk']).'vnđ'; ?>
                                </div>
                                <hr>
                                <div class="col-sm-12">
                                    <a href="?quanly=user&id=<?php echo $id; ?>&naptien" class="btn btn-info">Nạp tiền</a>
                                </div>
                            </div>                           
                            <?php
                        } 
                        ?>
                    </div>
                </div>
            </div>
            <?php
        } elseif(isset($_GET['naptien'])) {
            ?>
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Số dư tài khoản</h6>
                                </div>
                                <div class="col-sm-9">
                                <input type="number" min="1" placeholder="Nhập số tiền cần nạp" class="border-0 w-100 text-secondary" name="tiennap">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12">
                                    <input type="submit" class="btn btn-primary" name="naptienBtn" value="Nạp tiền" id="btnCapNhat">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php
        } else {
            if(isset($_GET['chinhsua'])) {
                ?>
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Họ tên</h6>
                                        </div>
                                        <div class="col-sm-9">
                                        <input type="text" placeholder="Nhập họ tên" value="<?php echo $row['hoten']; ?>" class="border-0 w-100 text-secondary" name="hoten">
                                        <div class="form-text text-danger"><?= $ErrMsg; ?></div> 
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Email</h6>
                                        </div>
                                        <div class="col-sm-9">
                                        <input onsubmit="check_email(this)" type="email" placeholder="Nhập email" value="<?php echo $row['email']; ?>" class="border-0 w-100 text-secondary" name="email">
                                        <div class="form-text text-danger"><?= $errEmail; ?></div> 
                                        <p id="loiemail" class="text-danger"></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Ngày sinh</h6>
                                        </div>
                                        <div class="col-sm-9">
                                        <input type="date" placeholder="Nhập ngày sinh" value="<?php echo $row['ngaysinh']; ?>" class="border-0 w-100 text-secondary" name="ngaysinh">
                                        <div class="form-text text-danger"><?= $errBirth; ?></div> 
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Phái</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label"><?php if($row['phai']==0) echo 'Nữ';elseif($row['phai']==1) echo 'Nam'; ?></label>
                                                <input  class="form-check-input" type="radio" name="phai" value="<?php if($row['phai']==0) echo '0';elseif($row['phai']==1) echo '1'; ?>" checked/>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label"><?php if($row['phai']==0) echo 'Nam';elseif($row['phai']==1) echo 'Nữ'; ?></label>
                                                <input  class="form-check-input" type="radio" name="phai" value="<?php if($row['phai']==0) echo '1';elseif($row['phai']==1) echo '0'; ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <input type="submit" class="btn btn-primary" name="capnhat" value="Cập nhật" id="btnCapNhat">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php
            } 
            elseif(isset($_GET['doimatkhau'])) {
                $loi = '';
                if(isset($_POST['doimatkhau'])) {
                    $matkhau = $_POST['matkhaumoi'];
                    if(strlen($matkhau)<6) {$loi.="Mật khẩu quá ngắn<br/>";}
                    $matkhaumoi = md5($matkhau);
                    $sql_doimatkhau = mysqli_query($mysqli,"UPDATE tbl_khachhang_account SET matkhau='$matkhaumoi' WHERE id='$id'");
                    
                }
                ?>
                <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-body">
                                <?php
                                    if ($loi != '') {
                                    ?>
                                    <div class="alert alert-danger">
                                    <?php echo $loi; ?>
                                    </div>
                                    <?php
                                    }
                                ?>
                                <form action="" method="post">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0 form-control border-0">Mật khẩu mới</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                        <input type="password" placeholder="Mật khẩu mới" class="form-control" name="matkhaumoi">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <input type="submit" class="btn btn-primary" name="doimatkhau" value="Cập nhật" id="btnCapNhat">
                                        </div>
                                    </div>
                                </form>
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
                                <div class="col-sm-9 text-secondary" contenteditable>
                                <?php echo $row['hoten']; ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Tên đăng nhập</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                <?php echo $row['tendangnhap']; ?>
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
                                <?php  if($row['phai'] == 0) {echo 'Nữ';} else {echo 'Nam';} ?>
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
                            <div class="row d-inline">
                                <div class="col-sm-12 d-inline">
                                    <a class="btn btn-info " href="?quanly=user&id=<?php echo $id; ?>&chinhsua"> Chỉnh sửa</a>
                                </div>
                                <div class="col-sm-12 d-inline">
                                    <a class="btn btn-info " href="?quanly=user&id=<?php echo $id; ?>&doimatkhau"> Đổi mật khẩu</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        ?> 
    </div>
</div>
<script>
  
  function check_un(obj) {
    var tendangnhap = obj.value;
    var url = "http://localhost/webdienmay2/includes/check_un.php?tendangnhap=" + tendangnhap;
    fetch(url)
    .then(d => d.json())
    .then(data => { // {"count":1}
      if(data.count>0) {
        document.getElementById('loidangnhap').innerHTML = "Tên đăng nhập "+tendangnhap+" đã được sử dụng";
        document.getElementById('btnCapNhat').type = "button";
      } else {
        document.getElementById('loidangnhap').innerHTML = "Bạn có thể dùng tên "+tendangnhap;
      }
    })
  }
  function check_email(obj) {
    var email = obj.value;
    const regexp = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if(email=='') {
      document.getElementById('loiemail').innerHTML = "Bạn chưa nhập Email";
    } else if(!email.match(regexp)) {
      document.getElementById('loiemail').innerHTML = "Email nhập vào chưa đúng";
    } else {
      var url = "http://localhost/webdienmay2/includes/check_email.php?email=" + email;
      fetch(url)
      .then(d => d.json())
      .then(data => { // {"count":1}
        if(data.count>0) {
          document.getElementById('loiemail').innerHTML = "Email "+email+" đã tồn tại hoặc đã được sử dụng";
          document.getElementById('btnCapNhat').type = "button";
        } else {
          document.getElementById('loiemail').innerHTML = "Bạn có thể dùng email "+email;
        }
      })
    }
  }
</script>