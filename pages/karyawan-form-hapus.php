<?php
    include_once("../layout.php");
    include_once("functions.php");
    session_start();
    if(!isset($_SESSION["kode_user"]))
    {
        header("Location: ../index.php?error=4");
    }
    if(isset($_GET["error"]))
        {
        $error = $_GET["error"];
        if($error == "input")
            showError("Kesalahan format masukan");
        else if($error == "proses")
            showError("Terjadi kesalahan, silahkan melakukan proses dengan benar");
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
                            <li class="breadcrumb-item"><a href="karyawan.php">Karyawan</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Hapus</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4>Hapus Data Karyawan</h4>
                </div>
                <div class="card-body">
                <?php 
                    if(isset($_GET["kode_karyawan"]))
                    {
                        $kodkar = $_GET["kode_karyawan"];
                        $data = getDataKaryawan($kodkar);
                    }
                ?>
                    <form action="karyawan-hapus.php" method="post">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Kode Karyawan</label>
                                    <input type="text" class="form-control" name="kode_karyawan" value="<?php echo $data["kode_karyawan"] ?>" autocomplete="off" readonly>
                                </div>
                                <div class="form-group">
                                    <label>NIK</label>
                                    <input type="text" class="form-control" name="nik" value="<?php echo $data["nik"] ?>" autocomplete="off" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" name="nama" value="<?php echo $data["nama"] ?>" autocomplete="off" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Kode Bagian</label>
                                    <input type="text" class="form-control" name="kode_bagian" value="<?php echo $data["kode_bagian"] ?>" autocomplete="off" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <input type="text" class="form-control" name="jk" value="<?php echo $data["jk"] ?>" autocomplete="off" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="tanggal_lahir" value="<?php echo $data["tanggal_lahir"] ?>" autocomplete="off" readonly>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea class="form-control" name="alamat" rows="3" readonly><?php echo $data["alamat"] ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>No. Telp</label>
                                    <input type="text" class="form-control" name="no_telp" value="<?php echo $data["no_telp"] ?>" autocomplete="off" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Status Kawin</label>
                                    <input type="text" class="form-control" name="status_kawin" value="<?php echo $data["status_kawin"] ?>" autocomplete="off" readonly>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Masuk</label>
                                    <input type="date" class="form-control" name="tanggal_masuk" value="<?php echo $data["tanggal_masuk"] ?>" autocomplete="off" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary" name="btnHapus" onclick="return confirm('Apakah anda yakin ingin menghapus data?')"><i class="fas fa-edit"></i>Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
<?php


script_section();
?>
        