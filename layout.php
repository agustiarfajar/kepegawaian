<?php
session_start();

function style_section()
{
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard - Mazer Admin Dashboard</title>

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../assets/css/bootstrap.css">

        <link rel="stylesheet" href="../assets/vendors/iconly/bold.css">

        <link rel="stylesheet" href="../assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
        <link rel="stylesheet" href="../assets/vendors/bootstrap-icons/bootstrap-icons.css">
        <link rel="stylesheet" href="../assets/css/app.css">
        <link rel="shortcut icon" href="../assets/images/favicon.svg" type="image/x-icon">
    </head>
<?php
}
?>

<?php 
function sidebar()
{
    ?>
    <body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="index.html"><img src="../assets/images/logo/logo.png" alt="Logo" srcset=""></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <?php 
                        if($_SESSION["level"] == 2)
                        {
                            ?>
                            <li class="sidebar-title">Master Data</li>

                            <li class="sidebar-item">
                                <a href="index.html" class='sidebar-link'>
                                    <i class="bi bi-grid-fill"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>

                            <li class="sidebar-item">
                                <a href="#" class='sidebar-link'>
                                    <i class="bi bi-stack"></i>
                                    <span>Bagian</span>
                                </a>
                            </li>

                            <li class="sidebar-item">
                                <a href="#" class='sidebar-link'>
                                    <i class="bi bi-people-fill"></i>
                                    <span>Karyawan</span>
                                </a>
                            </li>

                            <li class="sidebar-item">
                                <a href="#" class='sidebar-link'>
                                    <i class="bi bi-clock-fill"></i>
                                    <span>Lembur</span>
                                </a>
                            </li>
                            <?php
                        }
                        ?>

                        <?php 
                        if($_SESSION["level"] == 1)
                        {
                            ?>
                            <li class="sidebar-title">Transaksi</li>

                            <li class="sidebar-item">
                                <a href="#" class='sidebar-link'>
                                    <i class="bi bi-cash"></i>
                                    <span>Penggajian Karyawan</span>
                                </a>                            
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class='sidebar-link'>
                                    <i class="bi bi-folder-fill"></i>
                                    <span>Laporan Penggajian</span>
                                </a>                            
                            </li>
                            <li class="sidebar-title">Kelola Pengguna</li>

                            <li class="sidebar-item">
                                <a href="#" class='sidebar-link'>
                                    <i class="bi bi-people-fill"></i>
                                    <span>Pengguna</span>
                                </a>                            
                            </li>
                            <?php
                        }
                        ?>
                        <li class="sidebar-title">Akun</li>
                        <li class="sidebar-item">
                            <a href="../do-logout.php" class='sidebar-link'>
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Logout</span>
                            </a>                            
                        </li>
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        
    </div>
    <?php
}
?>
<?php 
function script_section()
{
    ?>
    <script src="../assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>

    <script src="../assets/vendors/apexcharts/apexcharts.js"></script>
    <script src="../assets/js/pages/dashboard.js"></script>

    <script src="../assets/js/main.js"></script>
</body>

</html>
<?php
}
?>