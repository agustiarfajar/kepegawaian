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
                    <h3>Data Pengguna Sistem</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Bagian</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-outline-primary block" data-bs-toggle="modal" data-bs-target="#default">
            Tambah
        </button>
        <br><br>
        <p>
            <?php 
                if(isset($_GET["success"]))
                {
                    $sks = $_GET["success"];
                    if($sks == "1")
                        showSuccess("Data berhasil disimpan.");
                    else if($sks == "2")
                        showSuccess("Data berhasil diubah.");
                    else if($sks == "3")
                        showSuccess("Data berhasil dihapus.");
                }
    
                if(isset($_GET["warning"]))
                {
                    $wrn = $_GET["warning"];
                    if($wrn == "perubahan")
                        showWarning("Tidak ada perubahan data.");                       
                }
    
                if(isset($_GET["error"]))
                {
                    $error = $_GET["error"];
                    if($error == "koneksi")
                        showError("Koneksi Gagal.");
                    else if($error == "proses")
                        showError("Terjadi kesalahan proses, silahkan coba lagi.");
                    else if($error == "input")
                        showError("Terjadi kesalahan masukan:<br>".$_SESSION["salahinputbagian"]);
                }
            ?>
        </p>
        <!--Extra Large Modal -->
        <div class="modal fade text-left w-100" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel16">Form Tambah Pengguna</h4>
                        <i class="bi bi-x-circle-fill" data-bs-dismiss="modal" style="font-size:14px;cursor:pointer"></i>      
                    </div>
                    <div class="modal-body">
                    <section id="multiple-column-form">
                        <div class="row match-height">
                            <div class="col-12">                            
                                <div class="card">                                
                                        <div class="card-content">
                                            <div class="card-body">
                                            <div class="row">
                                            </div>
                                            <form class="form" method="post" name="frm" action="">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="kode_bagian">Kode Bagian</label>
                                                            <input type="text" id="kode_bagian" class="form-control" name="kode_bagian" value ="<?php echo kodeBagianOtomatis() ?>" placeholder="Masukan Kode Bagian" readonly required>
                                                        </div>    
                                                        <div class="form-group">
                                                            <label for="nama">Nama </label>
                                                            <input type="text" id="nama" class="form-control" placeholder="Masukan Nama" name="nama" autocomplete="off">
                                                        </div>                                                     
                                                        <div class="form-group">
                                                            <label for="gaji_pokok">Gaji Pokok</label>
                                                            <input type="text" id="gaji_pokok" class="form-control" placeholder="Rp" name="gaji_pokok" autocomplete="off">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="tunjangan_bagian">Tunjangan</label>
                                                            <input type="text" id="tunjangan_bagian" class="form-control" placeholder="Rp" name="tunjangan_bagian" autocomplete="off">
                                                        </div>
                                                        <div class="col-12 d-flex justify-content-end">
                                                            <button type="submit" name="TblSimpan" class="btn btn-primary me-1 mb-1" value="simpan">Simpan</button>
                                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- PROSES SIMPAN -->
        <?php 
            if(isset($_POST["TblSimpan"])){
                $db=dbConnect();
                if($db->connect_errno==0){
                    // Bersihkan data
                    $pesansalah = "";
                    $v_kode_bagian = trim($_POST["kode_bagian"]);
                    $v_nama = trim($_POST["nama"]);
                    $v_gaji_pokok = trim($_POST["gaji_pokok"]);
                    $v_tunjangan_bagian = trim($_POST["tunjangan_bagian"]);
                    
                    if(strlen($v_kode_bagian) == "")
                    {
                        $pesansalah .= "Kode Bagian tidak boleh kosong<br>";
                    }
                    if(strlen($v_nama) == "")
                    {
                        $pesansalah .= "Nama tidak boleh kosong<br>";
                    }  
                    if(strlen($v_gaji_pokok) == "")
                    {
                        $pesansalah .= "Gaji Pokok tidak boleh kosong<br>";
                    }   
                    if(strlen($v_tunjangan_bagian) == "")
                    {
                        $pesansalah .= "Tunjangan tidak boleh kosong<br>";
                    }     
                    if(!is_numeric($v_gaji_pokok))
                    {
                        $pesansalah .= "Gaji Pokok harus berupa angka<br>";
                    }
                    if(!is_numeric($v_tunjangan_bagian))
                    {
                        $pesansalah .= "Tunjangan harus berupa angka<br>";
                    }
            
                    if($pesansalah == "")
                    {
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
                                echo "
                            <script>
                                window.location.href = 'bagian.php?success=1';
                            </script>";           
                            }
                            else
                                return FALSE;
                        }
                        else
                            return FALSE;
                    } 
                    else
                    {   
                        $_SESSION["salahinputbagian"] = $pesansalah;
                        echo "
                            <script>
                                window.location.href = 'bagian.php?error=input';
                            </script>";
                    }
                }       
                else
                    echo "Gagal koneksi".(DEVELOPMENT?" : ".$db->connect_error:"")."<br>";
            }
        ?>
        <!-- end of modal -->
        <section class="section">
            <div class="card">
                <div class="card-header">
                    Tabel Bagian
                </div>

                <!-- Menampilkan data bagian -->
                <div class="card-body">
                    
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Kode Bagian</th>
                                <th>Nama</th>
                                <th>Gaji Pokok<small>(Rp)</small></th>
                                <th>Tunjangan(Rp)</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>                         
                <?php 
                $db = dbConnect();
                if($db->connect_errno==0)
                {
                    $sql = "SELECT * FROM bagian";
                    $res = $db->query($sql);
                    if($res)
                    {
                        $data = $res->fetch_all(MYSQLI_ASSOC);
                        foreach($data as $row)
                        {
                            ?>
                            
                            <tr>
                            <td><?php echo $row["kode_bagian"] ?></td>
                            <td><?php echo $row["nama"] ?></td>
                            <td><?php echo number_format($row["gaji_pokok"],0,',','.') ?></td>
                            <td><?php echo number_format($row["tunjangan_bagian"],0,',','.') ?></td>
                            <td>
                            <a href="bagian-update.php?kode_bagian=<?php echo $row['kode_bagian']?>"><button class="btn btn-primary"><i class="bi bi-pencil-square"></i></button></a>
                            <a href="bagian-hapus.php?kode_bagian=<?php echo $row['kode_bagian']?>"><button name="TblHapus" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button></a>
                            </td>
                        
                            </td>
                        </tr>
                            <?php
                        }
                    }
                }
                ?>              

                                                
                </tbody>
                    </table>
                </div>
            </div>

            <!-- end of data bagian -->
        </section>
    </div>
</div>
<?php script_section() ?>
<script>
    // Simple Datatable
    let table1 = document.querySelector('#table1');
    let dataTable = new simpleDatatables.DataTable(table1);
</script>