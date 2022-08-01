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
                            <li class="breadcrumb-item active" aria-current="page">Edit</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Data Karyawan</h4>
                </div>
                <div class="card-body">
                <?php 
                    if(isset($_GET["kode_karyawan"]))
                    {
                        $kodkar = $_GET["kode_karyawan"];
                        $data = getDataKaryawan($kodkar);
                    }
                ?>
                    <form action="karyawan-update.php" method="post">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Kode Karyawan</label>
                                    <input type="text" class="form-control" name="kode_karyawan" value="<?php echo $data["kode_karyawan"] ?>" autocomplete="off" readonly>
                                </div>
                                <div class="form-group">
                                    <label>NIK</label>
                                    <input type="text" class="form-control" name="nik" placeholder="Masukan NIK karyawan" value="<?php echo $data["nik"] ?>" autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" name="nama" placeholder="Masukan nama karyawan" value="<?php echo $data["nama"] ?>" autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <label>Kode Bagian</label>
                                    <input type="text" class="form-control" name="kode_bagian" value="<?php echo $data["kode_bagian"] ?>" autocomplete="off" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <div class="row">
                                    <?php
                                    if($data["jk"] == "L"){
                                        ?>
                                        <div class="col col-lg-3">
                                            <input class="form-check-input" type="radio" name="jk" value="L" checked>
                                            <label>Laki-laki</label>
                                        </div>
                                        <div class="col">
                                            <input class="form-check-input" type="radio" name="jk" value="P">
                                            <label>Perempuan</label>
                                        </div>
                                        <?php
                                    }
                                    if($data["jk"] == "P"){
                                        ?>
                                        <div class="col col-lg-3">
                                            <input class="form-check-input" type="radio" name="jk" value="L">
                                            <label>Laki-laki</label>
                                        </div>
                                        <div class="col">
                                            <input class="form-check-input" type="radio" name="jk" value="P" checked>
                                            <label>Perempuan</label>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="tanggal_lahir" value="<?php echo $data["tanggal_lahir"] ?>" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea class="form-control" name="alamat" placeholder="Masukan alamat karyawan" rows="3" required><?php echo $data["alamat"] ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>No. Telp</label>
                                    <input type="text" class="form-control" name="no_telp" placeholder="Masukan no. telp karyawan" value="<?php echo $data["no_telp"] ?>" autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                <label>Status Kawin</label>
                                    <div class="row">
                                    <?php
                                    if($data["status_kawin"] == "kawin"){
                                        ?>
                                        <div class="col col-lg-3">
                                            <input class="form-check-input" type="radio" name="status_kawin" value="kawin" checked>
                                            <label>Kawin</label>
                                        </div>
                                        <div class="col">
                                            <input class="form-check-input" type="radio" name="status_kawin" value="belum_kawin">
                                            <label>Belum Kawin</label>
                                        </div>
                                        <?php
                                    }
                                    if($data["status_kawin"] == "belum_kawin"){
                                        ?>
                                        <div class="col col-lg-3">
                                            <input class="form-check-input" type="radio" name="status_kawin" value="kawin">
                                            <label>Kawin</label>
                                        </div>
                                        <div class="col">
                                            <input class="form-check-input" type="radio" name="status_kawin" value="belum_kawin" checked>
                                            <label>Belum Kawin</label>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Masuk</label>
                                    <input type="date" class="form-control" name="tanggal_masuk" value="<?php echo $data["tanggal_masuk"] ?>" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary" name="btnUpdate" onclick="return confirm('Apakah anda yakin ingin mengubah data?')"><i class="fas fa-edit"></i> Update</button>
                        <input type="reset" class="btn btn-secondary">
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
        