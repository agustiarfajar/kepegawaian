<?php
session_id("basdat2");
session_start();
include_once("functions.php");
$db = dbConnect();
if($db->connect_errno==0)
{
    // var_dump($_POST);
    // exit;
    $pesansalah = "";
    $v_no_slip = trim($_POST["no_slip"]);
    $v_periode_gaji = trim($_POST["periode_gaji"]);
    $v_tanggal = trim($_POST["tanggal"]);
    $v_karyawan = trim($_POST["kode_karyawan"]);
    $v_gaji_pokok = trim($_POST["gaji_pokok"]);
    $v_tunjangan = trim($_POST["tunjangan_bagian"]);
    $v_total_lembur = trim($_POST["total_lembur"]);
    $v_total_gaji = trim($_POST["total_gaji"]);
    
    if(strlen($v_no_slip) == "")
    {
        $pesansalah .= "Nomor Slip tidak boleh kosong<br>";
    }
    if(strlen($v_periode_gaji) == "")
    {
        $pesansalah .= "Periode Gaji tidak boleh kosong<br>";
    }
    if(strlen($v_tanggal) == "")
    {
        $pesansalah .= "Tanggal tidak boleh kosong<br>";
    }
    if(strlen($v_karyawan) == "")
    {
        $pesansalah .= "Karyawan tidak boleh kosong<br>";
    }
    if(strlen($v_gaji_pokok) == "")
    {
        $pesansalah .= "Gaji Pokok tidak boleh kosong<br>";
    }
    if(strlen($v_tunjangan) == "")
    {
        $pesansalah .= "Tunjangan tidak boleh kosong<br>";
    }
    if(strlen($v_total_lembur) == "")
    {
        $pesansalah .= "Total Lembur tidak boleh kosong<br>";
    }
    if(strlen($v_total_gaji) == "")
    {
        $pesansalah .= "Total Bonus tidak boleh kosong<br>";
    }

    if($pesansalah == "")
    {
        $no_slip = $db->escape_string($_POST["no_slip"]);
        $periode_gaji = $db->escape_string($_POST["periode_gaji"]);
        $tanggal = $db->escape_string($_POST["tanggal"]);
        $kode_karyawan = $db->escape_string($_POST["kode_karyawan"]);
        $gaji_pokok = $db->escape_string($_POST["gaji_pokok"]);
        $tunjangan_bagian = $db->escape_string($_POST["tunjangan_bagian"]);
        $total_lembur = $db->escape_string($_POST["total_lembur"]);
        $total_gaji = $db->escape_string($_POST["total_gaji"]);
        $kode_user = $_SESSION["kode_user"];

        $sql = "UPDATE penggajian SET
                periode_gaji='$periode_gaji',
                tanggal='$tanggal',
                kode_karyawan='$kode_karyawan',
                gaji_pokok='$gaji_pokok',
                tunjangan_bagian='$tunjangan_bagian',
                total_lembur='$total_lembur',
                total_gaji='$total_gaji',
                kode_user='$kode_user'
                WHERE no_slip='$no_slip'";
        $res = $db->query($sql);
        if($res)
        {
            if($db->affected_rows>0)
            {
                header("Location: penggajian.php?success=2");
            } else {
                header("Location: penggajian.php?warning=perubahan");
            }
        }
        else
            echo "Error ".(DEVELOPMENT?":".$db->error:"");   
    } 
    else 
    {
        $_SESSION["salahinputgaji"] = $pesansalah;
        header("Location: penggajian.php?error=input");
    }
}
else 
    header("Location: penggajian.php?error=koneksi");
?>