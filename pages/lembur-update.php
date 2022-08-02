<?php
include_once("functions.php");
session_start();
if(!isset($_SESSION["kode_user"]))
{
    header("Location: ../index.php?error=4");
}
if(isset($_POST["btnUpdate"]))
{
    $db = dbConnect();
    if($db->connect_errno==0)
    {
        $kode_lembur=$db->escape_string($_POST["kode_lembur"]);
        $kode_karyawan=$db->escape_string($_POST["kode_karyawan"]);
        $tanggal=$db->escape_string($_POST["tanggal"]);
        $keterangan=$db->escape_string($_POST["keterangan"]);
        $kode_user=$db->escape_string($_POST["kode_user"]);

        $sql = "UPDATE lembur SET kode_karyawan='$kode_karyawan',tanggal='$tanggal',keterangan='$keterangan', kode_user='" . $db->escape_string($_SESSION["kode_user"]) . "' WHERE kode_lembur='$kode_lembur'";
        $res = $db->query($sql);
        if($res)
        {
            if($db->affected_rows>0)
            {
                header("Location: lembur.php?success=2");
            } else
                header("Location: lembur.php?warning=perubahan");
        }
        else
            return FALSE;
    }
    else
		echo "Gagal koneksi".(DEVELOPMENT?" : ".$db->connect_error:"")."<br>";
}
?>