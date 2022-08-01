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
        $kode_lembur=$db->escape_string($_POST["kode_lembur"]);
        $sql = "DELETE FROM lembur WHERE kode_lembur='$kode_lembur'";
        $res = $db->query($sql);
        if($res)
        {
            if($db->affected_rows>0)
            {
                header("Location: lembur.php?success=3");
            }
        }
        else
            return FALSE;
    }
    else
		echo "Gagal koneksi".(DEVELOPMENT?" : ".$db->connect_error:"")."<br>";
}
?>