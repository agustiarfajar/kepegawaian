<?php
session_id("basdat2");
session_start();
include_once("functions.php");
$db = dbConnect();
if($db->connect_errno==0)
{
    if($_POST["kode_user"])
    {
        $kode_user = $_POST["kode_user"];

        $sql = "DELETE FROM user
                WHERE kode_user='$kode_user'";
        $res = $db->query($sql);
        if($res)
        {
            if($db->affected_rows>0)
            {
                header("Location: pengguna.php?success=3");
            }
            else 
            {
                header("Location: pengguna.php?warning=perubahan");
            }
        }
        else
        {
            if($kode_user == $_SESSION["kode_user"])
            {
                $_SESSION["fk"] = "tidak bisa menghapus user yang sedang login.";
            }
            else 
            {
                $_SESSION["fk"] = "user ini sedang dipakai di tabel lain.";
            } 
            
            header("Location: pengguna.php?error=fk");      
        }   
    }   
}
else 
    header("Location: pengguna.php?error=koneksi");
?>