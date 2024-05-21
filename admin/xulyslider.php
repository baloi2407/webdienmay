<?php
if(isset($_POST['themslider'])) {
    $tenslider = $_POST['tenslider'];
    $hinhanh = $_FILES['hinhanh']['name'];
    $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
    $caption = $_POST['slider_caption'];
    $tinhtrang = $_POST['slider_active'];
    $path = '../uploads/';
    $sql_insert_sanpham = mysqli_query($mysqli,"INSERT INTO
    tbl_slider(slider_title,slider_image,slider_caption,slider_active)
    values('$tenslider','$hinhanh','$caption','$tinhtrang') ");
    move_uploaded_file($hinhanh_tmp,$path.$hinhanh);
}
elseif(isset($_POST['capnhatbanner'])) {
    $id = $_GET['id'];
    $tenslider = $_POST['tenslider'];
    $hinhanh = $_FILES['hinhanh']['name'];
    $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
    $caption = $_POST['slider_caption'];
    $tinhtrang = $_POST['slider_active'];
    $path = '../uploads/';
    if($hinhanh != '') {
        $sql_update_sanpham = mysqli_query($mysqli,"UPDATE tbl_slider SET slider_title='$tenslider', slider_image='$hinhanh' , slider_caption='$caption',
        slider_active='$tinhtrang'
        WHERE slider_id='$id' ");
        move_uploaded_file($hinhanh_tmp,$path.$hinhanh);
        
    } else {
        $sql_update_sanpham = mysqli_query($mysqli,"UPDATE tbl_slider SET slider_title='$tenslider' , slider_caption='$caption',
        slider_active='$tinhtrang'
        WHERE slider_id='$id' ");
        
    }

}
elseif(isset($_GET['xoa'])) {
    $id = $_GET['id'];
    $sql_delete = mysqli_query($mysqli,"DELETE FROM tbl_slider WHERE slider_id='$id' ");
}

?>
<div class="container py-xl-4 py-lg-2">
    <div class="row">
        <div class="col-md-12">
            <?php
            if(isset($_GET['capnhat'])) {
                $id = $_GET['id'];
                $sql_select_id = mysqli_query($mysqli,"SELECT * FROM tbl_slider WHERE slider_id='$id' ");
                $row_slider = mysqli_fetch_array($sql_select_id);
                ?>
                    <div class="col-md-12">
                        <h4>Cập nhật Banner</h4>
                        <form action="" method="post" enctype="multipart/form-data">
                            <label for="">Tên Banner</label>
                            <input type="text" class="form-control" name="tenslider" value="<?php echo $row_slider['slider_title'] ?>" >
                            <input type="hidden" class="form-control" name="slider_id" value="<?php echo $row_slider['slider_id']; ?>">
                            <label for="">Hình ảnh</label>
                            <input type="file" class="form-control" name="hinhanh">
                            <img style="max-height:80px;" src="../uploads/<?php echo $row_slider['slider_image']; ?>"><br>
                            <label>Banner Caption</label>
                            <input type="text" class="form-control" name="slider_caption" placeholder="" value="<?php echo $row_slider['slider_caption']; ?>"><br>
                            <select name="slider_active" id="" class="form-control">
                                <option value="<?php echo $row_slider['slider_active']; ?>">
                                <?php if($row_slider['slider_active']==0) echo 'Không kích hoạt'; elseif($row_slider['slider_active']==1) echo 'Kích hoạt'; ?>
                                </option>
                                <option value="<?php if($row_slider['slider_active']==0) echo '1';elseif($row_slider['slider_active']==1) echo '0'; ?>">
                                <?php if($row_slider['slider_active']==0) echo 'Kích hoạt'; elseif($row_slider['slider_active']==1) echo 'Không kích hoạt'; ?>
                                </option>
                                
                            </select>
                            
                            <input type="submit" value="Cập nhật banner" name="capnhatbanner" class="btn btn-success mt-2">
                        </form>
                    </div>
                <?php
            } elseif(isset($_GET['chitietsp'])) {
                $id = $_GET['id'];
                $sql_select_id = mysqli_query($mysqli,"SELECT * FROM tbl_slider WHERE slider_id='$id' ");
                $row_slider = mysqli_fetch_array($sql_select_id);
                ?>
                    <div class="col-md-12">
                        <h4>Chi tiết sản phẩm</h4>
                        <label for="">Tên Banner</label>
                        <p class="form-control text-dark"><?php echo $row_slider['slider_title'] ?></p><br>
                        <label for="">Hình ảnh</label><br>
                        <img style="min-height:80px;max-width:200px;" src="../uploads/<?php echo $row_slider['slider_image']; ?>"><br>
                        <label>Banner Caption</label>
                        <p class="form-control text-dark"><?php echo $row_slider['slider_caption']; ?></p><br>
                        <label for="">Tình trạng</label>
                        <p class="form-control text-dark">
                            <?php if($row_slider['slider_active']==0) echo 'Không kích hoạt'; elseif($row_slider['slider_active']==1) echo 'Kích hoạt'; ?>
                        </p>
                    </div>
                <?php
            }  else {
                ?>
                    <div class="col-md-12">
                    <?php
                    if(isset($_GET['themslider'])) {
                        ?>
                            <h4>Thêm Banner</h4>
                            <form action="" method="post" enctype="multipart/form-data">
                                <label for="">Tên Banner</label>
                                <input type="text" class="form-control" name="tenslider" placeholder="Tên Banner" >
                                <label for="">Hình ảnh</label>
                                <input type="file" class="form-control" name="hinhanh">
                                <label>Banner Caption</label>
                                <input type="text" class="form-control" name="slider_caption" placeholder="Banner Caption"><br>
                                <select name="slider_active" class="form-control">
                                    <option value="0">Không kích hoạt</option>
                                    <option value="1">Kích hoạt</option>
                                </select> 
                               
                                <input type="submit" value="Thêm Banner" name="themslider" class="btn btn-success mt-2">
                            </form>
                            <?php
                    } else {
                        ?>
                        <a class="btn btn-success mb-2" href="dashboard.php?quanly=slider&themslider">Thêm Banner</a>
                        <?php
                    }
                    ?>
                    </div>
                <?php
            }
            ?>
            <br>
            
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
                $sql_select = mysqli_query($mysqli,"SELECT * FROM tbl_slider ORDER BY slider_id DESC LIMIT $begin,5");
                ?>
                <div class="col-md-12">
                    <h4>Liệt kê sản phẩm</h4>    
                    <table class="table table-bordered">
                        <tr>
                            <th>Thứ tự</th>
                            <th>Tên Banner</th>
                            <th>Banner Caption</th>
                            <th>Tình trạng</th>
                            <th>Quản lý</th>
                        </tr>
                        
                        <?php
                        $i = 0;
                        while($row = mysqli_fetch_array($sql_select)) {
                            $i++;
                            ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row['slider_title']; ?></td>
                                    <td><?php echo $row['slider_caption']; ?></td>
                                    <td><?php if($row['slider_active']==0) echo 'Không kích hoạt'; elseif($row['slider_active']==1) echo 'Kích hoạt'; ?></td>
                                    <td>
                                        <a href="?quanly=slider&xoa&id=<?php echo $row['slider_id']; ?>" class="">
                                        <span class="pl-2 pr-2 pt-1 pb-1 roundeded bg-danger text-white"><i class="fa fa-close"></i></span>
                                        </a>
                                        <a href="?quanly=slider&capnhat&id=<?php echo $row['slider_id']; ?>">
                                        <span class="pl-2 pr-2 pt-1 pb-1 roundeded bg-success text-white"><i class="fa fa-wrench"></i></span>
                                        </a>	
                                        <a href="?quanly=slider&chitietsp&id=<?php echo $row['slider_id']; ?>">
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
                        $sql_trang = mysqli_query($mysqli,"SELECT * FROM tbl_slider ORDER BY slider_id DESC");
                        $row_count = mysqli_num_rows($sql_trang);
                        $trang = ceil($row_count/5);
                        if($trang > 1) {
                        ?>
                        <ul class="pagination">
                            <li class="page-item">
                            <a class="page-link" href="?quanly=slider&trang=<?php $trang_previous = $trang_active-1; if($trang_previous>1) echo $trang_previous; else echo 1; ?>" aria-label="">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                            </li>
                            <?php
                            for($i=1;$i<=$trang;$i++) {
                            ?>
                            <li class="page-item <?php if($trang_active==$i) echo 'active'; ?>"><a class="page-link" href="?quanly=slider&trang=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php
                            }
                            ?>
                            <li class="page-item">
                            <a class="page-link" 
                            href="?quanly=slider&trang=<?php $trang_next = $trang_active+1; if($trang_next<=$trang) echo $trang_next; else echo $trang; ?>">
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
                <?php
            ?>
        </div>
    </div>
</div>
