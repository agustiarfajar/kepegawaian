<?php
include_once("functions.php");
if(isset($_POST["TblSimpan"])){
	$db=dbConnect();
	if($db->connect_errno==0){
		// Bersihkan data
		$kode_bagian=$db->escape_string($_POST["kode_bagian"]);
		$nama=$db->escape_string($_POST["nama"]);
		$gaji_pokok=$db->escape_string($_POST["gaji_pokok"]);
		$tunjangan_bagian=$db->escape_string($_POST["tunjangan_bagian"]);
		// Susun query insert
		$sql="INSERT INTO bagian(kode_bagian,nama,gaji_pokok,tunjangan_bagian)
			  VALUES('$kode_bagian','$nama','$gaji_pokok','$tunjangan_bagian')";
		// Eksekusi query insert
		$res=$db->query($sql);
		if($res){
			if($db->affected_rows>0){ // jika ada penambahan data
				header("Location: bagian.php?sukses=1");
			}
		}
		else{ 					
			header("Location: bagian.php?error=input");
		}
	}
	else
		echo "Gagal koneksi".(DEVELOPMENT?" : ".$db->connect_error:"")."<br>";
}
?>