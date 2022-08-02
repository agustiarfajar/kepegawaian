<?php 
include_once("functions.php");
include_once("../layout.php");
session_start();
if(!isset($_SESSION["kode_user"]))
{
    header("Location: ../index.php?error=4");
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
                    <h3>Form Hapus Penggajian Karyawan</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="penggajian.php">Penggajian</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Hapus</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <section class="section">
            <div class="card">          
    
                <div class="card-header">
                    Penggajian Karyawan
                </div>
                <div class="card-body">
                    <?php  
                    $db = dbConnect();
                    $no_slip = $_GET["no_slip"];
                    $datagaji = getDataGaji($no_slip);
                    ?>
                    <form action="penggajian-hapus.php" method="post">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="no_slip">No.Slip</label>
                                    <input type="text" id="no_slip" class="form-control" name="no_slip" value="<?php echo $datagaji["no_slip"] ?>" placeholder="No.Slip" readonly>
                                </div>    
                                <div class="form-group">
                                    <label for="periode">Periode Gaji</label>
                                    <input type="date" id="periode" class="form-control" placeholder="Periode Gaji" name="periode_gaji" value="<?php echo ($datagaji["periode_gaji"]) ?>" readonly>
                                </div>                                                     
                                <div class="form-group">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="date" id="tanggal" class="form-control" placeholder="Tanggal" name="tanggal" value="<?php echo $datagaji["tanggal"] ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="karyawan">Karyawan</label>
                                    <select name="kode_karyawan" id="karyawan" class="form-control" onchange="changeKaryawan()" disabled>
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
                                                    <option value="<?php echo $row["kode_karyawan"] ?>" <?php echo ($row["kode_karyawan"] == $datagaji["kode_karyawan"]?"selected":"") ?> data-gp="<?php echo $row["gp"] ?>" data-tunjangan="<?php echo $row["tb"] ?>" data-lembur="<?php echo $row["jml_lembur"] ?>"><?php echo $row["nama"] ?> - <?php echo $row["bagian"] ?></option>
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
                                    <input type="text" id="gaji_pokok" class="form-control" name="gaji_pokok" value="<?php echo $datagaji["gaji_pokok"] ?>" placeholder="0" readonly>
                                </div> 
                                <div class="form-group">
                                    <label for="tunjangan_bagian">Tunjangan Bagian</label>
                                    <input type="text" id="tunjangan_bagian" class="form-control" name="tunjangan_bagian" value="<?php echo $datagaji["tunjangan_bagian"] ?>" placeholder="0" readonly>
                                </div> 
                                <div class="form-group">
                                    <label for="total_lembur">Total Lembur</label>
                                    <input type="text" id="total_lembur" class="form-control" name="total_lembur" value="<?php echo $datagaji["total_lembur"] ?>" placeholder="0" readonly>
                                </div> 
                                <div class="form-group">
                                    <label for="total_gaji">Total Gaji</label>
                                    <input type="text" id="total_gaji" class="form-control" name="total_gaji" value="<?php echo $datagaji["total_gaji"] ?>" placeholder="0" readonly>
                                </div> 
                            </div>
                            
                        </div>
                        <div style="float:right">
                            <button type="button" onclick="konfirmasiHapus()" name="btnHapus" class="btn btn-danger me-1 mb-1">Hapus</button>
                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button> 
                        </div>             
                    </form>
                </div>
            </div>
        </section>
</div>
<?php script_section() ?>
<script>
    var uang_lembur = 0;
    var gaji_pokok = 0;
    var tunjangan = 0;
    var total_lembur = 0;
    var total_gaji = 0;

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
    function konfirmasiHapus()
    {
        event.preventDefault();
        var form = event.target.form;
        Swal.fire({
            icon: "question",
            title: "Konfirmasi",
            text: "Apakah anda yakin ingin menghapus data?",
            showCancelButton: true,
            confirmButtonText: "Hapus",
            cancelButtonText: "Batal"
        }).then((result) => {
            if(result.value) {
                form.submit();
            } else {
                Swal.fire("Informasi","Data batal dihapus.","error");
            }
        });
    }
</script>
