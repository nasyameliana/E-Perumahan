<?php

ob_start();
session_start();

require_once "../util/koneksi.php";
require_once "../util/fungsi.php";
$idWarga = 0;
if (isset($_GET['id_warga'])) {
    $idWarga = $_GET['id_warga'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard - NiceAdmin Bootstrap Template</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../assets/img/favicon.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
          rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
    * Template Name: NiceAdmin - v2.2.2
    * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
</head>

<body>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">

        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->


    <?php


    $username = $_SESSION['username'];
    $password = $_SESSION['password'];

    $sql = "SELECT * FROM `tbl_user`  WHERE  `id_warga` = '$idWarga'  ";
    $hasil = $koneksi->query($sql);

    $get = $hasil->fetch_assoc();
    $getId = $get['id_warga'];
    $getName = $get['name'];
    ?>

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <li class="nav-item dropdown pe-3">
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <span class=" d-md-block  ps-2">Rumah, <?= $getName ?></span>
                </a><!-- End Profile Iamge Icon -->
            </li><!-- End Profile Nav -->
        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->
<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">


        <li class="nav-item">
            <a class="nav-link collapsed" href="index-warga.php">
                <i class="bi bi-people"></i><span>Tamu</span>
            </a>

        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="history-tamu.php?id_warga=<?= $getId?>">
                <i class="bi bi-file-text"></i><span>History Tamu</span>
            </a>

        </li><!-- End Tables Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="logout.php">
                <i class="bi bi-power"></i>
                <span>Logout</span>
            </a>
        </li><!-- End Login Page Nav -->

    </ul>

</aside><!-- End Sidebar-->

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">History</li>

            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12 text-end">

                <div class="card">
                    <div class="card-body">
                        <!-- Table with stripped rows -->
                        <table class="table datatable text-start">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Tamu</th>

                                <th scope="col">OTP Masuk</th>
                                <th scope="col">OTP Keluar</th>

                                <th scope="col">Jam Masuk</th>
                                <th scope="col">Jam Keluar</th>


                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $sql = "SELECT * FROM `history_tamu` WHERE `tujuan_tamu` = '$idWarga'";
                            $hasil = $koneksi->query($sql);
                            $no = 0;
                            if ($hasil->num_rows > 0) {
                                while ($row = $hasil->fetch_assoc()) {

                                    echo '
                                            <tr>
                                                <th scope="row">'.$no++.'</th>
                                                <td>'.$row["nama_tamu"].'</td>
                                                  <td>'.$row["otp_masuk"].'</td>
                                                    <td>'.$row["otp_keluar"].'</td>
                                                <td>'.date('Y-m-d H:i:s ', $row["jam_masuk"]).'</td>
                                                
                                                <td>'.date('Y-m-d H:i:s ', $row["jam_keluar"]).'</td>
                                                
                                             
                                            </tr>
                                            ';

                                }
                            }
                            else {
                                echo "NO DATA";
                            }
                            ?>



                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>

        </div>
    </section>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="copyright">
        &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <!--    <div class="credits">-->
    <!--        &lt;!&ndash; All the links in the footer should remain intact. &ndash;&gt;-->
    <!--        &lt;!&ndash; You can delete the links only if you purchased the pro version. &ndash;&gt;-->
    <!--        &lt;!&ndash; Licensing information: https://bootstrapmade.com/license/ &ndash;&gt;-->
    <!--        &lt;!&ndash; Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ &ndash;&gt;-->
    <!--        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>-->
    <!--    </div>-->
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendor/chart.js/chart.min.js"></script>
<script src="../assets/vendor/echarts/echarts.min.js"></script>
<script src="../assets/vendor/quill/quill.min.js"></script>
<script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="../assets/vendor/tinymce/tinymce.min.js"></script>
<script src="../assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="../assets/js/main.js"></script>

</body>

</html>
