<?php

?>

<div class="container py-xl-4 py-lg-2">
    <div class="col-md-12">
        <form action="./xulythongke.php" method="get">
            <div class="row">
                <div class="col-md-3">
                    <input type="date" class="form-control" placeholder="Từ ngày:" name="startday" id="" required>
                </div>
                <div class="col-md-3">
                    <input type="date" class="form-control" placeholder="Đến ngày:" name="endday" id="" required>
                </div>
                <div class="col-md-3">
                    <input type="submit" class="btn btn-primary" value="Tìm kiếm" id="btnTim">
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-12">
        <h4 class="mt-2 mb-2">Bảng thống kê</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Thứ tự</th>
                    <th>Danh mục</th>
                    <th>Số lượng bán ra</th>
                    <th>Tổng tiền</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
           
        </table>
    </div>
</div>
