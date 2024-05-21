<?php
if(isset($_POST['themsanpham'])) {
    $tensanpham = $_POST['tensanpham'];
    $hinhanh = $_FILES['hinhanh']['name'];
    $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
    $soluong = $_POST['soluong'];
    $gia = $_POST['giasanpham'];
    $giakhuyenmai = $_POST['giakhuyenmai'];
    $danhmuc = $_POST['danhmuc'];
    $chitiet = $_POST['chitiet'];
    $mota = $_POST['mota'];
    $path = '../uploads/';
    $sql_insert_sanpham = mysqli_query($mysqli,"INSERT INTO
    tbl_sanpham(sanpham_name,sanpham_image,sanpham_soluong,sanpham_gia,sanpham_giakhuyenmai,sanpham_mota,sanpham_chitiet,danhmuc_id)
    values('$tensanpham','$hinhanh','$soluong','$gia','$giakhuyenmai','$mota','$chitiet',$danhmuc) ");
    move_uploaded_file($hinhanh_tmp,$path.$hinhanh);
}
elseif(isset($_POST['capnhatsanpham'])) {
    $sanpham_id = $_POST['sanpham_id'];
    $tensanpham = $_POST['tensanpham'];
    $hinhanh = $_FILES['hinhanh']['name'];
    $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
    $soluong = $_POST['soluong'];
    $gia = $_POST['giasanpham'];
    $giakhuyenmai = $_POST['giakhuyenmai'];
    $danhmuc = $_POST['danhmuc'];
    $chitiet = $_POST['chitiet'];
    $mota = $_POST['mota'];
    $path = '../uploads/';
    if($hinhanh != '') {
        if($mota == '' && $chitiet == '') {
            $sql_update_sanpham = mysqli_query($mysqli,"UPDATE tbl_sanpham SET sanpham_name='$tensanpham', sanpham_image='$hinhanh' , sanpham_soluong='$soluong',
            sanpham_gia='$gia', sanpham_giakhuyenmai='$giakhuyenmai', danhmuc_id='$danhmuc'
            WHERE sanpham_id='$sanpham_id' ");
            move_uploaded_file($hinhanh_tmp,$path.$hinhanh);
        } elseif($mota != '' && $chitiet == '') {
            $sql_update_sanpham = mysqli_query($mysqli,"UPDATE tbl_sanpham SET sanpham_name='$tensanpham', sanpham_image='$hinhanh' , sanpham_soluong='$soluong',
            sanpham_gia='$gia', sanpham_giakhuyenmai='$giakhuyenmai', danhmuc_id='$danhmuc', sanpham_mota='$mota'
            WHERE sanpham_id='$sanpham_id' ");
            move_uploaded_file($hinhanh_tmp,$path.$hinhanh);
        } elseif($mota == '' && $chitiet != '') {
            $sql_update_sanpham = mysqli_query($mysqli,"UPDATE tbl_sanpham SET sanpham_name='$tensanpham', sanpham_image='$hinhanh' , sanpham_soluong='$soluong',
            sanpham_gia='$gia', sanpham_giakhuyenmai='$giakhuyenmai', danhmuc_id='$danhmuc', sanpham_chitiet='$chitiet'
            WHERE sanpham_id='$sanpham_id' ");
            move_uploaded_file($hinhanh_tmp,$path.$hinhanh);
        } else {
            $sql_update_sanpham = mysqli_query($mysqli,"UPDATE tbl_sanpham SET sanpham_name='$tensanpham', sanpham_image='$hinhanh' , sanpham_soluong='$soluong',
            sanpham_gia='$gia', sanpham_giakhuyenmai='$giakhuyenmai', danhmuc_id='$danhmuc', sanpham_chitiet='$chitiet', sanpham_mota='$mota'
            WHERE sanpham_id='$sanpham_id' ");
            move_uploaded_file($hinhanh_tmp,$path.$hinhanh);
        }
    } else {
        if($mota == '' && $chitiet == '') {
            $sql_update_sanpham = mysqli_query($mysqli,"UPDATE tbl_sanpham SET sanpham_name='$tensanpham', sanpham_soluong='$soluong',
            sanpham_gia='$gia', sanpham_giakhuyenmai='$giakhuyenmai', danhmuc_id='$danhmuc'
            WHERE sanpham_id='$sanpham_id' ");
        } elseif($mota != '' && $chitiet == '') {
            $sql_update_sanpham = mysqli_query($mysqli,"UPDATE tbl_sanpham SET sanpham_name='$tensanpham', sanpham_soluong='$soluong',
            sanpham_gia='$gia', sanpham_giakhuyenmai='$giakhuyenmai', danhmuc_id='$danhmuc', sanpham_mota='$mota'
            WHERE sanpham_id='$sanpham_id' ");
        } elseif($mota == '' && $chitiet != '') {
            $sql_update_sanpham = mysqli_query($mysqli,"UPDATE tbl_sanpham SET sanpham_name='$tensanpham', sanpham_soluong='$soluong',
            sanpham_gia='$gia', sanpham_giakhuyenmai='$giakhuyenmai', danhmuc_id='$danhmuc', sanpham_chitiet='$chitiet'
            WHERE sanpham_id='$sanpham_id' ");
        } else {
            $sql_update_sanpham = mysqli_query($mysqli,"UPDATE tbl_sanpham SET sanpham_name='$tensanpham', sanpham_soluong='$soluong',
            sanpham_gia='$gia', sanpham_giakhuyenmai='$giakhuyenmai', danhmuc_id='$danhmuc', sanpham_chitiet='$chitiet', sanpham_mota='$mota'
            WHERE sanpham_id='$sanpham_id' ");
        }
    }

}
elseif(isset($_GET['xoa'])) {
    $id = $_GET['id'];
    $sql_delete = mysqli_query($mysqli,"DELETE FROM tbl_sanpham WHERE sanpham_id='$id' ");
}

?>
<div class="container py-xl-4 py-lg-2">
    <div class="row">
        <div class="col-md-12">
            <?php
            if(isset($_GET['capnhat'])) {
                $id = $_GET['id'];
                $sql_select_id = mysqli_query($mysqli,"SELECT * FROM tbl_sanpham WHERE sanpham_id='$id' ");
                $row_product = mysqli_fetch_array($sql_select_id);
                $danhmuc_id = $row_product['danhmuc_id'];
                ?>
                    <div class="col-md-12">
                        <h4>Cập nhật sản phẩm</h4>
                        <form action="" method="post" enctype="multipart/form-data">
                            <label for="">Tên sản phẩm</label>
                            <input type="text" class="form-control" name="tensanpham" value="<?php echo $row_product['sanpham_name'] ?>" >
                            <input type="hidden" class="form-control" name="sanpham_id" value="<?php echo $row_product['sanpham_id']; ?>">
                            <label for="">Hình ảnh</label>
                            <input type="file" class="form-control" name="hinhanh">
                            <img style="max-height:80px;" src="../uploads/<?php echo $row_product['sanpham_image']; ?>"><br>
                            <label>Giá</label>
                            <input type="number" class="form-control" name="giasanpham" placeholder="Giá sản phẩm" value="<?php echo $row_product['sanpham_gia']; ?>" min="1"><br>
                            <label>Giá khuyến mãi</label>
                            <input type="number" class="form-control" name="giakhuyenmai" placeholder="Giá khuyến mãi" value="<?php echo $row_product['sanpham_giakhuyenmai']; ?>" min="0" max="100"><br>
                            <label>Số lượng</label>
                            <input type="number" class="form-control" name="soluong" placeholder="Số lượng" value="<?php echo $row_product['sanpham_soluong']; ?>" min="0"><br>
                            <label>Mô tả</label>
                            <textarea name="mota" class="form-control" placeholder="<?php echo $row_product['sanpham_mota']; ?>"></textarea><br>
                            <label>Chi tiết</label>
                            <textarea name="chitiet" class="form-control" placeholder="<?php echo $row_product['sanpham_chitiet']; ?>"></textarea><br>
                            <?php
                                $sql_danhmuc = mysqli_query($mysqli,"SELECT * FROM tbl_danhmuc ORDER BY danhmuc_id ASC");
                            ?>
                            <select name="danhmuc" class="form-control">
                                <option value="0">--Chọn danh mục--</option>
                                <?php
                                    while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)) {
                                        if($danhmuc_id == $row_danhmuc['danhmuc_id']) {
                                ?>
                                <option selected value="<?php echo $row_danhmuc['danhmuc_id']; ?>"><?php echo $row_danhmuc['danhmuc_ten']; ?></option>
                                <?php
                                        } else {
                                            ?>
                                                <option value="<?php echo $row_danhmuc['danhmuc_id']; ?>"><?php echo $row_danhmuc['danhmuc_ten']; ?></option>
                                            <?php
                                        }
                                    }
                                ?>
                            </select><br>
                            <input type="submit" value="Cập nhật sản phẩm" name="capnhatsanpham" class="btn btn-success mt-2">
                        </form>
                    </div>
                <?php
            } elseif(isset($_GET['chitietsp'])) {
                $id = $_GET['id'];
                $sql_select_id = mysqli_query($mysqli,"SELECT * FROM tbl_sanpham WHERE sanpham_id='$id' ");
                $row_product = mysqli_fetch_array($sql_select_id);
                $danhmuc_id = $row_product['danhmuc_id'];
                ?>
                    <div class="col-md-12">
                        <h4>Chi tiết sản phẩm</h4>
                        <label for="">Tên sản phẩm</label>
                        <p class="form-control text-dark"><?php echo $row_product['sanpham_name'] ?></p><br>
                        <label for="">Hình ảnh</label><br>
                        <img style="min-height:80px;max-width:200px;" src="../uploads/<?php echo $row_product['sanpham_image']; ?>"><br>
                        <label>Giá</label>
                        <p class="form-control text-dark"><?php echo $row_product['sanpham_gia']; ?></p><br>
                        <label>Giá khuyến mãi</label>
                        <p class="form-control text-dark"><?php echo $row_product['sanpham_giakhuyenmai']; ?></p><br>
                        <label>Số lượng</label>
                        <p class="form-control text-dark"><?php echo $row_product['sanpham_soluong']; ?></p><br>
                        <label>Mô tả</label>
                        <p class="form-control text-dark"><?php echo $row_product['sanpham_mota']; ?></p><br>
                        <label>Chi tiết</label>
                        <p class="form-control text-dark"><?php echo $row_product['sanpham_chitiet']; ?></p><br>
                        <label for="">Danh mục</label>
                        <?php
                            $sql_danhmuc = mysqli_query($mysqli,"SELECT * FROM tbl_danhmuc ORDER BY danhmuc_id ASC");
                            while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)) {
                                if($danhmuc_id == $row_danhmuc['danhmuc_id']) {
                                    ?>
                                    <p class="form-control text-dark"><?php echo $row_danhmuc['danhmuc_ten']; ?></p><br>
                                    <?php
                                }
                            }
                        ?>
                    </div>
                <?php
            }  else {
                ?>
                    <div class="col-md-12">
                    <?php
                    if(isset($_GET['themsanpham'])) {
                        ?>
                            <h4>Thêm sản phẩm</h4>
                            <form action="" method="post" enctype="multipart/form-data">
                                <label for="">Tên sản phẩm</label>
                                <input type="text" class="form-control" name="tensanpham" placeholder="Tên sản phẩm" >
                                <label for="">Hình ảnh</label>
                                <input type="file" class="form-control" name="hinhanh">
                                <label>Giá</label>
                                <input type="number" class="form-control" name="giasanpham" placeholder="Giá sản phẩm" min="1"><br>
                                <label>Giá khuyến mãi</label>
                                <input type="number" class="form-control" name="giakhuyenmai" placeholder="Giá khuyến mãi" max="100"><br>
                                <label>Số lượng</label>
                                <input type="number" class="form-control" name="soluong" placeholder="Số lượng" min="1"><br>
                                <label>Chi tiết</label>
                                <textarea name="chitiet" class="form-control"></textarea>
                                <label>Mô tả</label>
                                <textarea name="mota" class="form-control"></textarea><br>
                                <?php
                                $sql_danhmuc = mysqli_query($mysqli,"SELECT * FROM tbl_danhmuc ORDER BY danhmuc_id DESC");
                                ?>
                                <select name="danhmuc" class="form-control">
                                    <option value="">--Chọn danh mục--</option>
                                    <?php
                                    while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)) {
                                    ?>
                                    <option value="<?php echo $row_danhmuc['danhmuc_id']; ?>"><?php echo $row_danhmuc['danhmuc_ten']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select><br>
                                <input type="submit" value="Thêm sản phẩm" name="themsanpham" class="btn btn-success mt-2">
                            </form>
                            <?php
                    } else {
                        ?>
                        <a class="btn btn-success mb-2" href="dashboard.php?quanly=xulysanpham&themsanpham">Thêm sản phẩm</a>
                        <?php
                    }
                    ?>
                    </div>
                <?php
            }
            ?>
            <br>
            <div class="col-md-12">
                <form action="./timkiemsanpham.php" method="get">
                    <div class="row">
                        <div class="col-md-3">
                            <input type="text" class="form-control" placeholder="Tên sản phẩm" name="tensanpham" id="tensp">
                        </div>
                        <div class="col-md-3">
                            <?php
                            $sql_danhmuc = mysqli_query($mysqli,"SELECT * FROM tbl_danhmuc ORDER BY danhmuc_id DESC");
                            ?>
                            <select name="danhmuc" class="form-control" id="danhmuc">
                                <option value="">--Chọn danh mục--</option>
                                <?php
                                while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)) {
                                ?>
                                <?php
                                $danhmuc = $_POST['danhmuc'];
                                if($danhmuc == $row_danhmuc['danhmuc_id']) {
                                    ?>
                                    <option selected value="<?php echo $row_danhmuc['danhmuc_id']; ?>"><?php echo $row_danhmuc['danhmuc_ten']; ?></option>
                                    <?php
                                } else {
                                    ?>
                                    <option value="<?php echo $row_danhmuc['danhmuc_id']; ?>"><?php echo $row_danhmuc['danhmuc_ten']; ?></option>
                                    <?php
                                }
                                ?>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <?php
                            $sql_gia = mysqli_query($mysqli,"SELECT * FROM tbl_gia ORDER BY id_gia DESC");
                            ?>
                            <select name="gia" class="form-control" id="gia">
                                <option value="">--Chọn gía--</option>
                                <?php
                                while($row_gia = mysqli_fetch_array($sql_gia)) {
                                ?>
                                <?php
                                $gia = $_POST['gia'];
                                if($gia == $row_gia['gia']) {
                                    ?>
                                    <option selected value="<?php echo $row_gia['gia']; ?>"><?php echo $row_gia['loaigia']; ?></option>
                                    <?php
                                } else {
                                    ?>
                                    <option value="<?php echo $row_gia['gia']; ?>"><?php echo $row_gia['gia']; ?></option>
                                    <?php
                                }
                                ?>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="submit" class="btn btn-primary" value="Tìm kiếm" id="btnTim">
                        </div>
                    </div>
                </form>
            </div>
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
                $sql_select_sanpham = mysqli_query($mysqli,"SELECT * FROM tbl_sanpham,tbl_danhmuc WHERE tbl_sanpham.danhmuc_id=tbl_danhmuc.danhmuc_id ORDER BY sanpham_id DESC LIMIT $begin,5");
                ?>
                <div class="col-md-12">
                    <h4>Liệt kê sản phẩm</h4>    
                    <table class="table table-bordered">
                        <tr>
                            <th>Thứ tự</th>
                            <th>Tên sản phẩm</th>
                            <th>Tên số lượng</th>
                            <th class="">Giá sản phẩm</th>
                            <th>Khuyến mãi</th>
                            <th>Quản lý</th>
                        </tr>
                        
                        <?php
                        $i = 0;
                        while($row_sanpham = mysqli_fetch_array($sql_select_sanpham)) {
                            $i++;
                            ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row_sanpham['sanpham_name']; ?></td>
                                    <!-- <td><img style="max-height:80px;" src="../uploads/<?php echo $row_sanpham['sanpham_image']; ?>" alt=""></td> -->
                                    <td><?php echo $row_sanpham['sanpham_soluong']; ?></td>
                                    <td><?php echo number_format($row_sanpham['sanpham_gia']).'vnđ'; ?></td>
                                    <td><?php echo $row_sanpham['sanpham_giakhuyenmai'].'%'; ?></td>
                                    <td>
                                        <a href="" data-toggle="modal" data-target="#exampleModal" >
                                        <span class="pl-2 pr-2 pt-1 pb-1 roundeded bg-danger text-white"><i class="fa fa-close"></i></span>
                                        </a>
                                        <a href="?quanly=xulysanpham&capnhat&id=<?php echo $row_sanpham['sanpham_id']; ?>">
                                        <span class="pl-2 pr-2 pt-1 pb-1 roundeded bg-success text-white"><i class="fa fa-wrench"></i></span>
                                        </a>	
                                        <a href="?quanly=xulysanpham&chitietsp&id=<?php echo $row_sanpham['sanpham_id']; ?>">
                                        <span class="pl-2 pr-2 pt-1 pb-1 roundeded bg-info text-white"><i class="fa fa-search"></i></span>
                                        </a>	
                                    </td>
                                </tr>
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-center">Xoá sản phẩm</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            
                                                <div class="right-w3l">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <a href="?quanly=xulysanpham&xoa&id=<?php echo $row_sanpham['sanpham_id']; ?>" class="btn btn-primary form-control">Xoá</a>
                                                            
                                                        </div>
                                                        <div class="col-md-6">
                                                            <a data-dismiss="modal" aria-label="Close" class="btn btn-secondary form-control"><span class="text-white">Không</span></a>

                                                        </div>
                                                    </div>
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
                        $sql_trang = mysqli_query($mysqli,"SELECT * FROM tbl_sanpham ORDER BY sanpham_id DESC");
                        $row_count = mysqli_num_rows($sql_trang);
                        $trang = ceil($row_count/5);
                        if($trang > 1) {
                        ?>
                        <ul class="pagination">
                            <li class="page-item">
                            <a class="page-link" href="?quanly=xulysanpham&trang=<?php $trang_previous = $trang_active-1; if($trang_previous>1) echo $trang_previous; else echo 1; ?>" aria-label="">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                            </li>
                            <?php
                            for($i=1;$i<=$trang;$i++) {
                            ?>
                            <li class="page-item <?php if($trang_active==$i) echo 'active'; ?>"><a class="page-link" href="?quanly=xulysanpham&trang=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php
                            }
                            ?>
                            <li class="page-item">
                            <a class="page-link" 
                            href="?quanly=xulysanpham&trang=<?php $trang_next = $trang_active+1; if($trang_next<=$trang) echo $trang_next; else echo $trang; ?>">
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
