<?php
session_start();
include('./db/connect.php');
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Cửa hàng Điện Máy</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords" content="Cửa hàng điện máy, bán đồ điện máy, đồ điện tử giá rẻ" />
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
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <!-- Bootstrap css -->
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <!-- Main css -->
    <link rel="stylesheet" href="css/fontawesome-all.css">
    <!-- Font-Awesome-Icons-CSS -->
    <link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all" />
    <!-- pop-up-box -->
    <link href="css/menu.css" rel="stylesheet" type="text/css" media="all" />
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
    <style>
    .cart-icon:after{
        content:attr(value);
        font-size:12px;
        color: #fff;
        background: red;
        border-radius:50%;
        padding: 1px 5px;
        position:relative;
        left:-5px;
        top:-12px;
        opacity:0.9;
    }

    </style>

</head>

<body>
    <?php
	include('./includes/topbar.php');
	include('./includes/menu.php');
    include('./includes/slider.php');
	if(isset($_GET['quanly'])) {
		$temp = $_GET['quanly'];
	} else {
		$temp = '';
	}
	if($temp == 'danhmuc') {
		include('./includes/danhmuc.php');
	} elseif($temp == 'chitietsp') {
		include('./includes/chitietsp.php');
	} elseif($temp == 'giohang') {
		include('./includes/giohang.php');
	}  elseif($temp == 'tintuc') {
		include('./includes/tintuc.php');
	} elseif($temp == 'chitietbaiviet') {
		include('./includes/chitietbaiviet.php');
	} elseif($temp == 'xemdonhang') {
		include('./includes/xemdonhang.php');
	} elseif($temp == 'dangky') {
        include('./includes/dangky.php');
    } elseif($temp == 'dangnhap') {
        include('./includes/dangnhap.php');
    } elseif($temp == 'user') {
        include('./users/thongtinuser.php');
    } elseif($temp == 'dangxuat') {
        include('./includes/thoat.php');
    }  elseif($temp == 'thongbaouser') {
        include('./users/thongbaouser.php');
    } else {
		include('./includes/home.php');
	}
	include('./includes/footer.php');
    use Carbon\Carbon;
    use Carbon\CarbonInterval;
    require('./carbon/vendor/autoload.php');
    $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
	?>


    <!-- copyright -->
    <div class="copy-right py-3">
        <div class="container">
            <p class="text-center text-white">© 2022 Nhóm 2. All rights reserved | Design by Nhóm 2

            </p>
        </div>
    </div>
    <!-- //copyright -->

    <!-- js-files -->
    <!-- jquery -->
    <script src="js/jquery-2.2.3.min.js"></script>
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
    <!-- //nav smooth scroll -->

    <!-- popup modal (for location)-->
    <script src="js/jquery.magnific-popup.js"></script>
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
    <!-- <script src="js/minicart.js"></script> -->

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
    <script src="js/scroll.js"></script>
    <!-- //scroll seller -->

    <!-- imagezoom -->
    <!-- <script src="js/imagezoom.js"></script> -->
    <!-- //imagezoom -->

    <!-- flexslider -->
    <link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />

    <script src="js/jquery.flexslider.js"></script>
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
    <script src="js/SmoothScroll.min.js"></script>
    <!-- //smoothscroll -->

    <!-- start-smooth-scrolling -->
    <script src="js/move-top.js"></script>
    <script src="js/easing.js"></script>
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
    <script src="js/bootstrap.js"></script>
    <!-- //for bootstrap working -->
    <!-- //js-files -->

    <script>
        function toLogin() {
            window.location.assign('index.php?quanly=dangnhap');
        }
    </script>
</body>

</html>