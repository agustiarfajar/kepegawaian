<?php
    
    include_once("functions.php");
    include_once("../layout.php");
    session_start();
    if(!isset($_SESSION["kode_user"]))
    {
        header("Location: ../index.php?error=4");
    }
    style_section();
    sidebar();
?>
<div id="main">
    <div class="page-heading">
        <div class="page-title mb-3">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Karyawan</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Karyawan</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-outline-primary mb-3" data-bs-toggle="modal" data-bs-target="#large">Tambah</button>
        <?php
        if(isset($_GET["success"]))
        {
            $success = $_GET["success"];
            if($success == 1)
                showSuccess("Data berhasil disimpan.");
            else if($success == 2)
                showSuccess("Data berhasil diubah.");
            else if($success == 3)
                showSuccess("Data berhasil dihapus.");
        }
        if(isset($_GET["warning"]))
        {
            $warning = $_GET["warning"];
            if($warning == "perubahan")
                showWarning("Tidak ada perubahan.");
        }
        if(isset($_GET["error"]))
        {
            $error = $_GET["error"];
            if($error == "input")
                showError("Kesalahan format masukan");
            else if($error == "proses")
                showError("Terjadi kesalahan, silahkan melakukan proses dengan benar");
        }
        ?>
        <form action="karyawan-simpan.php" method="post">
        <div class="modal fade text-left w-100" id="large" tabindex="-1" aria-labelledby="myModalLabel16" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel16">Tambah Data Karyawan</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <label>Kode Karyawan</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="kode_karyawan" value="<?php echo kodeKaryawan() ?>" readonly>
                                </div>
                                <label>NIK</label>
                                <div class="form-group">
                                    <input type="text" placeholder="Masukan NIK karyawan" name="nik" class="form-control" required>
                                </div>
                                <label>Nama</label>
                                <div class="form-group">
                                    <input type="text" placeholder="Masukan nama karyawan" name="nama" class="form-control" required>
                                </div>
                                <label>Bagian</label>
                                <div class="form-group">
                                    <select name="kode_bagian" class="form-select" required>
                                        <option selected disabled>Pilih Bagian</option>
                                        <?php 
                                            $databagian=getListBagian();
                                            foreach($databagian as $bg){
                                                echo "<option value=\"".$bg["kode_bagian"]."\">".$bg["nama"]."</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <label>Jenis Kelamin</label>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-4">
                                            <input class="form-check-input" type="radio" name="jk" value="L">
                                            <label>Laki-laki</label>
                                        </div>
                                        <div class="col-5">
                                            <input class="form-check-input" type="radio" name="jk" value="P">
                                            <label>Perempuan</label>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col">
                                <label>Tanggal Lahir</label>
                                <div class="form-group">
                                    <input type="date" name="tanggal_lahir" class="form-control" required>
                                </div>
                                <label>Alamat</label>
                                <div class="form-group">
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="alamat" placeholder="Masukan alamat karyawan"></textarea>
                                </div>
                                <label>No. Telp</label>
                                <div class="form-group">
                                    <input type="text" placeholder="Masukan no. telp karyawan" name="no_telp" class="form-control" required>
                                </div>
                                <label>Status Kawin</label>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-4">
                                            <input class="form-check-input" type="radio" name="status_kawin" value="kawin">
                                            <label>Kawin</label>
                                        </div>
                                        <div class="col-5">
                                            <input class="form-check-input" type="radio" name="status_kawin" value="belum_kawin">
                                            <label>Belum Kawin</label>
                                        </div>
                                    </div>
                                </div>
                                <label>Tanggal Masuk</label>
                                <div class="form-group">
                                    <input type="date" name="tanggal_masuk" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="btnSimpan" class="btn btn-primary ml-1">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Simpan</span>
                        </button>
                        <input type="reset" class="btn btn-secondary">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Batal</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        </form>
        
        <section class="section">
            <div class="card">
                <div class="card-header">
                    Tabel Data Karyawan
                </div>
                <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th data-sortable="">
                                <a href="#" class="dataTable-sorter"><span style="width:110px;display:inline-block">Kode Karyawan</span></a>
                            </th>
                            <th data-sortable="">
                                <a href="#" class="dataTable-sorter"><span style="width:100px;display:inline-block">NIK</span></a>
                            </th>
                            <th data-sortable="">
                                <a href="#" class="dataTable-sorter"><span style="width:200px;display:inline-block">Nama</span></a>
                            </th>
                            <th data-sortable="">
                                <a href="#" class="dataTable-sorter"><span style="width:80px;display:inline-block">Kode Bagian</span></a>
                            </th>
                            <th data-sortable="">
                                <a href="#" class="dataTable-sorter"><span style="width:50px;display:inline-block">JK</span></a>
                            </th>
                            <th data-sortable="">
                                <a href="#" class="dataTable-sorter"><span style="width:200px;display:inline-block">Alamat</span></a>
                            </th>
                            <th data-sortable="">
                                <a href="#" class="dataTable-sorter">No. Telp</a>
                            </th>
                            <th data-sortable="">
                                <a href="#" class="dataTable-sorter"><span style="width:100px;display:inline-block">Tgl Lahir</span></a>
                            </th>
                            <th data-sortable="">
                                <a href="#" class="dataTable-sorter">Status Kawin</a>
                            </th>
                            <th data-sortable="">
                                <a href="#" class="dataTable-sorter"><span style="width:100px;display:inline-block">Tgl Masuk</span></a>
                            </th>
                            <th data-sortable="">
                                <a href="#" class="dataTable-sorter"><span style="width:100px;display:inline-block">Aksi</span></a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $db = dbConnect();
                    $no = 0;
                    if($db->connect_errno==0)
                    {
                        $sql = "SELECT * FROM karyawan";
                        $res = $db->query($sql);
                        if($res)
                        {
                            $data = $res->fetch_all(MYSQLI_ASSOC);
                            foreach($data as $row)
                            {
                                echo "<tr>
                                    <td>".$row['kode_karyawan']."</td>
                                    <td>".$row['nik']."</td>
                                    <td>".$row['nama']."</td>
                                    <td>".$row['kode_bagian']."</td>
                                    <td>".$row['jk']."</td>
                                    <td>".$row['alamat']."</td>
                                    <td>".$row['no_telp']."</td>
                                    <td>".$row['tanggal_lahir']."</td>
                                    <td>".$row['status_kawin']."</td>
                                    <td>".$row['tanggal_masuk']."</td>
                                    <td>
                                        <a href='karyawan-form-edit.php?kode_karyawan=".$row['kode_karyawan']."' class='btn btn-primary btn-sm'><i class='bi bi-pencil-square'></i></a>&nbsp;
                                        <a href='karyawan-form-hapus.php?kode_karyawan=".$row['kode_karyawan']."' class='btn btn-danger btn-sm'><i class='bi bi-trash-fill'></i></a>
                                    </td>
                                    </tr>";
                            } $res->free();
                        }
                    }
                    ?>
                    </tbody>
                </table>
                </div>
            </div>

        </section>
    </div>

    <footer>
        <div class="footer clearfix mb-0 text-muted">
            <div class="float-start">
                <p>2021 © Mazer</p>
            </div>
            <div class="float-end">
                <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a href="http://ahmadsaugi.com">A. Saugi</a></p>
            </div>
        </div>
    </footer>
</div>
<?php
script_section();
?>
<script>
    // Simple Datatable
    let table1 = document.querySelector('#table1');
    let dataTable = new simpleDatatables.DataTable(table1);
</script>