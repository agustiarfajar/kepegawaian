<?php
    include_once("../layout.php");
    include_once("functions.php");
    session_start();
    if(!isset($_SESSION["kode_user"]))
    {
        header("Location: ../index.php?error=4");
    }
    if(isset($_POST["btnSimpan"])){
        // var_dump($_POST);
        // exit;
        $db=dbConnect();
        if($db->connect_errno==0){
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
            $sql="INSERT INTO karyawan (kode_karyawan,nik,nama,kode_bagian,jk,alamat,no_telp,tanggal_lahir,status_kawin,tanggal_masuk)
				  VALUES ('$kodkar','$nik','$nama','$kodbag','$jk','$alamat','$no','$tl','$stat','$tm')";
			$res=$db->query($sql);
            if($res){
                if($db->affected_rows>0){
                    header("Location: karyawan.php?success=1");
                }
			} else
				echo "Gagal ".(DEVELOPMENT?" : ".$db->error:"")."<br>";
        } else
            echo "Gagal koneksi".(DEVELOPMENT?" : ".$db->connect_error:"")."<br>";
    } else
        header("Location: karyawan.php?error=proses");
?>