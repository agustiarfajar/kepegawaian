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
                            <li class="breadcrumb-item"><a href="lembur.php">Lembur</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Data Lembur</h4>
                </div>
                <div class="card-body">

                <?php 
                    if(isset($_GET["kode_lembur"]))
                    {
                        $kode_lembur = $_GET["kode_lembur"];
                        $data = getDataLembur($kode_lembur);
                    }
                ?>

                    <form action="lembur-update.php" method="POST">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Kode Lembur</label>
                                    <input type="text" class="form-control" name="kode_lembur" value="<?php echo $data["kode_lembur"] ?>" autocomplete="off" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Kode Karyawan</label>
                                    <input type="text" class="form-control" name="kode_karyawan" value="<?php echo $data["kode_karyawan"] ?>" autocomplete="off" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="date" class="form-control" name="tanggal" value="<?php echo $data["tanggal"] ?>" autocomplete="off" required>
                                </div>

                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <input type="text" class="form-control" name="keterangan" value="<?php echo $data["keterangan"] ?>" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label>Kode User</label>
                                    <input type="text" class="form-control" name="kode_user" value="<?php echo $data["kode_user"] ?>" autocomplete="off">
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
        