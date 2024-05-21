<?php
include('../db/connect.php');
?>
<?php
$email = $_GET['email'];
$sql = mysqli_query($mysqli,"SELECT * FROM tbl_khachhang_account WHERE email='$email'");
$count = mysqli_num_rows($sql);
echo json_encode(['count'=>$count]);

?>
