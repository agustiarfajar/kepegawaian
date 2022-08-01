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
                            <h3>Bagian</h3>
                            
                        </div>
    
                    </div>
                </div>
                <!-- Tambah Data Bagian -->
                
                <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#xlarge">
                                                Tambah Data Bagian
                                            </button>
                                            <!--Extra Large Modal -->
        <div class="modal fade text-left w-100" id="xlarge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel16">Form Bagian</h4>
                        <button type="button" class="close" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                    <section id="multiple-column-form">
                        <div class="row match-height">
                            <div class="col-12">
                                <div class="card">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <form class="form" method="post" name="frm" action="bagian-simpan.php">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="kode_bagian">Kode Bagian</label>
                                                                <input type="text" id="kode_bagian" class="form-control" name="kode_bagian" placeholder="bg0" required>
                                                            </div>    
                                                            <div class="form-group">
                                                                <label for="nama">Nama </label>
                                                                <input type="text" id="nama" class="form-control" placeholder="John Doe" name="nama" required>
                                                            </div>                                                     
                                                            <div class="form-group">
                                                                <label for="gaji_pokok">Gaji Pokok</label>
                                                                <input type="number" id="gaji_pokok" class="form-control" placeholder="Rp" name="gaji_pokok" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="tunjangan_bagian">Tunjangan</label>
                                                                <input type="number" id="tunjangan_bagian" class="form-control" placeholder="Rp" name="tunjangan_bagian" required>
                                                        <div class="col-12 d-flex justify-content-end">
                                                            <button type="submit" name="TblSimpan" class="btn btn-primary me-1 mb-1" value="simpan">Submit</button>
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
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-secondary"
                                data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Close</span>
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tombol Submit -->

<!-- end of tombol submit -->


            <!-- end of modal -->

                <!-- end of tambah data bagian -->
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            Pengelolaan Bagian
                        </div>
                        
                       
                        
                        <!-- Menampilkan data bagian -->
                        <div class="card-body">
                            
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>Kode Bagian</th>
                                        <th>Nama</th>
                                        <th>Gaji Pokok</th>
                                        <th>Tunjangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                        if(isset($_POST["TblHapus"])){
                            $db=dbConnect();
                            if($db->connect_errno==0){
                                $kode_bagian=$db->escape_string($_POST["hps_kb"]);
                                // Susun query delete
                                $sql="DELETE FROM bagian WHERE kode_bagian='$kode_bagian'";
                                // Eksekusi query delete
                                $res=$db->query($sql);
                                if($res){
                                    if($db->affected_rows>0) // jika ada data terhapus
                                        header("Location: bagian.php?success=3");
                                    else // Jika sql sukses tapi tidak ada data yang dihapus
                                        header("Location: bagian.php?error=3");
                                }
                                else{ // gagal query
                                    echo "Data gagal dihapus. <br>";
                                }
                            }
                            else
                                echo "Gagal koneksi".(DEVELOPMENT?" : ".$db->connect_error:"")."<br>";
                        }
                        ?>                      <!-- Tombol Hapus -->

<!-- end of tombol hapus -->
                        <form action="" method="post">
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
                                        <td><?php echo $row["kode_bagian"] ?><input type="text" name="hps_kb" value="<?php echo $row["kode_bagian"] ?>"></td>
                                        <td><?php echo $row["nama"] ?></td>
                                        <td>Rp <?php echo $row["gaji_pokok"] ?></td>
                                        <td>Rp <?php echo $row["tunjangan_bagian"] ?></td>
                                        <td>
                                        <a href="#" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                                        <input type="submit" name="TblHapus" class="btn btn-danger" onclick="return confirm('yakin ingin dihapus?')" value="hapus">
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                        }
                        ?>
                        </form>               
                                                           
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