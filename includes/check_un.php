<?php
include('../db/connect.php');
?>
<?php
$tendangnhap = $_GET['tendangnhap'];
$sql = mysqli_query($mysqli,"SELECT * FROM tbl_khachhang_account WHERE tendangnhap='$tendangnhap'");
$count = mysqli_num_rows($sql);
echo json_encode(['count'=>$count]);

?>