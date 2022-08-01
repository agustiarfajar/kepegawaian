<?php 
include_once("../layout.php");
///session_start();

if(!isset($_SESSION["kode_user"]))
{
    header("Location: ../index.php?error=akses");
} else
?>
<?php
include_once 'functions.php';

$db = dbConnect();    

$tabel = 'lembur';

$hasil = getFKDataLembur();
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
                <h3>Lembur</h3>
            </div>
            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Data Lembur</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">DataTable</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            
                <button type="button" class="btn btn-outline-primary block" data-bs-toggle="modal" data-bs-target="#xlarge">
            Tambah
        </button>
            <!--Extra Large Modal -->
            <div class="modal fade text-left w-100" id="xlarge" tabindex="-1"
                                                role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel16">Extra Large
                                                                Modal</h4>
                                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                                        <!-- // Basic multiple Column Form section start -->
                <section id="multiple-column-form">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Tambah Data Lembur</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form method="POST" name="frm" action="lembur.php" class="form-group">
                                            <div class="row">
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="kode_lembur">Kode Lembur</label>
                                                        <input type="text" id="kode_lembur" class="form-control"
                                                            placeholder="Kode Lembur" name="kode_lembur">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label>Kode Karyawan</label>
        
                                                        <select name="kode_karyawan" class="form-control" >
                                                            <?php
                                                               $datakode_karyawan=getList("karyawan", "kode_karyawan");
                                                                foreach($datakode_karyawan as $data){
                                                                echo "<option value=\"".$data["kode_karyawan"]."\">".$data["kode_karyawan"]."</option>";
                                                                 }
                                                             ?>
                                                    </select>
                            
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="tanggal">Tanggal</label>
                                                        <input type="date" id="tanggal" class="form-control"
                                                            placeholder="Tanggal" name="tanggal">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="keterangan">Keterangan</label>
                                                        <input type="text" id="keterangan" class="form-control"
                                                            name="keterangan" placeholder="Keterangan">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="kode_user">Kode User</label>
                                                        <input type="text" id="kode_user" class="form-control"
                                                            name="kode_user" placeholder="Kode_User">
                                                    </div>
                                                </div>
                                                <div class="form-group col-12">
                                                    <div class='form-check'>
                                                        <div class="checkbox">
                                                            <input type="checkbox" id="checkbox5"
                                                                class='form-check-input' checked>
                                                            <label for="checkbox5">Remember Me</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit"
                                                        class="btn btn-primary me-1 mb-1" name="submit">Submit</button>
                                                    <button type="reset"
                                                        class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                                </div>
                                            </div>
                                        </form>
                                        <?php
            $conn = dbConnect();
            // check if button submit is clicked and check if kode_pinjam duplicate
            if(isset($_POST["submit"])){
                $kode_lembur = $_POST["kode_lembur"];
                $kode_karyawan = $_POST["kode_karyawan"];
                $tanggal = $_POST["tanggal"];
                $keterangan = $_POST["keterangan"];
                $kode_user = $_POST["kode_user"];
                $sql = "INSERT INTO lembur (kode_lembur, kode_karyawan, tanggal, keterangan, kode_user) VALUES ('$kode_lembur', '$kode_karyawan', '$tanggal', '$keterangan', '$kode_user')";
                $result = mysqli_query($conn, $sql);
                if($result){
                    header("Location: lembur.php?success=1");
                }else{
                    echo "Data gagal ditambahkan";
                }
            }
        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic multiple Column Form section end -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            Simple Datatable
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Lembur</th>
                                        <th>Kode Karyawan</th>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                        <th>Kode User</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($hasil as $key => $value) : ?>
                                <tr>
                                <th scope="row"><?= $key + 1 ?></th>
                                <td><?= $value[0] ?></td>
                                <td><?= $value[1] ?></td>
                                <td><?= $value[2] ?></td>
                                <td><?= $value[3] ?></td>
                                <td><?= $value[4] ?></td>
                                <td>
                                <a href="editDataLembur.php?kode_lembur= <?php echo $value[0] ?> ">Edit Data</a> 
                                <a href="hapusDataLembur.php?kode_lembur= <?php echo $value[0] ?> ">Hapus Data</a>
                    </td>
                </tr>
                <?php endforeach; ?>   
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
</script>