<?php
session_start();
if(!isset($_SESSION['dangnhap'])) {
    header('Location: index.php');
}
?>
<?php
include('../db/connect.php');
?>
<?php
if(isset($_GET['login'])) {
    $dangxuat = $_GET['login'];
} else {
    $dangxuat = '';
}
if($dangxuat == 'dangxuat') {
    unset($_SESSION['dangnhap']);
    header('Location:index.php');
}
?>
<?php
    if(isset($_GET['danhmuc']) || isset($_GET['endday'])) {
        $startday = $_GET['startday'];
        $endday = $_GET['endday'];
    } else {
        $startday = '';
        $endday = '';
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
    <?php
    include('./menu.php');
    if(isset($_GET['quanly'])) {
		$temp = $_GET['quanly'];
	} else {
		$temp = '';
	}
    if($temp == 'xulysanpham') {
        include('./xulysanpham.php');
    } elseif($temp == 'xulydanhmuc') {
        include('./xulydanhmuc.php');
    } elseif($temp == 'xulybaiviet') {
        include('./xulybaiviet.php');
    } elseif($temp == 'danhmucbaiviet') {
        include('./xulydanhmucbaiviet.php');
    } elseif($temp == 'xulytaikhoankh') {
        include('./xulytaikhoankh.php');
    } elseif($temp == 'xulydonhang') {
        include('./xulydonhang.php');
    } elseif($temp == 'xulykhachhang') {
        include('./xulykhachhang.php');
    } elseif($temp == 'taikhoanadmin') {
        include('./taikhoanadmin.php');
    } elseif($temp == 'doimatkhau') {
        include('./doimatkhau.php');
    } 
    ?>
    <div class="container py-xl-4 py-lg-2">
        <div class="col-md-12">
            <form action="" method="get">
                <div class="row">
                    
                    <div class="col-md-3">
                        <input type="date" class="form-control" placeholder="Từ ngày:" name="startday" id="" required>
                    </div>
                    <div class="col-md-3">
                        <input type="date" class="form-control" placeholder="Đến ngày:" name="endday" id="" required>
                    </div>
                    <div class="col-md-3">
                        <input type="submit" class="btn btn-primary" value="Tìm kiếm" id="btnTim">
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-12">
            <h4 class="mt-2 mb-2">Bảng thống kê</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Thứ tự</th>
                        <th>Danh mục</th>
                        <th>Số lượng bán ra</th>
                        <th>Tổng tiền</th>
                    </tr>
                </thead>
                <?php
                $i = 0;
                $sql__ = mysqli_query($mysqli,"SELECT tbl_thongkesp.danhmuc_ten,tbl_thongkesp.danhmuc_id,sum(tbl_thongkesp.tongtien) as tong, 
                sum(tbl_thongkesp.soluong) as soluong FROM tbl_thongkesp
                 WHERE tbl_thongkesp.ngaythang BETWEEN '$startday' AND '$endday' GROUP BY tbl_thongkesp.danhmuc_id ORDER BY ngaythang DESC;");

                while($row = mysqli_fetch_array($sql__)) {
                    $i++;
                    ?>
                        <tbody>
                            <td><?php echo $i; ?></td>
                            <td>
                            <?php echo $row['danhmuc_ten']; ?>
                                
                            </td>
                            <td><?php echo $row['soluong']; ?></td>
                            <td><?php echo number_format( $row['tong']).'vnđ'; ?></td>
                        </tbody>
                    <?php
                }
                ?>
            
            </table>
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
