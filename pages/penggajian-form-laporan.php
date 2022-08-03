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
                    <h3>Form Laporan Gaji Karyawan</h3>
                    <p class="text-subtitle text-muted">Form pencetakan laporan gaji</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Laporan</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>     
        <!-- end of modal -->
        <section class="section">
            <div class="card">          
                <div class="card-header">
                    <h4 class="card-title">Cetak Laporan Gaji</h4>
                </div>
                <div class="card-body">
                    <form action="penggajian-cetak-laporan.php" method="get" target="_blank">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="bulan">Bulan</label>
                                    <select name="bulan" id="bulan" class="form-select">
                                        <option value="">Pilih Bulan</option>
                                        <?php 
                                            $json = file_get_contents("kalender.json"); 
                                            $response = json_decode($json,true);
                            
                                            $bulan = $response["bulan"];
                                            foreach($bulan as $row)
                                            {                                            
                                             ?>
                                                <option value="<?php echo $row["kode_bulan"] ?>"><?php echo $row["nama"] ?></option> 
                                             <?php
                                             }
                                        ?>
                                    
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tahun">Tahun</label>
                                    <select name="tahun" id="tahun" class="form-select">
                                        <option value="">Pilih Tahun</option>
                                        <?php 
                                            $json = file_get_contents("kalender.json"); 
                                            $response = json_decode($json,true);
                            
                                            $tahun = $response["tahun"];
                                            foreach($tahun as $row)
                                            {                                            
                                             ?>
                                                <option value="<?php echo $row["data"] ?>"><?php echo $row["data"] ?></option> 
                                             <?php
                                             }
                                        ?>
                                    
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary" style="float:left"><i class="bi bi-printer"></i> Cetak</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>

<?php script_section() ?>
<script>
    // Date only Year
    $(function() {
        $('#datepicker1').datepicker( {
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            dateFormat: 'MM yy',
            onClose: function(dateText, inst) { 
                var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                $(this).datepicker('setDate', new Date(year, month, 1));
            }
        });
    });
</script>