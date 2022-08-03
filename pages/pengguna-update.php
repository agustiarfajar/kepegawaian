<?php
session_id("basdat2");
session_start();
include_once("functions.php");
$db = dbConnect();
if($db->connect_errno==0)
{
    // var_dump($_POST);
    // exit;
    $pesansalah = "";
    $v_kode_user = trim($_POST["kode_user"]);
    $v_nama = trim($_POST["nama"]);
    $v_no_telp = trim($_POST["no_telp"]);
    $v_username = trim($_POST["username"]);
    $v_level = trim($_POST["level"]);
    
    if(strlen($v_kode_user) == "")
    {
        $pesansalah .= "Kode User tidak boleh kosong<br>";
    }
    if(strlen($v_nama) == "")
    {
        $pesansalah .= "Nama tidak boleh kosong<br>";
    }
    if(strlen($v_no_telp) == "")
    {
        $pesansalah .= "No.Telepon tidak boleh kosong<br>";
    }
    if(strlen($v_username) == "")
    {
        $pesansalah .= "Username tidak boleh kosong<br>";
    }
    if(strlen($v_level) == "")
    {
        $pesansalah .= "Level tidak boleh kosong<br>";
    }
    if(!is_numeric($v_no_telp))
    {
        $pesansalah .= "Masukan No.Telepon harus berupa angka<br>";
    }

    if($pesansalah == "")
    {
        $kode_user = $db->escape_string($_POST["kode_user"]);
        $nama = $db->escape_string($_POST["nama"]);
        $no_telp = $db->escape_string($_POST["no_telp"]);
        $username = $db->escape_string($_POST["username"]);
        $level = $db->escape_string($_POST["level"]);

        $sql = "UPDATE user SET
                nama='$nama',
                no_telp='$no_telp',
                username='$username',
                level='$level'
                WHERE kode_user='$kode_user'";
        $res = $db->query($sql);
        if($res)
        {
            if($db->affected_rows>0)
            {
                header("Location: pengguna.php?success=2");
            } else {
                header("Location: pengguna.php?warning=perubahan");
            }
        }
        else
            echo "Error ".(DEVELOPMENT?":".$db->error:"");   
    } 
    else 
    {
        $_SESSION["salahinputuser"] = $pesansalah;
        header("Location: pengguna.php?error=input");
    }
}
else 
    header("Location: pengguna.php?error=koneksi");
?>