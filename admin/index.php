<?php
session_start();
include('../db/connect.php');
?>
<?php
if(isset($_POST['dangnhap'])) {
    $taikhoan = $_POST['tendangnhap'];
    $matkhau = md5($_POST['matkhau']);
    if($taikhoan == '' || $matkhau == '') {
        echo 'Xin nhập đủ để đăng nhập';
    } else {
      $sql_select = mysqli_query($mysqli,"SELECT * FROM tbl_khachhang_account WHERE tendangnhap='$taikhoan'");
      $count = mysqli_num_rows($sql_select);
      if($count > 0) {
        $row_danhnhap = mysqli_fetch_array($sql_select);
        $idgroup = $row_danhnhap['idgroup'];
        if($taikhoan==$row_danhnhap['tendangnhap'] && $matkhau==$row_danhnhap['matkhau'] && $idgroup > 0) {
          $_SESSION['dangnhap'] = $row_danhnhap['hoten'];
          $_SESSION['admin_id'] = $row_danhnhap['id'];
          $_SESSION['idgroup'] = $row_danhnhap['idgroup'];
          header('Location: dashboard.php');
        } else {
            echo "<script>alert('Tài khoản hoặc mật khẩu sai')</script>";
        }
      } else {
        echo "<script>alert('Tài khoản hoặc mật khẩu sai')</script>";
      }
      
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <title>Đăng nhâp Admin</title>
</head>

<body>
    <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5 text-center">
              <h4 >ĐĂNG NHẬP</h4>
              <form class="pt-3" method="POST">
                <div class="form-group">
                  <input type="text" name="tendangnhap" class="form-control form-control-lg" id="" placeholder="Tên đăng nhập">
                </div>
                <div class="form-group">
                  <input type="password" name="matkhau" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Mật khẩu">
                </div>
                <div class="mt-3">
                    <input type="submit" name="dangnhap" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" value="Đăng nhập">
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                  </div>
                  <!-- <a href="../users/quenmatkhau.php" class="auth-link text-black">Quên mật khẩu?</a> -->
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
</body>

</html>