<?php
require '../../../app/config.php';
$page = 'jadwal';
include_once '../../layout/topbar.php';

$log = $con->query("SELECT * FROM user WHERE id_user = '$_SESSION[id_user]' ")->fetch_array();
$user = $log['id_gadik'];
?>

<div class="page-content">
    <div class="row">

        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18"><i class="fas fa-user-clock me-2"></i>Data Jadwal Mengajar</h4>
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
                                <th>Data Gadik</th>
                                <th>Mata Pelajaran</th>
                                <th>Tahun Asuhan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $no = 1;
                            $data = $con->query("SELECT * FROM gadik_mapel a LEFT JOIN gadik b ON a.id_gadik = b.id_gadik LEFT JOIN pangkat c ON b.id_pangkat = c.id_pangkat LEFT JOIN jabatan d ON b.id_jabatan = d.id_jabatan LEFT JOIN mapel e ON a.id_mapel = e.id_mapel LEFT JOIN asuhan f ON a.id_asuhan = f.id_asuhan WHERE b.id_gadik = '$user' ORDER BY a.id_gadik_mapel DESC");
                            while ($row = $data->fetch_array()) {
                            ?>
                                <tr>
                                    <td align="center" width="5%"><?= $no++ ?></td>
                                    <td>
                                        <b>Nama </b> : <?= $row['nm_gadik'] ?>
                                        <hr class="my-1">
                                        <b>NRP/NIP </b> : <?= $row['nrp_nip'] ?>
                                        <hr class="my-1">
                                        <b>Pangkat </b> : <?= $row['nm_pangkat'] ?>
                                        <hr class="my-1">
                                        <b>Jabatan </b> : <?= $row['nm_jabatan'] ?>
                                    </td>
                                    <td align="center"><?= $row['kd_mapel'] ?> - <?= $row['nm_mapel'] ?></td>
                                    <td align="center">Tahun <?= $row['tahun'] . ' ' . $row['gelombang'] ?></td>
                                    <td align="center" width="14%">
                                        <div class="d-grid px-1">
                                            <span data-bs-target="#id<?= $row[0]; ?>" data-bs-toggle="modal" class="btn btn-success btn-xs mt-1"><i class="bi bi-list-check me-1"></i>Lihat Jadwal</span>
                                        </div>
                                        <?php include('../../detail/jadwal.php'); ?>
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