<?php 
include_once("../layout.php");
include_once("functions.php");
session_start();
if(!isset($_SESSION["kode_user"]))
{
    header("Location: ../index.php?error=akses");
}
?>
<?php style_section() ?>
<?php sidebar() ?>
<div id="main">
<header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Form Edit Bagian</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="bagian.php">Bagian</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Bagian</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
                <?php 
                function getDataProduk5($kode_bagian){
                    $db=dbConnect();
                    if($db->connect_errno==0){
                        $res=$db->query("SELECT * FROM bagian WHERE kode_bagian='$kode_bagian'");
                        if($res){
                            if($res->num_rows==1){
                                $data=$res->fetch_assoc();
                                return $data;
                                $res->free();
                                
                            }
                            else
                                return FALSE;
                        }
                        else
                            return FALSE; 
                    }
                    else
                        return FALSE;
                }
                ?>
                <?php

	$db=dbConnect();
	$kode_bagian=$db->escape_string($_GET["kode_bagian"]);
	if($row=getDataProduk5($kode_bagian)){// cari data produk, kalau ada simpan di $dataproduk
		?>
                <!-- Form Update -->
                <form class="form" method="post" name="frm" action="">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="kode_bagian">Kode Bagian</label>
                                                                <input type="text" id="kode_bagian" class="form-control" name="kode_bagian" 
                                                                value="<?php echo $row["kode_bagian"];?>" readonly>
                                                            </div>    
                                                            <div class="form-group">
                                                                <label for="nama">Nama </label>
                                                                <input type="text" id="nama" class="form-control" placeholder="John Doe" name="nama" 
                                                                value="<?php echo $row["nama"];?>" required>
                                                            </div>                                                     
                                                            <div class="form-group">
                                                                <label for="gaji_pokok">Gaji Pokok</label>
                                                                <input type="number" id="gaji_pokok" class="form-control" placeholder="Rp" name="gaji_pokok" 
                                                                value="<?php echo $row["gaji_pokok"];?>" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="tunjangan_bagian">Tunjangan</label>
                                                                <input type="number" id="tunjangan_bagian" class="form-control" placeholder="Rp" name="tunjangan_bagian" 
                                                                value="<?php echo $row["tunjangan_bagian"];?>" required>
    </div>
                                                        <div class="col-12 d-flex justify-content-end">
                                                            <button type="submit" name="tblUpdate" class="btn btn-primary me-1 mb-1" value="simpan">Submit</button>
                                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                                        </div>
                                                        </div>
                                                </form>
<?php   } ?>
                <!-- end of form update -->
<!-- Tombol Submit -->
<?php
if(isset($_POST["tblUpdate"])){
	$db=dbConnect();
	if($db->connect_errno==0){
		// Bersihkan data
		$kode_bagian=$db->escape_string($_POST["kode_bagian"]);
		$nama=$db->escape_string($_POST["nama"]);
		$gaji_pokok=$db->escape_string($_POST["gaji_pokok"]);
		$tunjangan_bagian=$db->escape_string($_POST["tunjangan_bagian"]);
		// Susun query Update
		$sql="UPDATE bagian SET 
			  kode_bagian='$kode_bagian',nama='$nama',gaji_pokok='$gaji_pokok',
			  tunjangan_bagian='$tunjangan_bagian'
			  WHERE kode_bagian='$kode_bagian'";
		// Eksekusi query update
		$res=$db->query($sql);
		if($res){
			{ // jika ada perubahan data
				echo "
            <script>
            alert('Data Bagian $kode_bagian berhasil diUpdate');
             window.location.href = 'bagian.php';
            </script>";
	
				
			}
		}
		else{  
			header("Location: bagian.php?none=1");
			
		}
	}
	else
		echo "Gagal koneksi".(DEVELOPMENT?" : ".$db->connect_error:"")."<br>";
}
?>
<!-- end of tombol submit -->
<?php script_section() ?>
<script>
    // Simple Datatable
    let table1 = document.querySelector('#table1');
    let dataTable = new simpleDatatables.DataTable(table1);
</script>