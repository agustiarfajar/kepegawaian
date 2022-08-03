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
        <h3>Dashboard <?php echo ($_SESSION["level"]==2?"Administrator":($_SESSION["level"]==1?"Direktur":"")) ?></h3>
    </div>
    <!-- JUMLAH -->
    <?php 
        $jml_bagian = countBagian();
        $jml_karyawan = countkaryawan();
        $jml_lembur = countLembur();
        $jml_user = countUser();
    ?>
    <div class="page-content">
        <section class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon purple">
                                            <i class="iconly-boldCategory"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Bagian</h6>
                                        <h6 class="font-extrabold mb-0"><?php echo $jml_bagian["jml_bagian"] ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon blue">
                                            <i class="iconly-boldUser"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Karyawan</h6>
                                        <h6 class="font-extrabold mb-0"><?php echo $jml_karyawan["jml_karyawan"] ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon green">
                                            <i class="iconly-boldGraph"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Lembur</h6>
                                        <h6 class="font-extrabold mb-0"><?php echo $jml_lembur["jml_lembur"] ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon red">
                                            <i class="iconly-boldProfile"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Pengguna</h6>
                                        <h6 class="font-extrabold mb-0"><?php echo $jml_user["jml_user"] ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-9">
                        <div class="card">
                            <div class="card-header">
                                <h4 align="center">Jumlah Karyawan Baru Masuk<br><small><?php echo date('Y'); ?></small></h4>
                            </div>
                            <div class="card-body">
                                <div id="chart-profile-visit"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <div class="card-header">
                                <h4>Karyawan</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart-visitors-profile"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
        </section>
    </div>

    <footer>
        <div class="footer clearfix mb-0 text-muted">
            <div class="float-start">
                <p>2021 &copy; Mazer</p>
            </div>
            <div class="float-end">
                <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                        href="http://ahmadsaugi.com">A. Saugi</a></p>
            </div>
        </div>
        <?php
            $tahun = date('Y');
            $jan = countKaryawanMasuk("01", $tahun);
            $feb = countKaryawanMasuk("02", $tahun);
            $mar = countKaryawanMasuk("03", $tahun);
            $apr = countKaryawanMasuk("04", $tahun);
            $mei = countKaryawanMasuk("05", $tahun);
            $jun = countKaryawanMasuk("06", $tahun); 
            $jul = countKaryawanMasuk("07", $tahun);
            $ags = countKaryawanMasuk("08", $tahun);
            $spt = countKaryawanMasuk("09", $tahun);
            $okt = countKaryawanMasuk("10", $tahun);
            $nov = countKaryawanMasuk("11", $tahun);
            $des = countKaryawanMasuk("12", $tahun);

            $data_jan = $jan["masuk"];
            $data_feb = $feb["masuk"];
            $data_mar = $mar["masuk"];
            $data_apr = $apr["masuk"];
            $data_mei = $mei["masuk"];
            $data_jun = $jun["masuk"];
            $data_jul = $jul["masuk"];
            $data_ags = $ags["masuk"];
            $data_spt = $spt["masuk"];
            $data_okt = $okt["masuk"];
            $data_nov = $nov["masuk"];
            $data_des = $des["masuk"];
        ?>
    </footer>
</div>
<?php script_section() ?>
<script>
<?php 
    $L = countKaryawanL();
    $P = countKaryawanP();
?>
    let jk  = {
	series: [<?php echo $L["jk_l"] ?>, <?php echo $P["jk_p"] ?>],
	labels: ['Laki-laki', 'Perempuan'],
	colors: ['#435ebe','#55c6e8'],
	chart: {
		type: 'donut',
		width: '100%',
		height:'350px'
	},
	legend: {
		position: 'bottom'
	},
	plotOptions: {
		pie: {
			donut: {
				size: '30%'
			}
		}
	}
}

// Chart jumlah karyawan masuk

var karyawan = {
	annotations: {
		position: 'back'
	},
	dataLabels: {
		enabled:false
	},
	chart: {
		type: 'bar',
		height: 300
	},
	fill: {
		opacity:1
	},
	plotOptions: {
	},
	series: [{
		name: 'Karyawan Baru',
		data: [<?php echo $data_jan ?>,
               <?php echo $data_feb ?>,
               <?php echo $data_mar ?>,
               <?php echo $data_apr ?>,
               <?php echo $data_mei ?>,
               <?php echo $data_jun ?>,
               <?php echo $data_jul ?>,
               <?php echo $data_ags ?>,
               <?php echo $data_spt ?>,
               <?php echo $data_okt ?>,
               <?php echo $data_nov ?>,
               <?php echo $data_des ?>,]
	}],
	colors: '#435ebe',
	xaxis: {
		categories: ["Jan","Feb","Mar","Apr","Mei","Jun","Jul", "Aug","Sep","Oct","Nov","Dec"],
	},
    yaxis: [
    {
        labels: {
        formatter: function(val) {
            return val.toFixed(0);
        }
        }
    }
    ]
}
var chartJK = new ApexCharts(document.getElementById('chart-visitors-profile'), jk)
var chartKaryawan = new ApexCharts(document.querySelector("#chart-profile-visit"), karyawan);
chartJK.render()
chartKaryawan.render();
</script>