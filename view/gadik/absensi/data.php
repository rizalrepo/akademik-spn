<?php
require '../../../app/config.php';
$page = 'jadwal';
include_once '../../layout/topbar.php';

$dt = $_GET['ta'];
$title = $con->query("SELECT * FROM asuhan WHERE id_asuhan = '$dt'")->fetch_array();

$log = $con->query("SELECT * FROM user WHERE id_user = '$_SESSION[id_user]' ")->fetch_array();
$user = $log['id_gadik'];
?>

<div class="page-content">
    <div class="row">

        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18"><i class="bi bi-calendar-check me-2"></i>Data Absensi Siswa Tahun <?= $title['tahun'] . ' ' . $title['gelombang'] ?></h4>
            </div>
            <div class="card card-body border border-danger">
                <form action="data" method="GET">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tahun Asuhan</label>
                        <div class="col-sm-10">
                            <select name="ta" class="form-select select2" style="width: 100%;" onchange="if(this.value != 0) { this.form.submit(); }" required>
                                <?php $data = $con->query("SELECT * FROM asuhan ORDER BY id_asuhan DESC"); ?>
                                <?php foreach ($data as $d) :
                                    if ($dt == $d['id_asuhan']) { ?>
                                        <option value="<?= $d['id_asuhan']; ?>" selected="<?= $d['id_asuhan']; ?>">Tahun <?= $d['tahun'] ?> <?= $d['gelombang'] ?></option>
                                    <?php } else { ?>
                                        <option value="<?= $d['id_asuhan'] ?>">Tahun <?= $d['tahun'] ?> <?= $d['gelombang'] ?></option>
                                <?php }
                                endforeach ?>
                            </select>
                            <div class="invalid-feedback">Kolom harus di pilih !</div>
                        </div>
                    </div>
                </form>
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
                                <th>Ruang Kelas</th>
                                <th>Mata Pelajaran</th>
                                <th>Jadwal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $no = 1;
                            $data = $con->query("SELECT * FROM jadwal a LEFT JOIN kelas_siswa b ON a.id_kelas_siswa = b.id_kelas_siswa LEFT JOIN kelas c ON b.id_kelas = c.id_kelas LEFT JOIN gadik_mapel d ON a.id_gadik_mapel = d.id_gadik_mapel LEFT JOIN mapel e ON d.id_mapel = e.id_mapel WHERE d.id_gadik = '$user' AND a.id_asuhan = '$dt' ORDER BY a.id_jadwal ASC");
                            while ($row = $data->fetch_array()) {
                            ?>
                                <tr>
                                    <td align="center"><?= $no++; ?></td>
                                    <td align="center"><?= $row['nm_kelas'] ?></td>
                                    <td align="center"><?= $row['kd_mapel'] ?> - <?= $row['nm_mapel'] ?></td>
                                    <td align="center">
                                        <?= $row['hari'] ?> <br>
                                        <?= $row['jam_mulai'] ?> - <?= $row['jam_selesai'] ?>
                                    </td>
                                    <td align="center" width="14%">
                                        <div class="d-grid px-1">
                                            <a href="absensi?id=<?= $row[0] ?>&ta=<?= $dt ?>" class="btn btn-primary btn-xs text-white"><i class="bi bi-calendar-check me-1"></i>Lihat Absensi</a>
                                            <span data-bs-target="#id<?= $row[0]; ?>" data-bs-toggle="modal" class="btn btn-success btn-xs mt-1"><i class="bi bi-list-check me-1"></i>Detail Absensi</span>
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