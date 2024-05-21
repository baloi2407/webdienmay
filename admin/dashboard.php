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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
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
    } elseif($temp == 'xulytaikhoan') {
        include('./xulytaikhoan.php');
    } elseif($temp == 'xulydonhang') {
        include('./xulydonhang.php');
    } elseif($temp == 'xulykhachhang') {
        include('./xulykhachhang.php');
    } elseif($temp == 'taikhoanadmin') {
        include('./taikhoanadmin.php');
    } elseif($temp == 'doimatkhau') {
        include('./doimatkhau.php');
    } elseif($temp=='xulytaikhoannv') {
        include('./xulytaikhoannv.php');
    } elseif($temp=='xulytaikhoankh') {
        include('./xulytaikhoankh.php');
    }  elseif($temp == 'quenmatkhau') {
        include('./quenmatkhau.php');
    } elseif($temp == 'slider') {
        include('./xulyslider.php');
    } else {
        if($_SESSION['idgroup']==1) {
            include('./thongkesp.php');
        }
    }
    
    ?>
    
   

    <!-- jquery -->
    <script src="../js/jquery-2.2.3.min.js"></script>
    <!-- //jquery -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

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
    <!-- //nav smooth scroll -->

    <!-- popup modal (for location)-->
    <script src="../js/jquery.magnific-popup.js"></script>
    <script>
    $(document).ready(function() {
        $('.popup-with-zoom-anim').magnificPopup({
            type: 'inline',
            fixedContentPos: false,
            fixedBgPos: true,
            overflowY: 'auto',
            closeBtnInside: true,
            preloader: false,
            midClick: true,
            removalDelay: 300,
            mainClass: 'my-mfp-zoom-in'
        });

    });
    </script>
    <!-- //popup modal (for location)-->

    <!-- cart-js -->
    <!-- <script src="../js/minicart.js"></script> -->

    <!-- //cart-js -->

    <!-- password-script -->
    <script>
    window.onload = function() {
        // document.getElementById("password1").onchange = validatePassword;
        // document.getElementById("password2").onchange = validatePassword;
    }

    function validatePassword() {
        var pass2 = document.getElementById("password2").value;
        var pass1 = document.getElementById("password1").value;
        if (pass1 != pass2)
            document.getElementById("password2").setCustomValidity("Passwords Don't Match");
        else
            document.getElementById("password2").setCustomValidity('');
        //empty string means no validation error
    }
    </script>
    <!-- //password-script -->

    <!-- scroll seller -->
    <script src="../js/scroll.js"></script>
    <!-- //scroll seller -->

    <!-- imagezoom -->
    <!-- <script src="../js/imagezoom.js"></script> -->
    <!-- //imagezoom -->

    <!-- flexslider -->
    <!-- <link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" /> -->

    <script src="../js/jquery.flexslider.js"></script>
    <script>
    // Can also be used with $(document).ready()
    $(window).load(function() {
        $('.flexslider').flexslider({
            animation: "slide",
            controlNav: "thumbnails"
        });
    });
    </script>
    <!-- //FlexSlider-->

    <!-- smoothscroll -->
    <script src="../js/SmoothScroll.min.js"></script>
    <!-- //smoothscroll -->

    <!-- start-smooth-scrolling -->
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
    <!-- //end-smooth-scrolling -->

    <!-- smooth-scrolling-of-move-up -->
    <script>
    $(document).ready(function() {
        /*
        var defaults = {
        	containerID: 'toTop', // fading element id
        	containerHoverID: 'toTopHover', // fading element hover id
        	scrollSpeed: 1200,
        	easingType: 'linear' 
        };
        */
        $().UItoTop({
            easingType: 'easeOutQuart'
        });

    });
    </script>
    <!-- //smooth-scrolling-of-move-up -->

    <!-- for bootstrap working -->
    <script src="../js/bootstrap.js"></script>
    <!-- //for bootstrap working -->
    <!-- //js-files -->

</body>
</html>
