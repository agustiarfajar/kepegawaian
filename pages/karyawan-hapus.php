<?php
include_once("functions.php");
session_start();
if(!isset($_SESSION["kode_user"]))
{
    header("Location: ../index.php?error=4");
}
if(isset($_POST["btnHapus"]))
{
    $db = dbConnect();
    if($db->connect_errno==0)
    {
        $kodkar=$db->escape_string($_POST["kode_karyawan"]);
        $sql = "DELETE FROM karyawan WHERE kode_karyawan='$kodkar'";
        $res = $db->query($sql);
        if($res)
        {
            if($db->affected_rows>0)
            {
                header("Location: karyawan.php?success=3");
            }
        }
        else
            return FALSE;
    }
    else
		echo "Gagal koneksi".(DEVELOPMENT?" : ".$db->connect_error:"")."<br>";
}
?>