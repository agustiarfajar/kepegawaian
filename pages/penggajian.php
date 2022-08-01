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
                    <h3>Data Penggajian Karyawan</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Penggajian</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-outline-primary block" data-bs-toggle="modal" data-bs-target="#xlarge">
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
                        showError("Terjadi kesalahan masukan:<br>".$_SESSION["salahinputgaji"]);
                }
            ?>
        </p>
        <!--Extra Large Modal -->
        <div class="modal fade text-left w-100" id="xlarge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel16">Form Penggajian</h4>
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
                                                <div class="col-12">
                                                    <div class="alert alert-secondary"><i class="bi bi-exclamation-circle"></i> <b>Informasi <br>Keterangan :<br>Nominal Uang Lembur = Rp.50.000</b></div>
                                                </div>
                                            </div>
                                                <form action="penggajian-simpan.php" method="post">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="no_slip">No.Slip</label>
                                                                <input type="text" id="no_slip" class="form-control" name="no_slip" value="<?php echo noSlipOtomatis() ?>" placeholder="No.Slip" readonly>
                                                            </div>    
                                                            <div class="form-group">
                                                                <label for="periode">Periode Gaji</label>
                                                                <input type="date" id="periode" class="form-control" placeholder="Periode Gaji" name="periode_gaji">
                                                            </div>                                                     
                                                            <div class="form-group">
                                                                <label for="tanggal">Tanggal</label>
                                                                <input type="date" id="tanggal" class="form-control" placeholder="Tanggal" name="tanggal">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="karyawan">Karyawan</label>
                                                                <select name="kode_karyawan" id="karyawan" class="form-control" onchange="changeKaryawan()">
                                                                    <option value="">Pilih Karyawan</option>
                                                                    <?php 
                                                                    $db = dbConnect();
                                                                    if($db->connect_errno==0)
                                                                    {
                                                                        $sql = "SELECT a.*,b.nama as bagian,b.gaji_pokok as gp,b.tunjangan_bagian as tb
                                                                        FROM karyawan AS a 
                                                                        INNER JOIN bagian as b ON a.kode_bagian=b.kode_bagian";
                                                                        $res = $db->query($sql);
                                                                        if($res)
                                                                        {
                                                                            $data = $res->fetch_all(MYSQLI_ASSOC);

                                                                            foreach($data as $row)
                                                                            {
                                                                                ?>
                                                                                <option value="<?php echo $row["kode_karyawan"] ?>" data-gp="<?php echo $row["gp"] ?>" data-tunjangan="<?php echo $row["tb"] ?>" data-lembur="<?php echo $row["jml_lembur"] ?>"><?php echo $row["nama"] ?> - <?php echo $row["bagian"] ?></option>
                                                                                <?php
                                                                            }
                                                                            $res->free();
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>                                                            
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="gaji_pokok">Gaji Pokok</label>
                                                                <input type="text" id="gaji_pokok" class="form-control" name="gaji_pokok" placeholder="0" readonly>
                                                            </div> 
                                                            <div class="form-group">
                                                                <label for="tunjangan_bagian">Tunjangan Bagian</label>
                                                                <input type="text" id="tunjangan_bagian" class="form-control" name="tunjangan_bagian" placeholder="0" readonly>
                                                            </div> 
                                                            <div class="form-group">
                                                                <label for="total_lembur">Total Lembur</label>
                                                                <input type="text" id="total_lembur" class="form-control" name="total_lembur" placeholder="0" readonly>
                                                            </div> 
                                                            <div class="form-group">
                                                                <label for="total_gaji">Total Gaji</label>
                                                                <input type="text" id="total_gaji" class="form-control" name="total_gaji" placeholder="0" readonly>
                                                            </div> 
                                                        </div>
                                                        
                                                    </div>
                                                    <div style="float:right">
                                                        <button type="button" onclick="konfirmasiSimpan()" name="btnSimpan" class="btn btn-primary me-1 mb-1">Simpan</button>
                                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button> 
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
                    Tabel Gaji Karyawan
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No.Slip</th>
                                <th>Periode</th>
                                <th>Tanggal</th>
                                <th>NIK</th>
                                <th>Karyawan</th>
                                <th>Gaji Bersih<small>(Rp)</small></th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $db = dbConnect();
                        if($db->connect_errno==0)
                        {
                            $sql = "SELECT a.*,b.nik,b.nama as karyawan 
                                    FROM penggajian as a
                                    INNER JOIN karyawan as b ON a.kode_karyawan=b.kode_karyawan";
                            $res = $db->query($sql);
                            if($res)
                            {
                                $data = $res->fetch_all(MYSQLI_ASSOC);
                                foreach($data as $row)
                                {
                                    ?>
                                    <tr>
                                    <td><?php echo $row["no_slip"] ?></td>
                                    <td><?php echo date('m-Y', strtotime($row["periode_gaji"])) ?></td>
                                    <td><?php echo $row["tanggal"] ?></td>
                                    <td><?php echo $row["nik"] ?></td>
                                    <td><?php echo $row["karyawan"] ?></td>
                                    <td><?php echo number_format($row["total_gaji"],0,',','.') ?></td>
                                    <td>
                                        <a href="penggajian-cetak-slip.php?no_slip=<?php echo $row["no_slip"] ?>" target="_blank" class="btn btn-sm btn-info"><i class="bi bi-receipt"></i></a>
                                        <a href="penggajian-form-edit.php?no_slip=<?php echo $row["no_slip"] ?>" class="btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i></a>
                                        <a href="#" onclick="konfirmasiHapus()" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a>
                                        <input type="hidden" id="hapus_no_slip" value="<?php echo $row["no_slip"] ?>">
                                    </td>
                                </tr>
                                    <?php
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
    var uang_lembur = 0;
    var gaji_pokok = 0;
    var tunjangan = 0;
    var total_lembur = 0;
    var total_gaji = 0;
    // Simple Datatable
    let table1 = document.querySelector('#table1');
    let dataTable = new simpleDatatables.DataTable(table1);

    function changeKaryawan()
    {
        gaji_pokok = $('#karyawan').find(':selected').attr("data-gp");
        tunjangan = $('#karyawan').find(':selected').attr("data-tunjangan");
        $('#gaji_pokok').val(gaji_pokok);
        $('#tunjangan_bagian').val(tunjangan);

        var xhr=new XMLHttpRequest();
        xhr.onreadystatechange = function()
        {
            if(this.readyState == 4 && this.status == 200)
            {
                response = xhr.responseText;
                data = JSON.parse(response);
                $('#total_lembur').val(data.jml_lembur);
                total_lembur = $('#total_lembur').val();

                uang_lembur = 50000*total_lembur;
                total_gaji = parseFloat(gaji_pokok) + parseFloat(tunjangan) + parseFloat(uang_lembur);
                if(kk == "")
                {
                    $('#total_gaji').val(0);
                } else {
                    $('#total_gaji').val(total_gaji);
                }
            }
        }
        var kk = $('#karyawan').val();
        xhr.open("GET", "getTotalLembur.php?kode_karyawan="+kk,true);
        xhr.send();        
    }

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

    // Sweetalert
    function konfirmasiHapus()
    {
        var no_slip = $('#hapus_no_slip').val();

        event.preventDefault();
        var form = event.target.form;
        Swal.fire({
            icon: "question",
            title: "Konfirmasi",
            text: "Apakah anda yakin ingin menghapus data dengan Nomor Slip "+no_slip+"?",
            showCancelButton: true,
            confirmButtonColor: "red",
            confirmButtonText: "Hapus",
            cancelButtonText: "Batal"
        }).then((result) => {
            if(result.value) {              
                window.location.href = "penggajian-hapus.php?no_slip="+no_slip+"";
            } else {
                Swal.fire("Informasi","Data batal dihapus.","error");
            }
        });
    }
</script>