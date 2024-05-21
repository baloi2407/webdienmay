<?php
if(isset($_POST['thembaiviet'])) {
    $tenbaiviet= $_POST['tenbaiviet'];
    $hinhanh = $_FILES['hinhanh']['name'];
    $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
    $danhmuc = $_POST['danhmuc'];
    $tomtat = $_POST['tomtat'];
    $noidung = $_POST['noidung'];
    $path = '../uploads/';
    $sql_insert_sanpham = mysqli_query($mysqli,"INSERT INTO
    tbl_baiviet(tenbaiviet,baiviet_image,tomtat,noidung,danhmuctin_id)
    values('$tenbaiviet','$hinhanh','$tomtat','$noidung',$danhmuc) ");
    move_uploaded_file($hinhanh_tmp,$path.$hinhanh);
}
elseif(isset($_POST['capnhatbaiviet'])) {
    $baiviet_id = $_POST['baiviet_id'];
    $tenbaiviet = $_POST['tenbaiviet'];
    $hinhanh = $_FILES['hinhanh']['name'];
    $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
    $danhmuc = $_POST['danhmuc'];
    $tomtat = $_POST['tomtat'];
    $noidung = $_POST['noidung'];
    $path = '../uploads/';
    if($hinhanh != '') {
        if($tomtat == '' && $noidung == '') {
            $sql_update_sanpham = mysqli_query($mysqli,"UPDATE tbl_baiviet SET tenbaiviet='$tenbaiviet', baiviet_image='$hinhanh',
            danhmuctin_id='$danhmuc'
            WHERE baiviet_id='$baiviet_id' ");
            move_uploaded_file($hinhanh_tmp,$path.$hinhanh);
        } elseif($tomtat != '' && $noidung == '') {
            $sql_update_sanpham = mysqli_query($mysqli,"UPDATE tbl_baiviet SET tenbaiviet='$tenbaiviet', baiviet_image='$hinhanh',
            danhmuctin_id='$danhmuc', tomtat='$tomtat'
            WHERE baiviet_id='$baiviet_id' ");
            move_uploaded_file($hinhanh_tmp,$path.$hinhanh);
        } elseif($tomtat == '' && $noidung != '') {
            $sql_update_sanpham = mysqli_query($mysqli,"UPDATE tbl_baiviet SET tenbaiviet='$tenbaiviet', baiviet_image='$hinhanh',
            danhmuctin_id='$danhmuc',noidung='$noidung'
            WHERE baiviet_id='$baiviet_id' ");
            move_uploaded_file($hinhanh_tmp,$path.$hinhanh);
        } else {
            $sql_update_sanpham = mysqli_query($mysqli,"UPDATE tbl_baiviet SET tenbaiviet='$tenbaiviet', baiviet_image='$hinhanh',
            danhmuctin_id='$danhmuc', tomtat='$tomtat', noidung='$noidung'
            WHERE baiviet_id='$baiviet_id' ");
            move_uploaded_file($hinhanh_tmp,$path.$hinhanh);
        }
    } else {
        if($tomtat == '' && $noidung == '') {
            $sql_update_sanpham = mysqli_query($mysqli,"UPDATE tbl_baiviet SET tenbaiviet='$tenbaiviet',
            danhmuctin_id='$danhmuc'
            WHERE baiviet_id='$baiviet_id' ");
        } elseif($tomtat != '' && $noidung == '') {
            $sql_update_sanpham = mysqli_query($mysqli,"UPDATE tbl_baiviet SET tenbaiviet='$tenbaiviet',
            danhmuctin_id='$danhmuc', tomtat='$tomtat'
            WHERE baiviet_id='$baiviet_id' ");
        } elseif($tomtat == '' && $noidung != '') {
            $sql_update_sanpham = mysqli_query($mysqli,"UPDATE tbl_baiviet SET tenbaiviet='$tenbaiviet',
            danhmuctin_id='$danhmuc', noidung='$noidung'
            WHERE baiviet_id='$baiviet_id' ");
        } else {
            $sql_update_sanpham = mysqli_query($mysqli,"UPDATE tbl_baiviet SET tenbaiviet='$tenbaiviet',
            danhmuctin_id='$danhmuc', tomtat='$tomtat', noidung='$noidung'
            WHERE baiviet_id='$baiviet_id' ");
        }
    }

}
elseif(isset($_GET['xoa'])) {
    $id = $_GET['id'];
    $sql_delete = mysqli_query($mysqli,"DELETE FROM tbl_baiviet WHERE baiviet_id='$id' ");
}

?>
    <div class="container py-xl-4 py-lg-2">
        <div class="row">
            <?php
            if(isset($_GET['capnhat']) == 'capnhat') {
                $id = $_GET['id'];
                $sql_select_id = mysqli_query($mysqli,"SELECT * FROM tbl_baiviet WHERE baiviet_id='$id' ");
                $row_baiviet = mysqli_fetch_array($sql_select_id);
                $danhmuc_id = $row_baiviet['danhmuctin_id'];
                ?>
                    <div class="col-md-12">
                        <h4>Cập nhật bài viết</h4>
                        <form action="" method="post" enctype="multipart/form-data">
                            <label for="">Tên bài viết</label>
                            <input type="text" class="form-control" name="tenbaiviet" value="<?php echo $row_baiviet['tenbaiviet'] ?>" >
                            <input type="hidden" class="form-control" name="baiviet_id" value="<?php echo $row_baiviet['baiviet_id']; ?>"><br>
                            <label for="">Hình ảnh</label><br>
                            <input type="file" class="form-control" name="hinhanh">
                            <img style="min-height:80px;max-width:200px;" src="../uploads/<?php echo $row_baiviet['baiviet_image']; ?>"><br>
                            <label>Tóm tắt</label>
                            <textarea name="tomtat" class="form-control" placeholder="<?php echo $row_baiviet['tomtat']; ?>"></textarea><br>
                            <label>Nội dung</label>
                            <textarea name="noidung" class="form-control" placeholder="<?php echo $row_baiviet['noidung']; ?>"></textarea><br>
                            <?php
                                $sql_danhmuc = mysqli_query($mysqli,"SELECT * FROM tbl_danhmuc_tin ORDER BY danhmuctin_id ASC");
                            ?>
                            <select name="danhmuc" class="form-control">
                                <option value="0">--Chọn danh mục--</option>
                                <?php
                                    while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)) {
                                        if($danhmuc_id == $row_danhmuc['danhmuctin_id']) {
                                ?>
                                <option selected value="<?php echo $row_danhmuc['danhmuctin_id']; ?>"><?php echo $row_danhmuc['tendanhmuc']; ?></option>
                                <?php
                                        } else {
                                            ?>
                                                <option value="<?php echo $row_danhmuc['danhmuctin_id']; ?>"><?php echo $row_danhmuc['tendanhmuc']; ?></option>
                                            <?php
                                        }
                                    }
                                ?>
                            </select><br>
                            <input type="submit" value="Cập nhật bài viết" name="capnhatbaiviet" class="btn btn-success mt-2">
                        </form>
                    </div>
                <?php
            } elseif(isset($_GET['chitiet'])) {
                $id = $_GET['id'];
                $sql_select_id = mysqli_query($mysqli,"SELECT * FROM tbl_baiviet WHERE baiviet_id='$id' ");
                $row_baiviet = mysqli_fetch_array($sql_select_id);
                $danhmuc_id = $row_baiviet['danhmuctin_id'];
                ?>
                <div class="col-md-12">
                    <h4>Chi tiết bài viết</h4>
                    <label for="">Tên bài viết</label>
                    <p class="form-control text-dark"><?php echo $row_baiviet['tenbaiviet'] ?></p><br>
                    <label for="">Hình ảnh</label><br>
                    <img style="min-height:80px;max-width:200px;" src="../uploads/<?php echo $row_baiviet['baiviet_image']; ?>"><br><br>
                    <label>Tóm tắt</label>
                    <p class="form-control text-dark"><?php echo $row_baiviet['tomtat']; ?></p><br>
                    <label>Nội dung</label>
                    <p class="form-control text-dark"><?php echo $row_baiviet['noidung']; ?></p><br>
                    <label for="">Danh mục</label>
                    <?php
                        $sql_danhmuc = mysqli_query($mysqli,"SELECT * FROM tbl_danhmuc_tin ORDER BY danhmuctin_id ASC");
                        while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)) {
                            if($danhmuc_id == $row_danhmuc['danhmuctin_id']) {
                                ?>
                                <p class="form-control text-dark"><?php echo $row_danhmuc['tendanhmuc']; ?></p><br>
                                <?php
                            }
                        }
                    ?>
                </div>
                <?php
            } else {
                ?>
                <div class="col-md-12">
                    <?php
                    if(isset($_GET['thembaiviet'])) {
                        ?>
                         <h4>Thêm bài viết</h4>
                        <form action="" method="post" enctype="multipart/form-data">
                            <label for="">Tên bài viết</label>
                            <input type="text" class="form-control" name="tenbaiviet" placeholder="Tên sản phẩm" >
                            <label for="">Hình ảnh</label>
                            <input type="file" class="form-control" name="hinhanh">
                            <label>Tóm tắt</label>
                            <textarea name="tomtat" class="form-control"></textarea>
                            <label>Nội dung</label>
                            <textarea name="noidung" class="form-control"></textarea><br>
                            <?php
                            $sql_danhmuc = mysqli_query($mysqli,"SELECT * FROM tbl_danhmuc_tin ORDER BY danhmuctin_id DESC");
                            ?>
                            <select name="danhmuc" class="form-control">
                                <option value="">--Chọn danh mục--</option>
                                <?php
                                while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)) {
                                ?>
                                <option value="<?php echo $row_danhmuc['danhmuctin_id']; ?>"><?php echo $row_danhmuc['tendanhmuc']; ?></option>
                                <?php
                                }
                                ?>
                            </select><br>
                            <input type="submit" value="Thêm bài viết" name="thembaiviet" class="btn btn-success mt-2">
                        </form>
                        <?php
                    } else {
                        ?>
                        <a href="dashboard.php?quanly=xulybaiviet&thembaiviet" class="btn btn-success mb-2">Thêm bài viết</a>
                        <?php
                    }
                    ?>
                   
                </div>
                <?php
            }
            ?>
            
                    

            <div class="col-md-12">
                <h4>Liệt kê bài viết</h4>
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
                $sql_select_baiviet = mysqli_query($mysqli,"SELECT * FROM tbl_baiviet ORDER BY baiviet_id DESC LIMIT $begin,5");
                ?>
                <table class="table table-bordered">
                    <tr>
                        <th>Thứ tự</th>
                        <th>Tên bài viết</th>
                        <th>Danh mục</th>
                        <th>Quản lý</th>
                    </tr>
                    
                    <?php
                    $i = 0;
                    while($row_baiviet = mysqli_fetch_array($sql_select_baiviet)) {
                        $i++;
                        ?>
                            <tr>
                                <td class="w-10"><?php echo $i; ?></td>
                                <td class="w-50"><?php echo $row_baiviet['tenbaiviet']; ?></td>
                                
                                <?php
                                $sql_danhmuctin = mysqli_query($mysqli,"SELECT * FROM tbl_danhmuc_tin ORDER BY danhmuctin_id ASC");
                                while($row_danhmuctin = mysqli_fetch_array($sql_danhmuctin)) {
                                    if($row_danhmuctin['danhmuctin_id']==$row_baiviet['danhmuctin_id']) {
                                        ?>
                                        <td class="w-20"><?php echo $row_danhmuctin['tendanhmuc']; ?></td>
                                        <?php
                                    }
                                }
                                ?>
                                
                                <td class="w-20">
                                    <a href="?quanly=xulybaiviet?xoa&id=<?php echo $row_baiviet['baiviet_id']; ?>" class="">
                                    <span class="pl-2 pr-2 pt-1 pb-1 roundeded bg-danger text-white"><i class="fa fa-close"></i></span>
                                    </a>
                                    <a href="?quanly=xulybaiviet&capnhat&id=<?php echo $row_baiviet['baiviet_id']; ?>">
                                    <span class="pl-2 pr-2 pt-1 pb-1 roundeded bg-success text-white"><i class="fa fa-wrench"></i></span>
                                    </a>
                                    <a href="?quanly=xulybaiviet&chitiet&id=<?php echo $row_baiviet['baiviet_id']; ?>">
                                    <span class="pl-2 pr-2 pt-1 pb-1 roundeded bg-info text-white"><i class="fa fa-search"></i></span>
                                    </a>
                                </td>
                            </tr>
                        <?php
                    }
                    ?>
                </table>
                <nav aria-label="Page navigation example" class="mx-auto" style="width:300px;">
                    <?php
                    $sql_trang = mysqli_query($mysqli,"SELECT * FROM tbl_baiviet ORDER BY baiviet_id DESC");
                    $row_count = mysqli_num_rows($sql_trang);
                    $trang = ceil($row_count/5);
                    if($trang > 1) {
                    ?>
                    <ul class="pagination">
                        <li class="page-item">
                        <a class="page-link" href="?quanly=xulybaiviet&trang=<?php $trang_previous = $trang_active-1; if($trang_previous>1) echo $trang_previous; else echo 1; ?>" aria-label="">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                        </li>
                        <?php
                        for($i=1;$i<=$trang;$i++) {
                        ?>
                        <li class="page-item <?php if($trang_active==$i) echo 'active'; ?>"><a class="page-link" href="?quanly=xulybaiviet&trang=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php
                        }
                        ?>
                        <li class="page-item">
                        <a class="page-link" 
                        href="?quanly=xulybaiviet&trang=<?php $trang_next = $trang_active+1; if($trang_next<=$trang) echo $trang_next; else echo $trang; ?>">
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
