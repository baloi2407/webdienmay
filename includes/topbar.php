<?php
if(isset($_GET['dangxuat'])) {
    $id = $_GET['dangxuat'];
    if($id == 1) {
        unset($_SESSION['dangnhap_home']);
    }
} 
?>
<!-- Toast -->

<!-- End of Toast -->

<!-- top-header -->
<div class="agile-main-top">
    <div class="container-fluid">
        <div class="row main-top-w3l py-2">
            <div class="col-lg-4 header-most-top">
                <p class="text-white text-lg-right text-center">
                    
                </p>
            </div>
            <div class="col-lg-8 header-right mt-lg-0 mt-2">
                <!-- header lists -->
                <ul>
                    <li class="text-center border-right text-white">
                        <i class="fas fa-phone mr-2"></i> 001 234 5678
                    </li>
                    <?php 
                        if(isset($_SESSION['login_user'])) {
                            $id = $_SESSION['login_id'];
                            ?>
                             <li class="text-center border-right text-white">
                                <a href="http://localhost/webdienmay2/index.php?quanly=xemdonhang&user=<?php echo $_SESSION['login_id']; ?>"
                                    data-toggle="" data-target="" class="text-white">
                                    <i class="fas fa-truck mr-2"></i>Xem đơn hàng:
                                </a>
                            </li>
                            <li class="text-center border-right text-white">
                                <a href="http://localhost/webdienmay2/index.php?quanly=user&id=<?php echo $id ?>"  class="text-white">
                                <i class="fas fa-user mr-2"></i> <?php echo $_SESSION['login_hoten']; ?></a>
                            </li>
                            <li class="text-center border-right text-white">
                                <a href="http://localhost/webdienmay2/index.php?quanly=dangxuat" class="text-white">
                                    <i class="fas fa-sign-in-alt mr-2"></i> Đăng xuất </a>
                            </li>
                            <?php
                        } else {
                            ?>
                                <li class="text-center text-white">
                                    <a href="http://localhost/webdienmay2/index.php?quanly=dangnhap"  class="text-white">
                                        <i class="fas fa-sign-out-alt mr-2"></i>Đăng nhập </a>
                                </li>
                                <li class="text-center text-white">
                                    <a href="http://localhost/webdienmay2/index.php?quanly=dangky"  class="text-white">
                                        <i class="fas fa-sign-out-alt mr-2"></i>Đăng ký </a>
                                </li>
                            <?php
                        }
                    ?>
                </ul>
                <!-- //header lists -->
            </div>
        </div>
    </div>
</div>
<!-- log in -->

<!-- register -->

<!-- //modal -->
<!-- //top-header -->

<!-- header-bottom-->
<div class="header-bot">
    <div class="container">
        <div class="row header-bot_inner_wthreeinfo_header_mid">
            <!-- logo -->
            <div class="col-md-3 logo_agile">
                <h1 class="text-center">
                    <a href="http://localhost/webdienmay2/index.php" class="font-weight-bold font-italic">
                        Electronix
                    </a>
                </h1>
            </div>
            <!-- //logo -->
            <!-- header-bot -->
            <div class="col-md-9 header mt-4 mb-md-0 mb-4">
                <div class="row">
                    <!-- search -->
                    <div class="col-10 agileits_search">
                        <form class="form-inline" action="http://localhost/webdienmay2/includes/timkiem.php?tukhoa=" method="get">
                            <input  class="form-control mr-sm-2" name="tukhoa" type="search"
                                placeholder="Tìm kiếm" aria-label="Search" id="tukhoa">
                            <button class="btn my-2 my-sm-0" type="submit">Tìm kiếm</button>
                        </form>
                    </div>
                    <!-- //search -->
                    <!-- cart details -->
                    <?php
                    if(isset($_SESSION['login_id'])) {
                        ?>
                        <div class="col-2 top_nav_right text-center mt-sm-0 mt-2">
                            <div class="wthreecartaits wthreecartaits2 cart cart box_1">
                                <a href="index.php?quanly=giohang">
                                    <button class="btn w3view-cart">
                                        <i class="fas fa-cart-arrow-down"></i>
                                        <!-- <span class="btn badge bg-danger pd-1">1</span> -->
                                    </button>                            
                                </a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <!-- //cart details -->
                </div>
            </div>
        </div>
    </div>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<!-- shop locator (popup) -->
<!-- //header-bottom -->
<!-- <script>
    function timkiem() {
        var tukhoa = document.getElementById('tukhoa').value;
        
        $.ajax({
                url: "http://localhost/webdienmay2/index.php?quanly=timkiem&tukhoa="+tukhoa,       
                method:"get",      
                dataType:'text', 
                success: function(data){     
                    console.log(data)
                }
            });
    }
</script> -->