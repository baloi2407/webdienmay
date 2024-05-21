<?php
if(isset($_POST['themdanhmuc'])) {
    $danhmuc = $_POST['danhmuc'];
    $sql_themdanhmuc = mysqli_query($mysqli,"INSERT INTO tbl_danhmuc(danhmuc_ten) values('$danhmuc') ");
} 
elseif(isset($_POST['capnhatdanhmuc'])) {
    $id = $_POST['id_danhmuc'];
    $danhmuc = $_POST['danhmuc'];
    $sql_update = mysqli_query($mysqli,"UPDATE tbl_danhmuc SET danhmuc_ten='$danhmuc' WHERE danhmuc_id='$id' ");
}
elseif(isset($_GET['xoa'])) {
    $id = $_GET['id'];
    $sql_delete = mysqli_query($mysqli,"DELETE FROM tbl_danhmuc WHERE danhmuc_id='$id' ");
}

?>

    <div class="container">
        <div class="row">
            <?php
            if(isset($_GET['capnhat']) == 'capnhat') {
                $id = $_GET['id'];
                $sql_danhmuc = mysqli_query($mysqli,"SELECT * FROM tbl_danhmuc WHERE danhmuc_id='$id'");
                $row_danhmuc = mysqli_fetch_array($sql_danhmuc);
            ?>
                <div class="col-md-4">
                    <h4>Cập nhật danh mục</h4>
                    <label for="">Cập nhật danh mục</label>
                    <form action="dashboard.php?quanly=xulydanhmuc" method="post">
                        <input type="text" class="form-control" name="danhmuc" value="<?php echo $row_danhmuc['danhmuc_ten']; ?>" >
                        <input type="hidden" class="form-control" name="id_danhmuc" value="<?php echo $row_danhmuc['danhmuc_id']; ?>" >
                        <input type="submit" value="Cập nhật danh mục" name="capnhatdanhmuc" class="btn btn-success mt-2">
                    </form>
                </div>
            <?php
            } else {
            ?>
                <div class="col-md-4">
                    <h4>Thêm danh mục</h4>
                    <label for="">Tên danh mục</label>
                    <form action="dashboard.php?quanly=xulydanhmuc" method="post">
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
                $sql_select = mysqli_query($mysqli,"SELECT * FROM tbl_danhmuc ORDER BY danhmuc_id DESC LIMIT $begin,5");
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
                        <td><?php echo $row_select['danhmuc_ten']; ?></td>
                        <td>
                            <a data-toggle="modal" data-target="#exampleModal"  class="">
                            <span class="pl-2 pr-2 pt-1 pb-1 roundeded bg-danger text-white"><i class="fa fa-close"></i></span>
                            </a>
                            <a href="?quanly=xulydanhmuc&capnhat&id=<?php echo $row_select['danhmuc_id']; ?>">
                            <span class="pl-2 pr-2 pt-1 pb-1 roundeded bg-success text-white"><i class="fa fa-wrench"></i></span>
                            </a>
                        </td>
                    </tr>
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-center">Xoá khỏi giỏ hàng</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            
                                                <div class="right-w3l">
                                                    <a href="?quanly=xulydanhmuc&xoa&id=<?php echo $row_select['danhmuc_id']; ?>" class="btn btn-primary form-control">Xoá</a>
                                                </div>
                                                
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                    }
                    ?>
                </table>
                <nav aria-label="Page navigation example" class="mx-auto" style="width:300px;">
                    <?php
                    $sql_trang = mysqli_query($mysqli,"SELECT * FROM tbl_danhmuc ORDER BY danhmuc_id DESC");
                    $row_count = mysqli_num_rows($sql_trang);
                    $trang = ceil($row_count/5);
                    if($trang > 1) {
                    ?>
                    <ul class="pagination">
                        <li class="page-item">
                        <a class="page-link" href="?quanly=xulydanhmuc&trang=<?php $trang_previous = $trang_active-1; if($trang_previous>1) echo $trang_previous; else echo 1; ?>" aria-label="">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                        </li>
                        <?php
                        for($i=1;$i<=$trang;$i++) {
                        ?>
                        <li class="page-item <?php if($trang_active==$i) echo 'active'; ?>"><a class="page-link" href="?quanly=xulydanhmuc&trang=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php
                        }
                        ?>
                        <li class="page-item">
                        <a class="page-link" 
                        href="?quanly=xulydanhmuc&trang=<?php $trang_next = $trang_active+1; if($trang_next<=$trang) echo $trang_next; else echo $trang; ?>">
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
