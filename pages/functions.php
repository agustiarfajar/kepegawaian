<?php 
define("DEVELOPMENT", TRUE);
function dbConnect()
{
    $db = new mysqli("localhost","root","","kel3-if6_if-6_kepegawaian");
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


// BLOCK OF DASHBOARD
function countBagian()
{
	$db = dbConnect();
	if($db->connect_errno == 0)
    {
        $res = $db->query("CREATE PROCEDURE countBagian() BEGIN
                            SELECT COUNT(*) as jml_bagian FROM bagian;
                            END");
        $res = $db->query("CALL countBagian()");
        if($res)
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

function countLembur()
{
	$db = dbConnect();
	if($db->connect_errno == 0)
    {
        $res = $db->query("CREATE PROCEDURE countLembur() BEGIN 
                            SELECT COUNT(*) as jml_lembur FROM lembur;
                            END");
        $res = $db->query("CALL countLembur()");
        if($res)
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
function countKaryawan()
{
	$db = dbConnect();
	if($db->connect_errno == 0)
    {
        $res = $db->query("CREATE PROCEDURE countKaryawan() BEGIN
                            SELECT COUNT(*) as jml_karyawan FROM karyawan;
                            END");
        $res = $db->query("CALL countKaryawan()");
        if($res)
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
function countUser()
{
	$db = dbConnect();
	if($db->connect_errno == 0)
    {
        $res = $db->query("CREATE PROCEDURE countUser() BEGIN
                            SELECT COUNT(*) as jml_user FROM user;
                            END");
        $res = $db->query("CALL countUser()");
        if($res)
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

function countKaryawanL()
{
	$db = dbConnect();
	if($db->connect_errno == 0)
    {
        $res = $db->query("CREATE PROCEDURE countL() BEGIN SELECT COUNT(jk) as jk_l FROM karyawan WHERE jk='L'; END");
        $res = $db->query("CALL countL()");
        if($res)
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
function countKaryawanP()
{
	$db = dbConnect();
	if($db->connect_errno == 0)
    {
        $res = $db->query("CREATE PROCEDURE countP() BEGIN SELECT COUNT(jk) as jk_p FROM karyawan WHERE jk='P'; END");
        $res = $db->query("CALL countP()");
        if($res)
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
function countKaryawanMasuk($bulan, $tahun)
{
    $db = dbConnect();
    $sql = "SELECT COUNT(*) as masuk FROM karyawan WHERE YEAR(tanggal_masuk)='$tahun' AND MONTH(tanggal_masuk)='$bulan'";
    $res = $db->query($sql);
    if($res)
    {
        $data = $res->fetch_assoc();
        return $data;
        $res->free();
    }
}


// END OF DASHBOARD
// BLOCK OF BAGIAN
function kodeBagian()
{
    $db = dbConnect();
    if($db->connect_errno==0)
    {
        // $sql = "SELECT MAX(kode_bagian) as kodeTerbesar FROM bagian";
        // $res = $db->query($sql);
        $res = $db->query("CREATE PROCEDURE kodeBagian() BEGIN SELECT MAX(kode_bagian) as kodeTerbesar FROM bagian; END");
        $res = $db->query("CALL kodeBagian()");
        if($res)
        {
            if($res->num_rows>0)
            {
                $data = $res->fetch_assoc();
                $kode_bagian = $data["kodeTerbesar"];
                $urutan = (int) substr($kode_bagian, 1, 4);
                $urutan++;
                
                $huruf = "B";
                $kode_bagian = $huruf.sprintf("%04s", $urutan);
            }
            else 
                $kode_bagian = "B0001";

        }
        return $kode_bagian;
    }
    else
        return FALSE;
}
// END OF BAGIAN
// BLOCK USER
function kodeUserOtomatis()
{
    $db = dbConnect();
    if($db->connect_errno==0)
    {
        $res = $db->query("CREATE PROCEDURE kodeUserOtomatis() BEGIN
                            SELECT MAX(kode_user) as kodeTerbesar FROM penggajian;
                            END");
        $res = $db->query("CALL kodeUserOtomatis()");
        if($res)
        {
            if($res->num_rows>0)
            {
                $data = $res->fetch_assoc();
                $kode_user = $data["kodeTerbesar"];
                $urutan = (int) substr($kode_user, 2, 3);
                $urutan++;
                
                $huruf = "US";
                $kode_user = $huruf.sprintf("%03s", $urutan);
            }
            else 
                $kode_user = "US001";

        }
        return $kode_user;
    }
    else
        return FALSE;
}

function getDataUser($id)
{
    $db = dbConnect();
    if($db->connect_errno==0)
    {
        $sql = "SELECT * FROM user WHERE kode_user='$id'";
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
            echo "Error ".(DEVELOPMENT?":".$db->error:"");
    }
    else
        header("Location: pengguna.php?error=koneksi");
}
// END OF BLOCK USER
// BLOCK PENGGAJIAN
function noSlipOtomatis()
{
    $db = dbConnect();
    if($db->connect_errno==0)
    {
        $res = $db->query("CREATE PROCEDURE noSlipOtomatis() BEGIN
                            SELECT MAX(no_slip) as kodeTerbesar FROM penggajian;
                            END");
        $res = $db->query("CALL noSlipOtomatis()");
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
        $res=$db->query("CREATE PROCEDURE getListBagian()
                        BEGIN
                            SELECT * FROM bagian ORDER BY kode_bagian;
                        END");
        $res=$db->query("CALL getListBagian()");
        // $res=$db->query("SELECT * FROM bagian ORDER BY kode_bagian");
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
        $res=$db->query("CREATE PROCEDURE kodeKaryawan()
                        BEGIN
                        SELECT MAX(kode_karyawan) as kodeTerbesar FROM karyawan;
                        END");
        $res=$db->query("CALL kodeKaryawan()");
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
    $result=$db->query("CREATE PROCEDURE getFKDataLembur()
                        BEGIN
                            SELECT l.kode_lembur, k.kode_karyawan, l.tanggal, l.keterangan, u.kode_user
                            FROM lembur l JOIN karyawan k ON l.kode_karyawan = k.kode_karyawan
                            JOIN user u ON l.kode_user = u.kode_user;
                        END");
    $result=$db->query("CALL getFKDataLembur()");
    // $sql = "SELECT l.kode_lembur, k.kode_karyawan, 
    //                 l.tanggal, l.keterangan,
    //                 u.kode_user
    //         FROM lembur l 
	// 		JOIN karyawan k ON l.kode_karyawan = k.kode_karyawan
	// 		JOIN user u ON l.kode_user = u.kode_user";  

    // $result = $db->query($sql);
    $row = $result->fetch_All();

    $db->close();
    return $row;
}

function getListKaryawan(){
	$db=dbConnect();
	if($db->connect_errno==0){
		$res=$db->query("CREATE PROCEDURE getListKaryawan()
                        BEGIN
                        SELECT * FROM karyawan ORDER BY kode_karyawan;
                        END");
        $res=$db->query("CALL getListKaryawan()");
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
// END OF KARYAWAN BLOCK
function getListUser(){
	$db=dbConnect();
	if($db->connect_errno==0){
		$res=$db->query("CREATE PROCEDURE getListUser()
                        BEGIN
                        SELECT * FROM user ORDER BY kode_user;
                        END");
        $res=$db->query("CALL getListUser()");
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

function getDataLembur($kode_lembur)
{
    $db = dbConnect();
    if($db->connect_errno==0)
    {
        $sql = "SELECT * FROM lembur WHERE kode_lembur = '$kode_lembur'";
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

function kodeLembur()
{
    $db = dbConnect();
	if($db->connect_errno == 0)
    {
        $res=$db->query("CREATE PROCEDURE kodeLembur()
                        BEGIN
                        SELECT MAX(kode_lembur) as kodeTerbesar FROM lembur;
                        END");
        $res=$db->query("CALL kodeLembur()");
        if($res)
        {
            if($res->num_rows>0)
            {
                $data = $res->fetch_assoc();
                $kode = $data['kodeTerbesar'];
                $urutan = (int) substr($kode, 1, 4);
                $urutan++;

                $huruf = "L";
                $kode = $huruf.sprintf("%04s", $urutan);
               
            } else 
            {
                $kode = "L0001";
            }
        }
        return $kode;
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

// END OF LEMBUR BLOCK

?>