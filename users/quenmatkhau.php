<?php
include('../db/connect.php');
?>
<?php
$loi = '';
if(isset($_POST['btnQuenMatKhau'])) {
    $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";  
    $email = $_POST['email'];
    $sql = mysqli_query($mysqli,"SELECT * FROM tbl_khachhang_account WHERE email='$email'");
    $count = mysqli_num_rows($sql);
    
    if (!preg_match ($pattern, $email) ){  
        $loi= "Email không hợp lệ";  
    } else {
        if($count == 0) {
            $loi = 'Email không tồn tại!';
        }
        else {
            $loi = '';
            $matkhaumoi = substr(md5(rand(0,99999)), 0, 8);
            $sql_update = mysqli_query($mysqli,"UPDATE tbl_khachhang_account SET matkhau='$matkhaumoi' WHERE email='$email'");
            $kq = GuiMail($email,$matkhaumoi);
            if($kq) {
                echo "<script>document.location='index.php?quanly=thongbaouser'</script>";
            }
        }
    }  
}
?>
<?php
function GuiMail($email,$matkhaumoi) {
  require "PHPMailer-master/src/PHPMailer.php"; 
    require "PHPMailer-master/src/SMTP.php"; 
    require 'PHPMailer-master/src/Exception.php'; 
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);//true:enables exceptions
    try {
        $mail->SMTPDebug = 0; //0,1,2: chế độ debug. khi chạy ngon thì chỉnh lại 0 
        $mail->isSMTP();  
        $mail->CharSet  = "utf-8";
        $mail->Host = 'smtp.gmail.com';  //SMTP servers
        $mail->SMTPAuth = true; // Enable authentication
        $mail->Username = 'nguyenbaloi2407@gmail.com'; // SMTP username
        $mail->Password = 'jfhkbbxobpzuwuow';   // SMTP password
        $mail->SMTPSecure = 'ssl';  // encryption TLS/SSL 
        $mail->Port = 465;  // port to connect to                
        $mail->setFrom('nguyenbaloi2407@gmail.com', 'Loi' ); 
        $mail->addAddress($email); //mail và tên người nhận  
        $mail->isHTML(true);  // Set email format to HTML
        $mail->Subject = 'Thư quên mật khẩu';
        $noidungthu =" <h4>Mật khẩu mới của bạn là:</h4>
          <p>{$matkhaumoi} * Vui lòng đổi mật khẩu mới sau khi đăng nhập lại!</p>
        "; 
        $mail->Body = $noidungthu;
        $mail->smtpConnect( array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
                "allow_self_signed" => true
            )
        ));
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
    addEventListener("load", function() {
        setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
        window.scrollTo(0, 1);
    }
    </script>
    <!-- //Meta tag Keywords -->

    <!-- Custom-Files -->
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <!-- Bootstrap css -->
    <link href="../css/style.css" rel="stylesheet" type="text/css" media="all" />
    <!-- Main css -->
    <link rel="stylesheet" href="../css/fontawesome-all.css">
    <!-- Font-Awesome-Icons-CSS -->
    <link href="../css/popuo-box.css" rel="stylesheet" type="text/css" media="all" />
    <!-- pop-up-box -->
    <link href="../css/menu.css" rel="stylesheet" type="text/css" media="all" />
    <!-- menu style -->
    <!-- //Custom-Files -->

    <!-- web fonts -->
    <link
        href="//fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i&amp;subset=latin-ext"
        rel="stylesheet">
    <link
        href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese"
        rel="stylesheet">
    <!-- //web fonts -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <title>Dashboard</title>
</head>
<body>
      <div class="container">
        <section class="vh-100 gradient-custom">
          <div class="container py-5 h-100">
            <div class="row justify-content-center align-items-center h-100">
              <div class="col-12 col-lg-9 col-xl-7">
                <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                  <div class="card-body p-4 p-md-5">
                    <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Quên mật khẩu?</h3>
                    <form method="POST">                
                      
                        <div class="row">
                            <div class="col-md-12 mb-4">
  
                            <div class="form-outline">
                                <label class="form-label" for="tendangnhap">Email</label>
                                <input  value="" type="text" id="email" name="email" class="form-control form-control-lg" placeholder="Nhập vào email"/>
                                <div id="loiemail" class="form-text text-danger"><?php echo $loi; ?></div>
                            </div>
  
                            </div>
                            <div class="col-md-12 ">
  
                            </div>
                            <div class="col-md-12 ">
  
                            </div>
                        </div>
  
                        <div class="mt-4 pt-2">
                        <input class="btn btn-primary btn-lg" type="submit" name="btnQuenMatKhau" value="Xác nhận" />
                        </div>
  
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      

</div>
</div>
</div>

    <!-- jquery -->
    <script src="../js/jquery-2.2.3.min.js"></script>
    <!-- //jquery -->    

    <!-- nav smooth scroll -->
    <script>
    $(document).ready(function() {
        $(".dropdown").hover(
            function() {
                $('.dropdown-menu', this).stop(true, true).slideDown("fast");
                $(this).toggleClass('open');
            },
            function() {
                $('.dropdown-menu', this).stop(true, true).slideUp("fast");
                $(this).toggleClass('open');
            }
        );
    });
    </script>

    <script src="../js/jquery.magnific-popup.js"></script>
    
    <script>

    function validatePassword() {
        var pass2 = document.getElementById("password2").value;
        var pass1 = document.getElementById("password1").value;
        if (pass1 != pass2)
            document.getElementById("password2").setCustomValidity("Passwords Don't Match");
        else
            document.getElementById("password2").setCustomValidity('');
    }
    </script>
    <script src="../js/scroll.js"></script>
    <script src="../js/jquery.flexslider.js"></script>
    <script>
    $(window).load(function() {
        $('.flexslider').flexslider({
            animation: "slide",
            controlNav: "thumbnails"
        });
    });
    </script>
    <script src="../js/SmoothScroll.min.js"></script>
    <script src="../js/move-top.js"></script>
    <script src="../js/easing.js"></script>
    <script>
    jQuery(document).ready(function($) {
        $(".scroll").click(function(event) {
            event.preventDefault();

            $('html,body').animate({
                scrollTop: $(this.hash).offset().top
            }, 1000);
        });
    });
    </script>
    <script>
    $(document).ready(function() {
        $().UItoTop({
            easingType: 'easeOutQuart'
        });

    });
    </script>
    <script src="../js/bootstrap.js"></script>

</body>
</html>
