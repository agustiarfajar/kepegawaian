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
                    <h3>Form Edit Penggajian Karyawan</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="penggajian.php">Penggajian</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
                    $kode_user = $_GET["kode_user"];
                    $datauser = getDataUser($kode_user);
                    ?>
                    <form action="pengguna-update.php" method="post">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="kode_user">Kode User</label>
                                    <div class="position-relative">
                                        <input type="text" name="kode_user" maxlength="8" value="<?php echo $datauser["kode_user"] ?>" class="form-control" placeholder="Masukan Kode User" id="kode_user" readonly>
                                        <div class="form-control-icon">
                                            <i class="bi bi-key"></i>
                                        </div>
                                    </div>
                                </div>  

                                <div class="form-group has-icon-left">
                                    <label for="nama">Nama</label>
                                    <div class="position-relative">
                                        <input type="text" name="nama" maxlength="50" value="<?php echo $datauser["nama"] ?>" class="form-control" placeholder="Masukan Nama" id="nama" autocomplete="off">
                                        <div class="form-control-icon">
                                            <i class="bi bi-person"></i>
                                        </div>
                                    </div>
                                </div>                                                     
                            
                                <div class="form-group has-icon-left">
                                    <label for="no_telp">Nomor Telepon</label>
                                    <div class="position-relative">
                                        <input type="text" name="no_telp" maxlength="13" value="<?php echo $datauser["no_telp"] ?>" class="form-control" placeholder="Masukan No.Telp" id="no_telp" autocomplete="off">
                                        <div class="form-control-icon">
                                            <i class="bi bi-phone"></i>
                                        </div>
                                    </div>
                                </div>
                            
                            
                                <div class="form-group has-icon-left">
                                    <label for="username">Username</label>
                                    <div class="position-relative">
                                        <input type="text" name="username" maxlength="20" value="<?php echo $datauser["username"] ?>" class="form-control" placeholder="Masukan Username" id="username" autocomplete="off">
                                        <div class="form-control-icon">
                                            <i class="bi bi-person"></i>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="form-group">
                                    <label for="basicSelect">Level</label>
                                    <select class="form-select" id="basicSelect" name="level">
                                        <?php 
                                            if($datauser["level"] == 1) 
                                            {
                                                ?>
                                                    <option value="">Pilih Level</option>
                                                    <option value="1" selected>Direktur</option>
                                                    <option value="2">Administrator</option>
                                                <?php
                                            } 
                                            else if($datauser["level"] == 2)
                                            {
                                                ?>
                                                    <option value="">Pilih Level</option>
                                                    <option value="1">Direktur</option>
                                                    <option value="2" selected>Administrator</option>
                                                <?php
                                            } 
                                            else 
                                            {
                                                ?>
                                                    <option value="">Pilih Level</option>
                                                    <option value="1">Direktur</option>
                                                    <option value="2">Administrator</option>
                                                <?php 
                                            }
                                        ?>
                                    </select>
                                </div>
                            
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="button" onclick="konfirmasiUbah()" name="btnUpdate" class="btn btn-primary me-1 mb-1">Ubah</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                </div>                                                         
                            </div>        
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
    function konfirmasiUbah()
    {
        event.preventDefault();
        var form = event.target.form;
        Swal.fire({
            icon: "question",
            title: "Konfirmasi",
            text: "Apakah anda yakin ingin mengubah data?",
            showCancelButton: true,
            confirmButtonText: "Ubah",
            cancelButtonText: "Batal"
        }).then((result) => {
            if(result.value) {
                form.submit();
            } else {
                Swal.fire("Informasi","Data batal diubah.","error");
            }
        });
    }
</script>
