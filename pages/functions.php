<?php 
define("DEVELOPMENT", TRUE);
function dbConnect()
{
    $db = new mysqli("localhost","root","","basdat2_kepegawaian");
    return $db;
}

function tgl_indo($tanggal){
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);
	
	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun
 
	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
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
        <i class="bi bi-check-circle"></i>
        <?php echo $msg ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"
            aria-label="Close"></button>
    </div>
    <?php
}

function showWarning($msg)
{
    ?>
    <div class="alert alert-light-warning color-success alert-dismissible show fade">
        <i class="bi bi-exclamation-circle"></i>
        <?php echo $msg ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"
            aria-label="Close"></button>
    </div>
    <?php
}

// BLOCK PENGGAJIAN
function noSlipOtomatis()
{
    $db = dbConnect();
    if($db->connect_errno==0)
    {
        $sql = "SELECT MAX(no_slip) as kodeTerbesar FROM penggajian";
        $res = $db->query($sql);
        if($res)
        {
            if($res->num_rows>0)
            {
                $data = $res->fetch_assoc();
                $no_slip = $data["kodeTerbesar"];
                $urutan = (int) substr($no_slip, 4, 4);
                $urutan++;
                
                $huruf = "INV/";
                $no_slip = $huruf.sprintf("%04s", $urutan);
            }
            else 
                $no_slip = "INV/0001";

        }
        return $no_slip;
    }
    else
        return FALSE;
}

function getDataGaji($id)
{
    $db = dbConnect();
    if($db->connect_errno==0)
    {
        $sql = "SELECT * FROM penggajian WHERE no_slip='$id'";
        $res = $db->query($sql);
        if($res)
        {
            if($res->num_rows==1)
            {
                $data = $res->fetch_assoc();
                return $data;
            }
            else
                return FALSE;
            $res->free();
        }
        else 
            return FALSE;
    }
        return FALSE;
}
// END OF PENGGAJIAN BLOCK

// BLOCK OF KARYAWAN
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
// END OF KARYAWAN BLOCK

// BLOCK OF LEMBUR
function getFKDataLembur(){
    $db = dbConnect();
    $sql = "SELECT l.kode_lembur, k.kode_karyawan, 
                    l.tanggal, l.keterangan,
                    u.kode_user
            FROM lembur l 
			JOIN karyawan k ON l.kode_karyawan = k.kode_karyawan
			JOIN user u ON l.kode_user = u.kode_user";  

    $result = $db->query($sql);
    $row = $result->fetch_All();

    $db->close();
    return $row;
}

function getListKaryawan(){
	$db=dbConnect();
	if($db->connect_errno==0){
		$res=$db->query("SELECT * 
						 FROM karyawan
						 ORDER BY kode_karyawan");
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

function getList($table, $id){
	$db=dbConnect();
	if($db->connect_errno==0){
		$res=$db->query("SELECT * 
						 FROM $table
						 ORDER BY $id");
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

function getListWhereId($table, $id, $field, $idField){
	$db=dbConnect();
	if($db->connect_errno==0){
		$res=$db->query("SELECT $field 
						 FROM $table
						 WHERE $idField= $id");
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

// function get data tapi yang di fetch_assoc
function getDataAssoc($table, $id, $field){
    $db = dbConnect();
    $sql = "SELECT * FROM $table WHERE $field =$id";
    $result = $db->query($sql);
    $row = $result->fetch_All(MYSQLI_ASSOC);

    $db->close();
    return $row;
}
?>