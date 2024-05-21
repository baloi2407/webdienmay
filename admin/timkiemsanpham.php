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
    if(isset($_GET['trang'])) {
        $trang_active = $_GET['trang'];
    } else {
        $trang_active = '1';
    }
    if($trang_active == '' || $trang_active == 1) {
        $begin = 0;
    } else {
        $begin = ($trang_active*3)-3;
    }
    if(isset($_GET['tensanpham']) || isset($_GET['danhmuc']) || isset($_GET['gia'])) {
        $danhmuc = $_GET['danhmuc'];
        $gia = $_GET['gia'];
        $tensanpham = $_GET['tensanpham'];
    } else {
        $danhmuc = '';
        $gia = '';
        $tensanpham = '';
    }
    if($danhmuc == '' && $gia == '' && $tensanpham == '') {
        $gia = '';
        $sql = "SELECT * FROM tbl_sanpham,tbl_danhmuc WHERE tbl_sanpham.danhmuc_id=tbl_danhmuc.danhmuc_id ORDER BY sanpham_id DESC LIMIT $begin,3";
        $sql_sanpham = mysqli_query($mysqli,$sql);
    } 
    elseif($danhmuc != '' && $gia == '' && $tensanpham == '') {
        $sql = "SELECT * FROM tbl_sanpham,tbl_danhmuc WHERE tbl_sanpham.danhmuc_id='$danhmuc' AND tbl_sanpham.danhmuc_id=tbl_danhmuc.danhmuc_id LIMIT $begin,3";
        $sql_sanpham = mysqli_query($mysqli,$sql);
    } 
    elseif($gia != '' && $danhmuc == '' && $tensanpham == '') {
        $sql = "SELECT * FROM tbl_sanpham,tbl_danhmuc WHERE tbl_sanpham.sanpham_giakhuyenmai <= $gia AND tbl_sanpham.danhmuc_id=tbl_danhmuc.danhmuc_id LIMIT $begin,3";
        $sql_sanpham = mysqli_query($mysqli,$sql);
    }
    elseif($gia != '' && $danhmuc != '' && $tensanpham == '') {
        $sql = "SELECT * FROM tbl_sanpham,tbl_danhmuc WHERE tbl_sanpham.sanpham_giakhuyenmai <= $gia AND tbl_sanpham.danhmuc_id='$danhmuc' AND tbl_sanpham.danhmuc_id=tbl_danhmuc.danhmuc_id LIMIT $begin,3";
        $sql_sanpham = mysqli_query($mysqli,$sql);
    } 
    elseif($tensanpham != '' && $gia == '' && $danhmuc == '') {
        $sql = "SELECT * FROM tbl_sanpham,tbl_danhmuc WHERE tbl_sanpham.sanpham_name LIKE '%$tensanpham%' AND tbl_sanpham.danhmuc_id=tbl_danhmuc.danhmuc_id LIMIT $begin,3";
        $sql_sanpham = mysqli_query($mysqli,$sql);
    } 
    elseif($tensanpham != '' && $gia != '' && $danhmuc == '') {
        $sql = "SELECT * FROM tbl_sanpham,tbl_danhmuc WHERE tbl_sanpham.sanpham_name LIKE '%$tensanpham%' AND tbl_sanpham.sanpham_giakhuyenmai <= $gia AND tbl_sanpham.danhmuc_id=tbl_danhmuc.danhmuc_id LIMIT $begin,3";
        $sql_sanpham = mysqli_query($mysqli,$sql);
    } 
    elseif($tensanpham != '' && $danhmuc != '' && $gia == '') {
        $sql = "SELECT * FROM tbl_sanpham,tbl_danhmuc WHERE tbl_sanpham.sanpham_name LIKE '%$tensanpham%' AND tbl_sanpham.danhmuc_id='$danhmuc' AND tbl_sanpham.danhmuc_id=tbl_danhmuc.danhmuc_id LIMIT $begin,3";
        $sql_sanpham = mysqli_query($mysqli,$sql);
    } 
    else {
        $sql = "SELECT * FROM tbl_sanpham,tbl_danhmuc WHERE tbl_sanpham.danhmuc_id='$danhmuc' AND  tbl_sanpham.sanpham_name LIKE '%$tensanpham%'
        AND tbl_sanpham.sanpham_giakhuyenmai <= $gia AND tbl_sanpham.danhmuc_id=tbl_danhmuc.danhmuc_id LIMIT $begin,3";
        $sql_sanpham = mysqli_query($mysqli,$sql);
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

    <div class="container">
        <br>
            <form action="" method="get">
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" class="form-control" placeholder="Tên sản phẩm" name="tensanpham" id="tensp">
                    </div>
                    <div class="col-md-3">
                        <?php
                        $sql_danhmuc = mysqli_query($mysqli,"SELECT * FROM tbl_danhmuc ORDER BY danhmuc_id DESC");
                        ?>
                        <select name="danhmuc" class="form-control" id="danhmuc">
                            <option value="">--Chọn danh mục--</option>
                            <?php
                            while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)) {
                            ?>
                            <?php
                            $danhmuc = $_POST['danhmuc'];
                            if($danhmuc == $row_danhmuc['danhmuc_id']) {
                                ?>
                                <option selected value="<?php echo $row_danhmuc['danhmuc_id']; ?>"><?php echo $row_danhmuc['danhmuc_ten']; ?></option>
                                <?php
                            } else {
                                ?>
                                <option value="<?php echo $row_danhmuc['danhmuc_id']; ?>"><?php echo $row_danhmuc['danhmuc_ten']; ?></option>
                                <?php
                            }
                            ?>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <?php
                        $sql_gia = mysqli_query($mysqli,"SELECT * FROM tbl_gia ORDER BY id_gia DESC");
                        ?>
                        <select name="gia" class="form-control" id="gia">
                            <option value="">--Chọn gía--</option>
                            <?php
                            while($row_gia = mysqli_fetch_array($sql_gia)) {
                            ?>
                            <?php
                            $gia = $_POST['gia'];
                            if($gia == $row_gia['gia']) {
                                ?>
                                <option selected value="<?php echo $row_gia['gia']; ?>"><?php echo $row_gia['loaigia']; ?></option>
                                <?php
                            } else {
                                ?>
                                <option value="<?php echo $row_gia['gia']; ?>"><?php echo $row_gia['gia']; ?></option>
                                <?php
                            }
                            ?>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="submit" class="btn btn-primary" value="Tìm kiếm" id="btnTim">
                    </div>
                </div>
            </form>
        <table class="table table-bordered mt-3" id="table_sp1">
            <tr>
                <td>Thứ tự</td>
                <td>Tên sản phẩm</td>
                <td>Tên hình ảnh</td>
                <td>Tên số lượng</td>
                <td>Danh mục</td>
                <td>Giá sản phẩm</td>
                <td>Giá khuyến mãi</td>
                <td>Quản lý</td>
            </tr>
            
            <?php
            $i = 0;
            while($row_sanpham = mysqli_fetch_array($sql_sanpham)) {
                $i++;
                ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row_sanpham['sanpham_name']; ?></td>
                        <td><img style="max-height:80px;" src="../uploads/<?php echo $row_sanpham['sanpham_image']; ?>" alt=""></td>
                        <td><?php echo $row_sanpham['sanpham_soluong']; ?></td>
                        <td><?php echo $row_sanpham['danhmuc_ten']; ?></td>
                        <td><?php echo $row_sanpham['sanpham_gia']; ?></td>
                        <td><?php echo $row_sanpham['sanpham_giakhuyenmai']; ?></td>
                        <td>
                            <a href="./dashboard.php?quanly=xulysanpham&xoa&id=<?php echo $row_sanpham['sanpham_id']; ?>" class="border-right pr-2">Xoá</a>
                            <a href="./dashboard.php?quanly=xulysanpham&capnhat&id=<?php echo $row_sanpham['sanpham_id']; ?>">Cập nhật</a>
                        </td>
                    </tr>
                <?php
            }
            ?>
        </table>
        <?php
            if(isset($_GET['tensanpham']) || isset($_GET['danhmuc']) || isset($_GET['gia'])) {
                $danhmuc = $_GET['danhmuc'];
                $gia = $_GET['gia'];
                $tensanpham = $_GET['tensanpham'];
            } else {
                $danhmuc = '';
                $gia = '';
                $tensanpham = '';
            }
            if($danhmuc == '' && $gia == '' && $tensanpham == '') {
                $gia = '';
                $sql = "SELECT * FROM tbl_sanpham,tbl_danhmuc WHERE tbl_sanpham.danhmuc_id=tbl_danhmuc.danhmuc_id ORDER BY sanpham_id DESC";
                $sql_trang = mysqli_query($mysqli,$sql);
            } 
            elseif($danhmuc != '' && $gia == '' && $tensanpham == '') {
                $sql = "SELECT * FROM tbl_sanpham,tbl_danhmuc WHERE tbl_sanpham.danhmuc_id='$danhmuc' AND tbl_sanpham.danhmuc_id=tbl_danhmuc.danhmuc_id";
                $sql_trang = mysqli_query($mysqli,$sql);
            } 
            elseif($gia != '' && $danhmuc == '' && $tensanpham == '') {
                $sql = "SELECT * FROM tbl_sanpham,tbl_danhmuc WHERE tbl_sanpham.sanpham_giakhuyenmai <= $gia AND tbl_sanpham.danhmuc_id=tbl_danhmuc.danhmuc_id";
                $sql_trang = mysqli_query($mysqli,$sql);
            }
            elseif($gia != '' && $danhmuc != '' && $tensanpham == '') {
                $sql = "SELECT * FROM tbl_sanpham,tbl_danhmuc WHERE tbl_sanpham.sanpham_giakhuyenmai <= $gia AND tbl_sanpham.danhmuc_id='$danhmuc' AND tbl_sanpham.danhmuc_id=tbl_danhmuc.danhmuc_id";
                $sql_trang = mysqli_query($mysqli,$sql);
            } 
            elseif($tensanpham != '' && $gia == '' && $danhmuc == '') {
                $sql = "SELECT * FROM tbl_sanpham,tbl_danhmuc WHERE tbl_sanpham.sanpham_name LIKE '%$tensanpham%' AND tbl_sanpham.danhmuc_id=tbl_danhmuc.danhmuc_id";
                $sql_trang = mysqli_query($mysqli,$sql);
            } 
            elseif($tensanpham != '' && $gia != '' && $danhmuc == '') {
                $sql = "SELECT * FROM tbl_sanpham,tbl_danhmuc WHERE tbl_sanpham.sanpham_name LIKE '%$tensanpham%' AND tbl_sanpham.sanpham_giakhuyenmai <= $gia AND tbl_sanpham.danhmuc_id=tbl_danhmuc.danhmuc_id";
                $sql_trang = mysqli_query($mysqli,$sql);
            } 
            elseif($tensanpham != '' && $danhmuc != '' && $gia == '') {
                $sql = "SELECT * FROM tbl_sanpham,tbl_danhmuc WHERE tbl_sanpham.sanpham_name LIKE '%$tensanpham%' AND tbl_sanpham.danhmuc_id='$danhmuc' AND tbl_sanpham.danhmuc_id=tbl_danhmuc.danhmuc_id";
                $sql_trang = mysqli_query($mysqli,$sql);
            } 
            else {
                $sql = "SELECT * FROM tbl_sanpham,tbl_danhmuc WHERE tbl_sanpham.danhmuc_id='$danhmuc' AND  tbl_sanpham.sanpham_name LIKE '%$tensanpham%'
                AND tbl_sanpham.sanpham_giakhuyenmai <= $gia AND tbl_sanpham.danhmuc_id=tbl_danhmuc.danhmuc_id";
                $sql_trang = mysqli_query($mysqli,$sql);
            }
        ?>
        <nav aria-label="Page navigation example" class="mx-auto" style="width:300px;">
            <?php
            $row_count = mysqli_num_rows($sql_trang);
            $trang = ceil($row_count/3);
            ?>
            <ul class="pagination">
                <li class="page-item">
                <a class="page-link" 
                href="timkiemsanpham.php?tensanpham=<?= $tensanpham; ?>&danhmuc=<?= 
                $danhmuc; ?>&gia=<?= $gia; ?>&trang=<?php $trang_previous = $trang_active-1; if($trang_previous>1) echo $trang_previous; else echo 1; ?>"
                 aria-label="">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
                </li>
                <?php
                for($i=1;$i<=$trang;$i++) {
                ?>
                <li class="page-item <?php if($trang_active==$i) echo 'active'; ?>">
                <a class="page-link" 
                href="timkiemsanpham.php?tensanpham=<?= $tensanpham; ?>&danhmuc=<?= $danhmuc; ?>&gia=<?= $gia; ?>&trang=<?php echo $i; ?>">
                    <?php echo $i; ?></a></li>
                <?php
                }
                ?>
                <li class="page-item">
                <a class="page-link" 
                href="timkiemsanpham.php?tensanpham=<?= $tensanpham; ?>&danhmuc=<?= 
                $danhmuc; ?>&gia=<?= $gia; ?>&trang=<?php $trang_next = $trang_active+1; if($trang_next<=$trang) echo $trang_next; else echo $trang; ?>">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
                </li>
            </ul>
        </nav>
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
