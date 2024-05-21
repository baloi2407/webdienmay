<!-- navigation -->
<div class="navbar-inner">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="agileits-navi_search">
                <form action="#" method="post">
                    <select id="agileinfo-nav_search" name="agileinfo_search" class="border" required="">
                        <option value="">Tất cả danh mục</option>
                    <?php
                    $sql_danhmuc = mysqli_query($mysqli,"SELECT * FROM tbl_danhmuc ORDER BY danhmuc_id DESC");
                    while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)) {
                    ?>
                        <option value="<?php echo $row_danhmuc['danhmuc_ten']; ?>"><?php echo $row_danhmuc['danhmuc_ten']; ?></option>
                    <?php
                    }
                    ?>
                    </select>
                </form>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto text-center mr-xl-5">
                    <li class="nav-item active mr-lg-2 mb-lg-0 mb-2">
                        <a class="nav-link" href="http://localhost/webdienmay2/index.php">Trang chủ
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <?php
                    $sql_danhmuc_danhmuc = mysqli_query($mysqli,"SELECT * FROM tbl_danhmuc ORDER BY danhmuc_id DESC");
                    while($row_danhmuc_danhmuc = mysqli_fetch_array($sql_danhmuc_danhmuc)) {
                    ?>
                    <li class="nav-item dropdown mr-lg-2 mb-lg-0 mb-2">
                        <a class="nav-link" href="http://localhost/webdienmay2/index.php?quanly=danhmuc&id=<?php echo $row_danhmuc_danhmuc['danhmuc_id']; ?>">
                        <?php echo $row_danhmuc_danhmuc['danhmuc_ten']; ?>
                        </a>
                    </li>
                    <?php
                    }
                    ?>
                    <li class="nav-item dropdown mr-lg-2 mb-lg-0 mb-2">
                        <?php
                        $sql_danhmuc_tin = mysqli_query($mysqli,"SELECT * FROM tbl_danhmuc_tin ORDER BY danhmuctin_id DESC");
                        ?>
                        <a class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" href="#" aria-haspopup="true"
                        aria-expanded="false">
                            Tin tức
                        </a>

                        <div class="dropdown-menu">
                            <?php
                            while($row_danhmuc_tin = mysqli_fetch_array($sql_danhmuc_tin)) {
                            ?>
                            <a href="http://localhost/webdienmay2/index.php?quanly=tintuc&id_tin=<?php echo $row_danhmuc_tin['danhmuctin_id']; ?>" class="dropdown-item"><?php echo $row_danhmuc_tin['tendanhmuc']; ?></a>
                            <?php
                            }
                            ?>
                        </div>
                    </li>
                    
                </ul>
            </div>
        </nav>
    </div>
</div>
<!-- //navigation -->