
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>Khách hàng</h4>
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
                $sql_select_khachhang = mysqli_query($mysqli,"SELECT * FROM tbl_khachhang,tbl_donhang
                WHERE tbl_khachhang.khachhang_id=tbl_donhang.khachhang_id
                GROUP BY tbl_donhang.mahang 
                ORDER BY tbl_khachhang.khachhang_id DESC LIMIT $begin,5");
                ?>
                <table class="table table-bordered">
                    <tr>
                        <th>Thứ tự</th>
                        <th>Tên khách hàng</th>
                        <th>Điện thoại</th>
                        <th>Ngày mua</th>
                        <th>Quản lý</th>
                    </tr>
                    <?php
                    $i = 0;
                    while($row_khachhang= mysqli_fetch_array($sql_select_khachhang)) {
                        $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row_khachhang['khachhang_name']; ?></td>
                        <td><?php echo $row_khachhang['phone']; ?></td>
                        <td><?php echo $row_khachhang['ngaythang']; ?></td>
                        <td><a href="?quanly=xulykhachhang&xemdonhang&mahang=<?php echo $row_khachhang['mahang']; ?>">
                        <span class="pl-2 pr-2 pt-1 pb-1 roundeded bg-warning text-white"><i class="fa fa-shopping-basket"></i></span>
                        </a> 
                        <a href="?quanly=xulykhachhang&xemtaikhoan&user=<?php echo $row_khachhang['user_id']; ?>">
                        <span class="pl-2 pr-2 pt-1 pb-1 roundeded bg-primary text-white"><i class="fa fa-user"></i></span>
                        </a>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </table>
                <?php
                    if(isset($_GET['xemtaikhoan'])) {
                        $user_id = $_GET['user'];
                        $sql = mysqli_query($mysqli,"SELECT * FROM tbl_khachhang_account WHERE id='$user_id'");
                        $row = mysqli_fetch_array($sql);
                        ?>
                        <table class="table table-bordered">
                            <tr>
                                <th>ID</th>
                                <th>Tài khoản</th>
                                <th>Email</th>
                            </tr>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['tendangnhap']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                            </tr>
                        </table>
                        <?php
                    }
                ?>
                <nav aria-label="Page navigation example" class="mx-auto" style="width:300px;">
                    <?php
                    $sql_trang = mysqli_query($mysqli,"SELECT * FROM tbl_khachhang,tbl_donhang
                    WHERE tbl_khachhang.khachhang_id=tbl_donhang.khachhang_id
                    GROUP BY tbl_donhang.mahang
                    ORDER BY tbl_khachhang.khachhang_id DESC");
                    $row_count = mysqli_num_rows($sql_trang);
                    $trang = ceil($row_count/5);
                    if($trang > 1) {
                    ?>
                    <ul class="pagination">
                        <li class="page-item">
                        <a class="page-link" href="?quanly=xulykhachhang&trang=<?php $trang_previous = $trang_active-1; if($trang_previous>1) echo $trang_previous; else echo 1; ?>" aria-label="">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                        </li>
                        <?php
                        for($i=1;$i<=$trang;$i++) {
                        ?>
                        <li class="page-item <?php if($trang_active==$i) echo 'active'; ?>"><a class="page-link" href="?quanly=xulykhachhang&trang=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php
                        }
                        ?>
                        <li class="page-item">
                        <a class="page-link" 
                        href="?quanly=xulykhachhang&trang=<?php $trang_next = $trang_active+1; if($trang_next<=$trang) echo $trang_next; else echo $trang; ?>">
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
            <div class="col-md-12">
                <h4>Liệt kê đơn hàng</h4>
                <?php 
                if(isset($_GET['xemdonhang'])) {
                    $mahang = $_GET['mahang'];
                } else {
                    $mahang = '';
                }
                $sql_select = mysqli_query($mysqli,"SELECT * FROM tbl_donhang,tbl_khachhang,tbl_sanpham
                WHERE tbl_donhang.sanpham_id=tbl_sanpham.sanpham_id AND tbl_khachhang.khachhang_id=tbl_donhang.khachhang_id
                AND tbl_donhang.mahang = '$mahang' 
                ORDER BY tbl_donhang.donhang_id DESC");
                ?>
                <table class="table table-bordered">
                    <tr>
                        <th>Thứ tự</th>
                        <th>Mã đơn hàng</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Ngày đặt</th>
                    </tr>
                    <?php
                    $i = 0;
                    while($row_donhang = mysqli_fetch_array($sql_select)) {
                        $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><a href="dashboard.php?quanly=xulydonhang&xemdonhang&mahang=<?php echo $row_donhang['mahang']; ?>" class="text-warning">
                        <?php echo $row_donhang['mahang']; ?>
                        </a></td>
                        <td><?php echo $row_donhang['sanpham_name']; ?></td>
                        <td><?php echo $row_donhang['soluong']; ?></td>
                        <td><?php echo $row_donhang['ngaythang']; ?></td>
                    </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
