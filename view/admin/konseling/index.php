<?php
require '../../../app/config.php';
$page = 'konseling';
include_once '../../layout/topbar.php';
?>

<div class="page-content">
    <div class="row">

        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18"><i class="fas fa-comments me-2"></i>Data Konseling</h4>
            </div>
            <div class="card card-body border border-danger">

                <?php if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') { ?>
                    <div id="notif" class="alert alert-success d-flex align-items-center" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        <div>
                            <b><?= $_SESSION['pesan'] ?></b>
                        </div>
                    </div>
                <?php $_SESSION['pesan'] = '';
                } ?>


                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-hover table-striped dataTable">
                        <thead class="bg-danger">
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Data Siswa</th>
                                <th>Tahun Asuhan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $no = 1;
                            $data = $con->query("SELECT * FROM konseling a LEFT JOIN siswa b ON a.id_siswa = b.id_siswa LEFT JOIN asuhan c ON a.id_asuhan = c.id_asuhan ORDER BY a.id_konseling DESC");
                            while ($row = $data->fetch_array()) {
                            ?>
                                <tr>
                                    <td align="center" width="5%"><?= $no++ ?></td>
                                    <td align="center"><?= tgl($row['tgl_konseling']) ?></td>
                                    <td>
                                        <b>Nama</b> : <?= $row['nm_siswa'] ?>
                                        <hr class="my-1">
                                        <b>NOSIS</b> : <?= $row['nrp'] ?>
                                    </td>
                                    <td align="center">Tahun <?= $row['tahun'] . ' ' . $row['gelombang'] ?></td>
                                    <td align="center" width="4%">
                                        <span data-bs-target="#id<?= $row[0]; ?>" data-bs-toggle="modal" class="btn bg-success btn-xs text-white">
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Detail"><i class="fa fa-info-circle"></i></span>
                                        </span>
                                        <?php include('../../detail/konseling.php'); ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- row  -->
</div>


<?php include_once '../../layout/footer.php'; ?>
<script src="<?= base_url() ?>/app/js/app.js"></script>