<?php 
include_once("functions.php");
session_id("basdat2");
session_start();
if(!isset($_SESSION["kode_user"]))
{
    header("Location: ../index.php?error=akses");
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slip Gaji <?php echo $_GET["no_slip"] ?></title>
</head>
<body style="width:80%;margin:auto">
<button onclick="window.print()">Cetak</button>
<?php
if(isset($_GET["no_slip"]))
{
    $db = dbConnect();
    if($db->connect_errno==0)
    {
        $no_slip = $_GET["no_slip"];
        $sql = "SELECT a.tanggal,a.periode_gaji,a.gaji_pokok,a.tunjangan_bagian,a.total_lembur,a.total_gaji,b.nama as karyawan,c.nama as bagian,d.nama as user
            FROM penggajian as a
            INNER JOIN karyawan as b ON a.kode_karyawan = b.kode_karyawan
            INNER JOIN bagian as c ON b.kode_bagian = c.kode_bagian
            INNER JOIN user as d ON a.kode_user = d.kode_user
            WHERE a.no_slip = '$no_slip'";
        $res = $db->query($sql);
        if($res)
        {
            if($res->num_rows==1)
            {
                $data = $res->fetch_assoc();
                ?>
                <h2 align="center" style="border-bottom:2px solid black">SLIP GAJI KARYAWAN</h2>
                <h3>
                    Data Karyawan
                </h3>
                <table border="0" width="100%">              
                    <tr>
                        <td width="15%">Tanggal</td>
                        <td width="5px">:</td>
                        <td><?php echo tgl_indo(date("Y-m-d", strtotime($data["tanggal"]))) ?></td>
                    </tr>
                    <tr>
                        <td>Periode Gaji</td>
                        <td>:</td>
                        <td><?php echo tgl_indo(date('Y-m', strtotime($data["periode_gaji"]))); ?></td>
                    </tr>
                    <tr>
                        <td>Nama Karyawan</td>
                        <td>:</td>
                        <td><?php echo $data["karyawan"] ?></td>
                    </tr>
                    <tr>
                        <td>Bagian</td>
                        <td>:</td>
                        <td><?php echo $data["bagian"] ?></td>
                    </tr>
                </table>
                <h3 align="right">
                    Data Gaji
                </h3>
                <table border="0" width="100%" style="border-collapse:collapse">              
                    <tr style="text-align:center">
                        <td style="text-align:right">Gaji Pokok (Rp) +</td>
                        <td width="10px">:</td>
                        <td style="text-align:right;" width="10%"><?php echo number_format($data["gaji_pokok"],0,',','.') ?></td>
                    </tr>
                    <tr style="text-align:center">
                        <td style="text-align:right">Tunjangan Bagian (Rp) +</td>
                        <td>:</td>
                        <td style="text-align:right;" width="10%"><?php echo number_format($data["tunjangan_bagian"],0,',','.') ?></td>
                    </tr>
                    <tr style="text-align:center">
                        <td style="text-align:right">Uang Lembur (<?php echo $data["total_lembur"] ?>x) (Rp) +</td>
                        <td>:</td>
                        <td style="text-align:right;" width="10%"><?php echo number_format(($data["total_lembur"] * 50000),0,',','.') ?></td>
                    </tr>
                    <tr style="text-align:center;border-top:1px solid black">
                        <td style="text-align:right">Gaji Bersih (Rp) +</td>
                        <td>:</td>
                        <td style="text-align:right;" width="10%"><?php echo number_format($data["total_gaji"],0,',','.') ?></td>
                    </tr>                    
                </table>
                <table>
                    <tr>
                        <td>Direktur</td>
                        <td>:</td>
                        <td><?php echo $data["user"] ?></td>
                    </tr>
                </table>
                <?php
            }
        }
    }  
}
?>   
</body>
</html>