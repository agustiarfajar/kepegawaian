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
        $kodkar=$db->escape_string($_POST["kode_karyawan"]);
        $nik=$db->escape_string($_POST["nik"]);
        $nama=$db->escape_string($_POST["nama"]);
        $kodbag=$db->escape_string($_POST["kode_bagian"]);
        $jk=$db->escape_string($_POST["jk"]);
        $alamat=$db->escape_string($_POST["alamat"]);
        $no=$db->escape_string($_POST["no_telp"]);
        $tl=$db->escape_string($_POST["tanggal_lahir"]);
        $stat=$db->escape_string($_POST["status_kawin"]);
        $tm=$db->escape_string($_POST["tanggal_masuk"]);

        $sql = "UPDATE karyawan SET nama='$nama',nik='$nik',kode_bagian='$kodbag',jk='$jk',alamat='$alamat',no_telp='$no',
                tanggal_lahir='$tl',status_kawin='$stat',tanggal_masuk='$tm' WHERE kode_karyawan='$kodkar'";
        $res = $db->query($sql);
        if($res)
        {
            if($db->affected_rows>0)
            {
                header("Location: karyawan.php?success=2");
            } else
                header("Location: karyawan.php?warning=perubahan");
        }
        else
            return FALSE;
    }
    else
		echo "Gagal koneksi".(DEVELOPMENT?" : ".$db->connect_error:"")."<br>";
}
?>