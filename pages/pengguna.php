<?php 
include_once("functions.php");
include_once("../layout.php");
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
                            <li class="breadcrumb-item active" aria-current="page">Pengguna</li>
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
                        showError("Terjadi kesalahan masukan:<br>".$_SESSION["salahinputuser"]);
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
                                                <form action="pengguna-simpan.php" method="post">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group has-icon-left">
                                                                <label for="kode_user">Kode User</label>
                                                                <div class="position-relative">
                                                                    <input type="text" name="kode_user" maxlength="8" value="<?php echo kodeUserOtomatis() ?>" class="form-control" placeholder="Masukan Kode User" id="kode_user" readonly>
                                                                    <div class="form-control-icon">
                                                                        <i class="bi bi-key"></i>
                                                                    </div>
                                                                </div>
                                                            </div>  

                                                            <div class="form-group has-icon-left">
                                                                <label for="nama">Nama</label>
                                                                <div class="position-relative">
                                                                    <input type="text" name="nama" maxlength="50" class="form-control" placeholder="Masukan Nama" id="nama" autocomplete="off">
                                                                    <div class="form-control-icon">
                                                                        <i class="bi bi-person"></i>
                                                                    </div>
                                                                </div>
                                                            </div>                                                     
                                                        
                                                            <div class="form-group has-icon-left">
                                                                <label for="no_telp">Nomor Telepon</label>
                                                                <div class="position-relative">
                                                                    <input type="text" name="no_telp" maxlength="13" class="form-control" placeholder="Masukan No.Telp" id="no_telp" autocomplete="off">
                                                                    <div class="form-control-icon">
                                                                        <i class="bi bi-phone"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        
                                                        
                                                            <div class="form-group has-icon-left">
                                                                <label for="username">Username</label>
                                                                <div class="position-relative">
                                                                    <input type="text" name="username" maxlength="20" class="form-control" placeholder="Masukan Username" id="username" autocomplete="off">
                                                                    <div class="form-control-icon">
                                                                        <i class="bi bi-person"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        
                                                            <div class="form-group has-icon-left">
                                                                <label for="password-id-icon">Password</label>
                                                                <div class="position-relative">
                                                                    <input type="password" name="pass" maxlength="50" class="form-control" placeholder="Password" id="password-id-icon" autocomplete="off">
                                                                    <div class="form-control-icon">
                                                                        <i class="bi bi-lock"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="basicSelect">Level</label>
                                                                <select class="form-select" id="basicSelect" name="level">
                                                                    <option value="">Pilih Level</option>
                                                                    <option value="1">Direktur</option>
                                                                    <option value="2">Administrator</option>
                                                                </select>
                                                            </div>
                                                        
                                                            <div class="col-12 d-flex justify-content-end">
                                                                <button type="button" onclick="konfirmasiSimpan()" name="btnSimpan" class="btn btn-primary me-1 mb-1">Simpan</button>
                                                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                                            </div>                                                         
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
        <!-- end of modal -->
        <section class="section">
            <div class="card">          
    
                <div class="card-header">
                    Tabel Pengguna Sistem
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Kode User</th>
                                <th>Nama</th>
                                <th>No.Telp</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Level</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $db = dbConnect();
                        if($db->connect_errno==0)
                        {
                            $sql = "SELECT * FROM user";
                            $no=1;
                            $res = $db->query($sql);
                            if($res)
                            {
                                $data = $res->fetch_all(MYSQLI_ASSOC);
                                foreach($data as $row)
                                {
                                    ?>
                                    <tr>
                                    <td><?php echo $row["kode_user"] ?></td>
                                    <td><?php echo $row["nama"] ?></td>
                                    <td><?php echo $row["no_telp"] ?></td>
                                    <td><?php echo $row["username"] ?></td>
                                    <td><?php echo substr($row["pass"], 0, 8) ?></td>
                                    <td><?php echo ($row["level"] == 1?"Direktur":($row["level"] == 2?"Administrator":"")) ?></td>
                                    <td>   
                                        <a href="pengguna-form-edit.php?kode_user=<?php echo $row["kode_user"] ?>" class="btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i></a>
                                        <a href="pengguna-form-hapus.php?kode_user=<?php echo $row["kode_user"] ?>" class="btn btn-sm btn-danger hapus"><i class="bi bi-trash"></i></a>
                                    </td>
                                </tr>
                                    <?php
                                    $no = ++$no;
                                }
                                $res->free();
                            }
                        }
                        ?>                                                       
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>

<?php script_section() ?>
<script>
    // Simple Datatable
    let table1 = document.querySelector('#table1');
    let dataTable = new simpleDatatables.DataTable(table1);

    // Sweetalert
    function konfirmasiSimpan()
    {
        event.preventDefault();
        var form = event.target.form;
        Swal.fire({
            icon: "question",
            title: "Konfirmasi",
            text: "Apakah anda yakin ingin menyimpan data?",
            showCancelButton: true,
            confirmButtonText: "Simpan",
            cancelButtonText: "Batal"
        }).then((result) => {
            if(result.value) {
                form.submit();
            } else {
                Swal.fire("Informasi","Data batal disimpan.","error");
            }
        });
    }
</script>