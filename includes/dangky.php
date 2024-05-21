<?php
$errBirth=$errEmail=$errHoTen=$errPass=$errUN = '';
if(isset($_POST['btnDangKy'])) {
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
    ngaysinh='$ngaysinh',randomkey='$random_key'");
    $sql_select = mysqli_query($mysqli,"SELECT * FROM tbl_khachhang_account ORDER BY id DESC LIMIT 1");
    $row = mysqli_fetch_array($sql_select);
    $id_user = $row['id'];

    $sql_diachi = mysqli_query($mysqli,"INSERT INTO tbl_diachi SET user_id='$id_user'");
    echo "<script>alert('Đăng ký thành công')</script>";
      $hoten = '';
      $tendangnhap = '';
      $email = '';
      $phai = '';
      $ngaysinh = '';

    }
}
?>


<section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row justify-content-center align-items-center h-100">
      <div class="col-12 col-lg-9 col-xl-7">
        <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
          <div class="card-body p-4 p-md-5">
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Đăng Ký</h3>
            <form method="POST">
              <div class="row">
                <div class="col-md-12 mb-4">

                  <div class="form-outline">
                      <label class="form-label" for="hoten">Họ và tên</label>
                      <input value="<?php  if(isset($hoten)) echo $hoten; else echo ''; ?>" type="text" id="hoten" name="hoten" class="form-control form-control-lg" placeholder="Nhập họ tên người dùng"/>
                      <div class="form-text text-danger"><?= $errHoTen; ?></div>                         
                  </div>

                </div>
                <div class="col-md-12 mb-4">

                  <div class="form-outline">
                      <label class="form-label" for="tendangnhap">Tên đăng nhập</label>
                      <input onblur="check_un(this)" value="<?php  if(isset($tendangnhap)) echo $tendangnhap; else echo ''; ?>" type="text" id="tendangnhap" name="tendangnhap" class="form-control form-control-lg" placeholder="Nhập tên đăng nhập"/>
                      <div class="form-text text-danger"><?= $errUN; ?></div>
                  </div>

                </div>
                <div class="col-md-12 mb-4">

                  <div class="form-outline">
                      <label class="form-label" for="matkhau">Mật khẩu</label>
                      <input type="password" id="matkhau" name="matkhau" class="form-control form-control-lg" placeholder="Nhập mật khẩu" autocomplete="new-password"/>
                      <div class="form-text text-danger"><?= $errPass; ?></div>
                  </div>

                </div>
              </div>

              <div class="row">
                <div class="col-md-12 mb-4 d-flex align-items-center">

                  <div class="form-outline datepicker w-100">
                      <label for="ngaysinh" class="form-label">Ngày sinh</label>
                      <input value="<?php  if(isset($ngaysinh)) echo $ngaysinh; else echo ''; ?>" type="date" class="form-control form-control-lg" id="ngaysinh" name="ngaysinh"placeholder="Nhập ngày sinh"/>
                      <div class="form-text text-danger"><?= $errBirth; ?></div>
                  </div>

                </div>
                <div class="col-md-12 mb-4">

                  <h6 class="mb-2 pb-1">Giới tính: </h6>
                  <div class="form-check form-check-inline">
                      <label class="form-check-label" for="nu">Nữ</label>
                      <input  class="form-check-input" type="radio" name="phai" id="nu" value="0" checked/>
                  </div>
                  <div class="form-check form-check-inline">
                      <label class="form-check-label" for="nam">Nam</label>
                      <input  class="form-check-input" type="radio" name="phai" id="nam" value="1" />
                  </div>
                </div>

                <div class="col-md-12 mb-4 pb-2">
                    <div class="form-outline">
                        <label class="form-label" for="email">Email</label>
                        <input onblur="check_email(this)" value="<?php  if(isset($email)) echo $email; else echo ''; ?>" type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Nhập email"/>
                        <div class="form-text text-danger"><?= $errEmail; ?></div>
                        <!-- <div id="loiemail" class="form-text text-danger"></div> -->
                    </div>    
                </div>
              </div>

              <div class="mt-4 pt-2">
                <input class="btn btn-primary btn-lg" type="submit" name="btnDangKy" value="Đăng ký" />
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  function check_un(obj) {
    var tendangnhap = obj.value;
    var url = "http://localhost/webdienmay2/includes/check_un.php?tendangnhap=" + tendangnhap;
    fetch(url)
    .then(d => d.json())
    .then(data => { // {"count":1}
      if(data.count>0) {
        document.getElementById('loidangnhap').innerHTML = "Tên đăng nhập "+tendangnhap+" đã được sử dụng";
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
          document.getElementById('loiemail').innerHTML = "Email "+email+" đã được sử dụng";
        } else {
          document.getElementById('loiemail').innerHTML = "Bạn có thể dùng email "+email;
        }
      })
    }
  }
</script>