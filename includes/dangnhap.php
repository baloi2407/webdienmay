<?php
$errMsg = $errPass = '';
if (isset($_POST['btnDangNhap'])) {
    $tendangnhap = $_POST['tendangnhap'];
    $matkhau = md5($_POST['matkhau']);
    $sql_select = mysqli_query($mysqli,"SELECT * FROM tbl_khachhang_account WHERE tendangnhap='$tendangnhap'");
    $count = mysqli_num_rows($sql_select);
    if($count) {
        $user = mysqli_fetch_array($sql_select);
        if($user['matkhau'] == $matkhau) {
          $_SESSION['login_id'] = $user['id'];
          $_SESSION['login_user'] = $tendangnhap;
          $_SESSION['login_hoten'] = $user['hoten'];
          echo "<script>window.location.assign('index.php')</script>";
        } else {
          $errPass = "Mật khẩu nhập vào không đúng!";
        }
    } 
    else { // Đăng nhập sai
        $errMsg = "Tên đăng nhập không tồn tại!";
    }
}
?>

<section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row justify-content-center align-items-center h-100">
      <div class="col-12 col-lg-9 col-xl-7">
        <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
          <div class="card-body p-4 p-md-5">
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Đăng Nhập</h3>
            <form method="POST">                
               
                <div class="row">
                    <div class="col-md-12 mb-4">

                    <div class="form-outline">
                        <label class="form-label" for="tendangnhap">Tên đăng nhập</label>
                        <input  value="<?php if(isset($tendangnhap)) echo $tendangnhap; ?>" type="text" id="tendangnhap" name="tendangnhap" class="form-control form-control-lg" placeholder="Nhập tên đăng nhập"/>
                        <!-- <div id="loidangnhap" class="form-text text-danger"></div> -->
                        <div class="form-text text-danger"><?= $errMsg; ?></div>
                    </div>

                    </div>
                    <div class="col-md-12 mb-4">

                    <div class="form-outline">
                        <label class="form-label" for="matkhau">Mật khẩu</label>
                        <input type="password" id="matkhau" name="matkhau" class="form-control form-control-lg" placeholder="Nhập mật khẩu" autocomplete="new-password"/>
                        <div class="form-text text-danger"><?= $errPass; ?></div>
                    </div>

                    </div>
                    <div class="col-md-12 mb-1">

                    <div class="form-outline">
                        <a href="./users/quenmatkhau.php">Quên mật khẩu?</a>
                    </div>

                    </div>
                </div>

                <div class="mt-4 pt-2">
                <input class="btn btn-primary btn-lg" type="submit" name="btnDangNhap" value="Đăng nhập" />
                </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
