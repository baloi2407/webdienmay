<?php
session_start();
if(!isset($_SESSION['login_id'])) {
    header('Location: index.php');
}
?>

<?php
include('../db/connect.php');
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
	include('./topbar.php');
	include('./menu.php');
	include('./xulytimnangcao.php');
	include('./footer.php');
	?>



    <!-- copyright -->
    <div class="copy-right py-3">
        <div class="container">
            <p class="text-center text-white">© 2022 Nhóm 2. All rights reserved | Design by Nhóm 2

            </p>
        </div>
    </div>
    <!-- //copyright -->

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

    <script>
        function toLogin() {
            window.location.assign('index.php?quanly=dangnhap');
        }
    </script>
</body>

</html>
