<?php 
include_once("functions.php");
include_once("../layout.php");
session_id("basdat2");
session_start();
if(!isset($_SESSION["kode_user"]))
{
    header("Location: ../index.php?error=akses");
}
?>
<?php style_section() ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body style="width:80%;margin:auto">
<!-- <button onclick="window.print()">Cetak</button> -->
<?php 
setlocale(LC_ALL, 'IND');
$bulan = $_GET["bulan"];
$tahun = $_GET["tahun"];

?>
<div class="divider">
    <div class="divider-text">
        <h4>Laporan Gaji Karyawan</h4>
    </div>
    <p>
        <?php echo strftime('%B',mktime($bulan)); ?> - <?php echo $tahun; ?>
    </p>
</div>
<table border="1" class="table table-bordered" style="border-collapse:collapse;width:100%">
    <thead>
        <tr align="center">
            <th>No.Slip</th>
            <th>Periode Gaji</th>
            <th>Tanggal</th>
            <th>NIK</th>
            <th>Nama Karyawan</th>
            <th>Gaji Bersih<small>(Rp)</small></th>
        </tr>
    </thead>
    <tbody>
    <?php
    $db = dbConnect();
        if($db->connect_errno==0)
        {
            $sql = "SELECT a.*,b.nik,b.nama as karyawan 
                    FROM penggajian as a
                    INNER JOIN karyawan as b ON a.kode_karyawan = b.kode_karyawan
                    WHERE MONTH(a.tanggal)='$bulan' AND YEAR(a.tanggal)='$tahun'
                    ORDER BY a.no_slip ASC";
            $res = $db->query($sql);
            if($res)
            {
                $data = $res->fetch_all(MYSQLI_ASSOC);
                foreach($data as $row)
                {
                    ?>
                    <tr align="center">
                        <td><?php echo $row["no_slip"] ?></td>
                        <td><?php echo date('m-Y', strtotime($row["periode_gaji"])) ?></td>
                        <td><?php echo date('d-m-Y', strtotime($row["tanggal"])) ?></td>
                        <td><?php echo $row["nik"] ?></td>
                        <td><?php echo $row["karyawan"] ?></td>
                        <td><?php echo number_format($row["total_gaji"],0,',','.') ?></td>
                    </tr>
                    <?php
                }
            } 
        }
    ?>
    </tbody>
</table>   
</body>
</html>