<?php
if (!isset($_SESSION['login'])) {
    echo "<script> alert('Silahkan login terlebih dahulu'); </script>";
    echo "<meta http-equiv='refresh' content='0; url=" . base_url('index') . "'>";
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Akademik SPN POLDA KALSEL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url() ?>/assets/images/logo.png">

    <!-- Bootstrap Css -->
    <link href="<?= base_url() ?>/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?= base_url() ?>/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?= base_url() ?>/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    <link href="<?= base_url() ?>/assets/libs/fontawesome/css/all.min.css" rel="stylesheet">

    <link href="<?= base_url() ?>/assets/libs/swal2/dist/sweetalert2.min.css" rel="stylesheet">

    <link href="<?= base_url() ?>/assets/libs/datatable/datatables.min.css" rel="stylesheet">

    <link href="<?= base_url() ?>/assets/libs/select2/css/select2.min.css" rel="stylesheet">

    <link href="<?= base_url() ?>/assets/libs/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/custom.min.css">
</head>

<body data-layout="horizontal" data-topbar="colored">
    <div class="container-fluid">
        <!-- Begin page -->
        <div id="layout-wrapper">

            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box p-0">
                            <span class="logo logo-dark">
                                <span class="logo-lg">
                                    <img src="<?= base_url() ?>/assets/images/logo.png" alt="" height="52">
                                </span>
                            </span>

                            <span class="logo logo-light">
                                <span class="logo-lg">
                                    <img src="<?= base_url() ?>/assets/images/logo.png" alt="" height="52">
                                </span>
                            </span>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                            <i class="fa fa-fw fa-bars"></i>
                            <img src="<?= base_url() ?>/assets/images/logo.png" alt="" height="30">
                            SPN POLDA KALSEL
                        </button>

                        <div class="topnav px-0">
                            <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

                                <div class="collapse navbar-collapse" id="topnav-menu-content">
                                    <ul class="navbar-nav">
                                        <?php if ($_SESSION['level'] == 1) { ?>
                                            <li class="nav-item dropdown <?php if ($page == 'dashboard') {
                                                                                echo 'active';
                                                                            } ?>">
                                                <a class="nav-link" href="<?= base_url() ?>/view/admin/">
                                                    <i class="mdi mdi-airplay me-2"></i>Dashboard
                                                </a>
                                            </li>

                                            <li class="nav-item dropdown <?php if ($page == 'user' || $page == 'jabatan' || $page == 'pangkat' || $page == 'asuhan' || $page == 'jabatan_asuhan' || $page == 'mapel' || $page == 'kelas') {
                                                                                echo 'active';
                                                                            } ?>">
                                                <a class="nav-link dropdown-toggle arrow-none" href="#" role="button">
                                                    <i class="bi bi-bar-chart-steps me-2"></i>Data Master <div class="arrow-down"></div>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="topnav-master">
                                                    <a href="<?= base_url() ?>/view/admin/user/" class="dropdown-item <?php if ($page == 'user') {
                                                                                                                            echo 'active';
                                                                                                                        } ?>"><i class="fas fa-user-friends me-2"></i>Data Pengguna</a>
                                                    <a href="<?= base_url() ?>/view/admin/pangkat/" class="dropdown-item <?php if ($page == 'pangkat') {
                                                                                                                                echo 'active';
                                                                                                                            } ?>"><i class="fas fa-award me-2"></i>Data Pangkat</a>
                                                    <a href="<?= base_url() ?>/view/admin/jabatan/" class="dropdown-item <?php if ($page == 'jabatan') {
                                                                                                                                echo 'active';
                                                                                                                            } ?>"><i class="fas fa-sitemap me-2"></i>Data Jabatan</a>
                                                    <a href="<?= base_url() ?>/view/admin/asuhan/" class="dropdown-item <?php if ($page == 'asuhan') {
                                                                                                                            echo 'active';
                                                                                                                        } ?>"><i class="fas fa-layer-group me-2"></i>Data Asuhan</a>
                                                    <a href="<?= base_url() ?>/view/admin/jabatan-asuhan/" class="dropdown-item <?php if ($page == 'jabatan_asuhan') {
                                                                                                                                    echo 'active';
                                                                                                                                } ?>"><i class="fas fa-user-tag me-2"></i>Data Jabatan Asuhan</a>
                                                    <a href="<?= base_url() ?>/view/admin/mapel/" class="dropdown-item <?php if ($page == 'mapel') {
                                                                                                                            echo 'active';
                                                                                                                        } ?>"><i class="fas fa-clipboard-list me-2"></i>Data Mata Pelajaran</a>
                                                    <a href="<?= base_url() ?>/view/admin/kelas/" class="dropdown-item <?php if ($page == 'kelas') {
                                                                                                                            echo 'active';
                                                                                                                        } ?>"><i class="bi bi-building me-2"></i>Data Ruang Kelas</a>
                                                </div>
                                            </li>

                                            <li class="nav-item dropdown <?php if ($page == 'gadik' || $page == 'gadik_mapel' || $page == 'pengasuh' || $page == 'jadwal') {
                                                                                echo 'active';
                                                                            } ?>">
                                                <a class="nav-link dropdown-toggle arrow-none" href="#" role="button">
                                                    <i class="fas fa-user-graduate me-2"></i>Menu Gadik <div class="arrow-down"></div>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="topnav-gadik">
                                                    <a href="<?= base_url() ?>/view/admin/gadik/" class="dropdown-item <?php if ($page == 'gadik') {
                                                                                                                            echo 'active';
                                                                                                                        } ?>"><i class="fas fa-id-badge me-2"></i>Data Gadik</a>
                                                    <a href="<?= base_url() ?>/view/admin/pengasuh/" class="dropdown-item <?php if ($page == 'pengasuh') {
                                                                                                                                echo 'active';
                                                                                                                            } ?>"><i class="fas fa-house-user me-2"></i>Data Pengasuh</a>
                                                    <a href="<?= base_url() ?>/view/admin/gadik-mapel/" class="dropdown-item <?php if ($page == 'gadik_mapel') {
                                                                                                                                    echo 'active';
                                                                                                                                } ?>"><i class="fas fa-address-book me-2"></i>Data Gadik Mapel</a>
                                                    <a href="<?= base_url() ?>/view/admin/jadwal/" class="dropdown-item <?php if ($page == 'jadwal') {
                                                                                                                            echo 'active';
                                                                                                                        } ?>"><i class="fas fa-user-clock me-2"></i>Data Jadwal Mengajar</a>
                                                </div>
                                            </li>
                                            <li class="nav-item dropdown <?php if ($page == 'siswa' || $page == 'kelas_siswa' || $page == 'absensi' || $page == 'konseling') {
                                                                                echo 'active';
                                                                            } ?>">
                                                <a class="nav-link dropdown-toggle arrow-none" href="#" role="button">
                                                    <i class="fas fa-graduation-cap me-2"></i>Menu Siswa <div class="arrow-down"></div>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="topnav-siswa">
                                                    <a href="<?= base_url() ?>/view/admin/siswa/" class="dropdown-item <?php if ($page == 'siswa') {
                                                                                                                            echo 'active';
                                                                                                                        } ?>"><i class="bi bi-person-lines-fill me-2"></i>Data Siswa</a>
                                                    <a href="<?= base_url() ?>/view/admin/kelas-siswa/" class="dropdown-item <?php if ($page == 'kelas_siswa') {
                                                                                                                                    echo 'active';
                                                                                                                                } ?>"><i class="bi bi-building-check me-2"></i>Data Kelas Siswa</a>
                                                    <a href="<?= base_url() ?>/view/admin/konseling/" class="dropdown-item <?php if ($page == 'konseling') {
                                                                                                                                echo 'active';
                                                                                                                            } ?>"><i class="fas fa-comments me-2"></i>Data Konseling</a>
                                                    <a href="<?= base_url() ?>/view/admin/absensi/" class="dropdown-item <?php if ($page == 'absensi') {
                                                                                                                                echo 'active';
                                                                                                                            } ?>"><i class="bi bi-calendar-check me-2"></i>Data Absensi</a>
                                                </div>
                                            </li>

                                            <li class="nav-item dropdown dropLaporan">
                                                <a class="nav-link dropdown-toggle arrow-none" href="#" role="button">
                                                    <i class="fas fa-file-alt me-2"></i>Laporan Cetak <div class="arrow-down"></div>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="topnav-laporan">
                                                    <a href="" data-bs-toggle="modal" data-bs-target="#lapGadik" class="dropdown-item"><i class="far fa-circle me-2"></i>Gadik</a>
                                                    <a href="" data-bs-toggle="modal" data-bs-target="#lapPengasuh" class="dropdown-item"><i class="far fa-circle me-2"></i>Pengasuh</a>
                                                    <a href="" data-bs-toggle="modal" data-bs-target="#lapGadikMapel" class="dropdown-item"><i class="far fa-circle me-2"></i>Gadik Mapel</a>
                                                    <a href="" data-bs-toggle="modal" data-bs-target="#lapJadwal" class="dropdown-item"><i class="far fa-circle me-2"></i>Jadwal Mengajar Gadik</a>
                                                    <a href="" data-bs-toggle="modal" data-bs-target="#lapSiswa" class="dropdown-item"><i class="far fa-circle me-2"></i>Siswa</a>
                                                    <a href="" data-bs-toggle="modal" data-bs-target="#lapKelas" class="dropdown-item"><i class="far fa-circle me-2"></i>Kelas Siswa</a>
                                                    <a href="" data-bs-toggle="modal" data-bs-target="#lapKonseling" class="dropdown-item"><i class="far fa-circle me-2"></i>Konseling</a>
                                                    <a href="" data-bs-toggle="modal" data-bs-target="#lapAbsensi" class="dropdown-item"><i class="far fa-circle me-2"></i>Absensi</a>
                                                </div>
                                            </li>
                                        <?php } else if ($_SESSION['level'] == 2) { ?>

                                        <?php } else { ?>
                                            <li class="nav-item dropdown <?php if ($page == 'dashboard') {
                                                                                echo 'active';
                                                                            } ?>">
                                                <a class="nav-link" href="<?= base_url() ?>/view/gadik/">
                                                    <i class="mdi mdi-airplay me-2"></i>Dashboard
                                                </a>
                                            </li>
                                            <li class="nav-item dropdown <?php if ($page == 'gadik_mapel' || $page == 'pengasuh' || $page == 'jadwal') {
                                                                                echo 'active';
                                                                            } ?>">
                                                <a class="nav-link dropdown-toggle arrow-none" href="#" role="button">
                                                    <i class="fas fa-user-graduate me-2"></i>Menu Gadik <div class="arrow-down"></div>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="topnav-gadik">
                                                    <a href="<?= base_url() ?>/view/gadik/pengasuh/" class="dropdown-item <?php if ($page == 'pengasuh') {
                                                                                                                                echo 'active';
                                                                                                                            } ?>"><i class="fas fa-house-user me-2"></i>Data Pengasuh</a>
                                                    <a href="<?= base_url() ?>/view/gadik/gadik-mapel/" class="dropdown-item <?php if ($page == 'gadik_mapel') {
                                                                                                                                    echo 'active';
                                                                                                                                } ?>"><i class="fas fa-address-book me-2"></i>Data Gadik Mapel</a>
                                                    <a href="<?= base_url() ?>/view/gadik/jadwal/" class="dropdown-item <?php if ($page == 'jadwal') {
                                                                                                                            echo 'active';
                                                                                                                        } ?>"><i class="fas fa-user-clock me-2"></i>Data Jadwal Mengajar</a>
                                                </div>
                                            </li>
                                            <li class="nav-item dropdown <?php if ($page == 'absensi' || $page == 'konseling') {
                                                                                echo 'active';
                                                                            } ?>">
                                                <a class="nav-link dropdown-toggle arrow-none" href="#" role="button">
                                                    <i class="fas fa-graduation-cap me-2"></i>Menu Siswa <div class="arrow-down"></div>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="topnav-siswa">
                                                    <a href="<?= base_url() ?>/view/gadik/konseling/" class="dropdown-item <?php if ($page == 'konseling') {
                                                                                                                                echo 'active';
                                                                                                                            } ?>"><i class="fas fa-comments me-2"></i>Data Konseling</a>
                                                    <a href="<?= base_url() ?>/view/gadik/absensi/" class="dropdown-item <?php if ($page == 'absensi') {
                                                                                                                                echo 'active';
                                                                                                                            } ?>"><i class="bi bi-calendar-check me-2"></i>Data Absensi Siswa</a>
                                                </div>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>

                    <div class="d-flex">

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user-circle"></i>
                                <span class="d-none d-xl-inline-block ms-1"><?= $_SESSION['nm_user'] ?></span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a class="dropdown-item" href="<?= base_url() ?>/view/auth/ubah-pw"><i class="bx bx-key font-size-16 align-middle me-2"></i>Ubah Password</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger alert-logout" href="<?= base_url() ?>/view/auth/logout"><i class="bx bx-power-off font-size-16 align-middle me-2 text-danger"></i> Logout</a>
                            </div>
                        </div>
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                                <i class="mdi mdi-settings-outline"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">