<?php
if(isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = '';
}
$loi = '';
if(isset($_POST['doimatkhau'])) {
    $matkhaumoi = $_POST['matkhaumoi'];
    if(strlen($matkhaumoi) == 0) {
        $loi = 'Chưa nhập mật khẩu';
    }
    elseif(strlen($matkhaumoi)<8) {$loi = "Mật khẩu quá ngắn. Vui lòng nhập mật khẩu có độ dài trên 8 ký tự.";}
    if($loi == '' ) {
        $matkhaumoi = md5($matkhaumoi);
        $sql_select_admin = mysqli_query($mysqli,"UPDATE tbl_khachhang_account SET matkhau='$matkhaumoi' WHERE id='$id' ");
        echo "<script>document.location='dashboard.php'</script>";
    }
}
?>
<div class="container mt-5">
    <div class="row gutters-sm">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="">Mật khẩu mới</label>
                            <div class="input-group mb-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                                </div>
                                <input name="matkhaumoi" type="password" class="input form-control" id="matkhau" placeholder="Mật khẩu mới" aria-label="password" aria-describedby="basic-addon1" />
                                <div class="input-group-append">
                                    <span class="input-group-text" onclick="password_show_hide();">
                                    <i class="fas fa-eye" id="show_eye"></i>
                                    <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                                    </span>
                                </div>
                            </div>
                            <p class="text-danger"><?php echo $loi; ?></p>
                        </div>
                        <button type="submit" class="btn btn-primary" name="doimatkhau">Cập nhật</button>
                    </form>                        
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function password_show_hide() {
    var x = document.getElementById("matkhau");
    var show_eye = document.getElementById("show_eye");
    var hide_eye = document.getElementById("hide_eye");
    hide_eye.classList.remove("d-none");
    if (x.type === "password") {
        x.type = "text";
        show_eye.style.display = "none";
        hide_eye.style.display = "block";
    } else {
        x.type = "password";
        show_eye.style.display = "block";
        hide_eye.style.display = "none";
    }
}

</script>