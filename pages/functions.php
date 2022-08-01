<?php 
define("DEVELOPMENT", TRUE);
function dbConnect()
{
    $db = new mysqli("localhost","root","","basdat2_kepegawaian");
    return $db;
}

function showError($msg)
{
    ?>
    <div class="alert alert-light-danger color-danger alert-dismissible show fade">
        <i class="bi bi-exclamation-circle"></i>
        <?php echo $msg ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"
            aria-label="Close"></button>
    </div>
    <?php
}

function showSuccess($msg)
{
    ?>
    <div class="alert alert-light-success color-success alert-dismissible show fade">
        <i class="bi bi-check-circle"></i>&ensp;
        <?php echo $msg ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"
            aria-label="Close"></button>
    </div>
    <?php
}

function showWarning($msg)
{
    ?>
    <div class="alert alert-light-warning color-warning alert-dismissible show fade">
        <i class="bi bi-exclamation-circle"></i>&ensp;
        <?php echo $msg ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"
            aria-label="Close"></button>
    </div>
    <?php
}

function getListBagian() {
    $db=dbConnect();
    if($db->connect_errno==0){
        $res=$db->query("SELECT * FROM bagian ORDER BY kode_bagian");
        if($res){
            $data=$res->fetch_all(MYSQLI_ASSOC);
            $res->free();
            return $data;
        }
        else
            return FALSE; 
    }
    else
        return FALSE;
}

function kodeKaryawan()
{
    $db = dbConnect();
	if($db->connect_errno == 0)
    {
        $sql = "SELECT MAX(kode_karyawan) as kodeTerbesar FROM karyawan";
        $res = $db->query($sql);
        if($res)
        {
            if($res->num_rows>0)
            {
                $data = $res->fetch_assoc();
                $kode = $data['kodeTerbesar'];
                $urutan = (int) substr($kode, 1, 4);
                $urutan++;

                $huruf = "K";
                $kode = $huruf.sprintf("%04s", $urutan);
               
            } else 
            {
                $kode = "K0001";
            }
        }
        return $kode;
    }
    else
        return FALSE;   
}

function getDataKaryawan($kodkar)
{
    $db = dbConnect();
    if($db->connect_errno==0)
    {
        $sql = "SELECT * FROM karyawan WHERE kode_karyawan = '$kodkar'";
        $res = $db->query($sql);
        if($res)
        {
            if($res->num_rows>0)
            {
                $data = $res->fetch_assoc();
                $res->free();
                return $data;
            }
            else
                return FALSE;
        }
        else
            return FALSE;
    }
    else
        return FALSE;
}
?>