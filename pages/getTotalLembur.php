<?php 
include_once("functions.php");
$kode_karyawan=$_GET["kode_karyawan"];
$db=dbConnect();
if($db->connect_errno==0){
    $sql="SELECT COUNT(*) as jml_lembur FROM lembur
          WHERE kode_karyawan='".$db->escape_string($kode_karyawan)."'";
    $res=$db->query($sql);
    $data=$res->fetch_assoc();
    echo json_encode($data);
}
?>