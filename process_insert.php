<?php 

$tieu_de = $_POST['tieu_de'];
$noi_dung = $_POST['noi_dung'];
$anh = $_POST['anh'];

require 'connect.php';
$sql = "insert into tin_tuc(tieu_de, noi_dung, anh) values ('$tieu_de', '$noi_dung', '$anh')";

mysqli_query($ket_noi, $sql);

$error = mysqli_error($ket_noi);
echo $error;

mysqli_close($ket_noi);