<?php
if(isset($_POST['themdanhmuc'])) {
    $danhmuc = $_POST['danhmuc'];
    $sql_themdanhmuc = mysqli_query($mysqli,"INSERT INTO tbl_danhmuc_tin(tendanhmuc) values('$danhmuc') ");
} 
elseif(isset($_POST['capnhatdanhmuc'])) {
    $id = $_POST['id_danhmuc'];
    $danhmuc = $_POST['danhmuc'];
    $sql_update = mysqli_query($mysqli,"UPDATE tbl_danhmuc_tin SET tendanhmuc='$danhmuc' WHERE danhmuctin_id='$id' ");
}
elseif(isset($_GET['xoa'])) {
    $id = $_GET['id'];
    $sql_delete = mysqli_query($mysqli,"DELETE FROM tbl_danhmuc_tin WHERE danhmuctin_id='$id' ");
}

?>

    <div class="container">
        <div class="row">
            <?php
            if(isset($_GET['capnhat']) == 'capnhat') {
                $id = $_GET['id'];
                $sql_danhmuc = mysqli_query($mysqli,"SELECT * FROM tbl_danhmuc_tin WHERE danhmuctin_id='$id'");
                $row_danhmuc = mysqli_fetch_array($sql_danhmuc);
            ?>
                <div class="col-md-4">
                    <h4>Cập nhật danh mục</h4>
                    <label for="">Cập nhật danh mục</label>
                    <form action="" method="post">
                        <input type="text" class="form-control" name="danhmuc" value="<?php echo $row_danhmuc['tendanhmuc']; ?>" >
                        <input type="hidden" class="form-control" name="id_danhmuc" value="<?php echo $row_danhmuc['danhmuctin_id']; ?>" >
                        <input type="submit" value="Cập nhật danh mục" name="capnhatdanhmuc" class="btn btn-success mt-2">
                    </form>
                </div>
            <?php
            } else {
            ?>
                <div class="col-md-4">
                    <h4>Thêm danh mục</h4>
                    <label for="">Tên danh mục</label>
                    <form action="" method="post">
                        <input type="text" class="form-control" name="danhmuc" placeholder="Tên danh mục" >
                        <input type="submit" value="Thêm danh mục" name="themdanhmuc" class="btn btn-success mt-2">
                    </form>
                </div>
            <?php
            }
            ?>
            
            <div class="col-md-8">
                <h4>Liệt kê danh mục</h4>
                <?php 
                if(isset($_GET['trang'])) {
                    $trang_active = $_GET['trang'];
                } else {
                    $trang_active = '1';
                }
                if($trang_active == '' || $trang_active == 1) {
                    $begin = 0;
                } else {
                    $begin = ($trang_active*5)-5;
                }         
                $sql_select = mysqli_query($mysqli,"SELECT * FROM tbl_danhmuc_tin ORDER BY danhmuctin_id DESC LIMIT $begin,5");
                ?>
                <table class="table table-bordered">
                    <tr>
                        <td>Thứ tự</td>
                        <td>Tên danh mục</td>
                        <td>Quản lý</td>
                    </tr>
                    <?php
                    $i = 0;
                    while($row_select = mysqli_fetch_array($sql_select)) {
                        $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row_select['tendanhmuc']; ?></td>
                        <td>
                            <a href="?quanly=xulydanhmucbaiviet&xoa&id=<?php echo $row_select['danhmuctin_id']; ?>" class="border-right pr-2">
                            <span class="pl-2 pr-2 pt-1 pb-1 roundeded bg-danger text-white"><i class="fa fa-close"></i></span>
                            </a>
                            <a href="?quanly=xulydanhmucbaiviet&capnhat&id=<?php echo $row_select['danhmuctin_id']; ?>">
                            <span class="pl-2 pr-2 pt-1 pb-1 roundeded bg-success text-white"><i class="fa fa-wrench"></i></span>
                            </a>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </table>
                <nav aria-label="Page navigation example" class="mx-auto" style="width:300px;">
                    <?php
                    $sql_trang = mysqli_query($mysqli,"SELECT * FROM tbl_danhmuc_tin ORDER BY danhmuctin_id DESC");
                    $row_count = mysqli_num_rows($sql_trang);
                    $trang = ceil($row_count/5);
                    if($trang > 1) {
                    ?>
                    <ul class="pagination">
                        <li class="page-item">
                        <a class="page-link" href="?quanly=xulydanhmucbaiviet&trang=<?php $trang_previous = $trang_active-1; if($trang_previous>1) echo $trang_previous; else echo 1; ?>" aria-label="">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                        </li>
                        <?php
                        for($i=1;$i<=$trang;$i++) {
                        ?>
                        <li class="page-item <?php if($trang_active==$i) echo 'active'; ?>"><a class="page-link" href="?quanly=xulydanhmucbaiviet&trang=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php
                        }
                        ?>
                        <li class="page-item">
                        <a class="page-link" 
                        href="?quanly=xulydanhmucbaiviet&trang=<?php $trang_next = $trang_active+1; if($trang_next<=$trang) echo $trang_next; else echo $trang; ?>">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                        </li>
                    </ul>
                    <?php
                    }
                    ?>
                </nav>
            </div>
        </div>
    </div>
