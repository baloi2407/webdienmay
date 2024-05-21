<?php
if(isset($_SESSION['dangnhap'])) {
    $id = $_SESSION['admin_id'];
    $sql = mysqli_query($mysqli,"SELECT * FROM tbl_khachhang_account WHERE id=$id");
    $row = mysqli_fetch_array($sql);

    $sql_quyen = mysqli_query($mysqli,"SELECT * FROM tbl_quyen WHERE user_id='$id'");
    $count = mysqli_num_rows($sql_quyen);
    if($count > 0) {
        $row_quyen = mysqli_fetch_array($sql_quyen);
    } else {
        $sql_insert = mysqli_query($mysqli,"INSERT INTO tbl_quyen (user_id) VALUES('$id')");
        $sql_quyen = mysqli_query($mysqli,"SELECT * FROM tbl_quyen WHERE user_id='$id'");
        $row_quyen = mysqli_fetch_array($sql_quyen);
    }
   
    
} else {
    $id = '';
}
?>
<div class="agile-main-top">
    <div class="container-fluid">
        <div class="row main-top-w3l py-2">
            
            <div class="col-lg-8 header-right mt-lg-0 mt-2">
                <!-- header lists -->
                <ul>
                    <li class="text-center border-right text-white dropdown">
                        <span class="text-white"><?php echo $_SESSION['dangnhap']; ?></span>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="dashboard.php?quanly=taikhoanadmin&id=<?php echo $_SESSION['admin_id']; ?>">Thông tin tài khoản</a>
                            <a class="dropdown-item" href="?login=dangxuat">Đăng xuất</a>
                        </div>
                    </li>
                </ul>
                <!-- //header lists -->
            </div>
        </div>
    </div>
</div>

<div class="navbar-inner">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav text-center">
                    <li class="nav-item mr-lg-2 mb-lg-0 mb-2">
                        <a class="nav-link" href="dashboard.php">Trang chủ
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <?php
                    if($row['idgroup']==1) {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php?quanly=xulytaikhoan">Quản lý tài khoản</a>
                        </li>
                        <?php
                    }
                    ?>
                    <?php
                    if($row['idgroup']==2) {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php?quanly=xulytaikhoannv">Tài khoản nhân viên</a>
                        </li>
                        <?php
                    }
                    ?>
                    <?php
                    if($row_quyen['quanlysp']==1) {
                        ?>
                         <li class="nav-item dropdown mr-lg-2 mb-lg-0 mb-2">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Quản lý sản phẩm
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="dashboard.php?quanly=xulysanpham">Sản phẩm</a>
                                <a class="dropdown-item" href="dashboard.php?quanly=xulydanhmuc">Danh mục sản phẩm</a>
                            </div>
                        </li>
                        <?php
                    }
                    ?>
                    <?php
                    if($row_quyen['quanlybaiviet']==1) {
                        ?>
                        <li class="nav-item dropdown active mr-lg-2 mb-lg-0 mb-2">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Quản lý bài viết
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="dashboard.php?quanly=xulybaiviet">Bài viết</a>
                                <a class="dropdown-item" href="dashboard.php?quanly=danhmucbaiviet">Danh mục bài viết</a>
                            </div>
                        </li>
                        <?php
                    }
                    ?>
                    <?php
                    if($row_quyen['quanlydonhang']==1) {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php?quanly=xulydonhang">Đơn hàng</a>
                        </li>
                        <?php
                    }
                    ?>
                    <?php
                    if($row_quyen['quanlykh']==1) {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php?quanly=xulykhachhang">Khách hàng</a>
                        </li>
                        <?php
                    }
                    ?>
                    <?php
                    if($row_quyen['taikhoankh']==1) {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php?quanly=xulytaikhoankh">Tài khoản khách hàng</a>
                        </li>
                        <?php
                    }
                    ?>
                    <?php
                    if($row_quyen['quanlyslider']==1) {
                        ?>
                        <li class="nav-item">
                        <a class="nav-link" href="dashboard.php?quanly=slider">Banner</a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </nav>
    </div>
</div>

