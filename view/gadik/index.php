<?php
require '../../app/config.php';
$page = 'dashboard';
include_once '../layout/topbar.php';

$log = $con->query("SELECT * FROM user WHERE id_user = '$_SESSION[id_user]' ")->fetch_array();
$user = $log['id_gadik'];

$a = $con->query("SELECT COUNT(*) AS total FROM pengasuh WHERE id_gadik = '$user' ")->fetch_array();
$b = $con->query("SELECT COUNT(*) AS total FROM gadik_mapel WHERE id_gadik = '$user' ")->fetch_array();
$c = $con->query("SELECT COUNT(*) AS total FROM jadwal a LEFT JOIN gadik_mapel b ON a.id_gadik_mapel = b.id_gadik_mapel WHERE b.id_gadik = '$user' ")->fetch_array();
$d = $con->query("SELECT COUNT(*) AS total FROM konseling WHERE id_gadik = '$user' ")->fetch_array();
?>
<div class="page-content">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18"><i class="mdi mdi-airplay me-2"></i>Dashboard</h4>

                <div class="page-title-right">
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start my-2">
                        <div class="me-3 align-self-center">
                            <div class="avatar-sm font-size-20">
                                <span class="avatar-title bg-soft-danger text-danger rounded">
                                    <i class="fas fa-home-user"></i>
                                </span>
                            </div>
                        </div>
                        <div class="flex-1 overflow-hidden">
                            <h5 class="font-size-16 mb-1">Data Pengasuh</h5>
                            <p class="text-truncate mb-0"><?= $a['total'] ?> Data</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start my-2">
                        <div class="me-3 align-self-center">
                            <div class="avatar-sm font-size-20">
                                <span class="avatar-title bg-soft-danger text-danger rounded">
                                    <i class="fas fa-address-book"></i>
                                </span>
                            </div>
                        </div>
                        <div class="flex-1 overflow-hidden">
                            <h5 class="font-size-16 mb-1">Data Gadik Mapel</h5>
                            <p class="text-truncate mb-0"><?= $b['total'] ?> Data</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start my-2">
                        <div class="me-3 align-self-center">
                            <div class="avatar-sm font-size-20">
                                <span class="avatar-title bg-soft-danger text-danger rounded">
                                    <i class="fas fa-user-clock"></i>
                                </span>
                            </div>
                        </div>
                        <div class="flex-1 overflow-hidden">
                            <h5 class="font-size-16 mb-1">Data Jadwal Mengajar</h5>
                            <p class="text-truncate mb-0"><?= $c['total'] ?> Data</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start my-2">
                        <div class="me-3 align-self-center">
                            <div class="avatar-sm font-size-20">
                                <span class="avatar-title bg-soft-danger text-danger rounded">
                                    <i class="fas fa-comments"></i>
                                </span>
                            </div>
                        </div>
                        <div class="flex-1 overflow-hidden">
                            <h5 class="font-size-16 mb-1">Data Konseling</h5>
                            <p class="text-truncate mb-0"><?= $d['total'] ?> Data</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
</div>
<!-- End Page-content -->

<?php include_once '../layout/footer.php'; ?>
<script src="<?= base_url() ?>/app/js/app2.js"></script>