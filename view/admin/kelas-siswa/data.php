<?php
require '../../../app/config.php';
$page = 'kelas_siswa';
include_once '../../layout/topbar.php';

$dt = $_GET['ta'];
?>

<div class="page-content">
    <div class="row">

        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18"><i class="bi bi-building-check me-2"></i>Data Kelas Siswa</h4>

                <div class="page-title-right">
                    <a href="tambah?ta=<?= $dt ?>" class="btn btn-sm btn-success"><i class="fas fa-plus-circle"></i> Tambah Data</a>
                </div>
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
                                <th>Kelas</th>
                                <th>Tahun Asuhan</th>
                                <th>Jumlah Siswa</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $no = 1;
                            $data = $con->query("SELECT * FROM kelas_siswa a LEFT JOIN kelas b ON a.id_kelas = b.id_kelas LEFT JOIN asuhan c ON a.id_asuhan = c.id_asuhan WHERE a.id_asuhan = '$dt' ORDER BY a.id_kelas_siswa DESC");
                            while ($row = $data->fetch_array()) {
                            ?>
                                <tr>
                                    <td align="center" width="5%"><?= $no++ ?></td>
                                    <td align="center"><?= $row['nm_kelas'] ?></td>
                                    <td align="center">Tahun <?= $row['tahun'] . ' ' . $row['gelombang'] ?></td>
                                    <td align="center">
                                        <?php
                                        $jml = $con->query("SELECT COUNT(*) AS total FROM kelas_siswa_detail WHERE kode = '$row[kode]'")->fetch_array();
                                        if ($jml['total']) {
                                            echo $jml['total'] . ' Orang';
                                        } else {
                                            echo 'Belum ada Siswa';
                                        }
                                        ?>
                                    </td>
                                    <td align="center" width="11%">
                                        <span data-bs-target="#id<?= $row[0]; ?>" data-bs-toggle="modal" class="btn bg-success btn-xs text-white">
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Detail"><i class="fa fa-info-circle"></i></span>
                                        </span>
                                        <a href="edit?id=<?= $row[0] ?>&ta=<?= $dt ?>" class="btn btn-info btn-xs text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
                                        <a href="hapus?id=<?= $row[0] ?>&ta=<?= $dt ?>" class="btn btn-danger btn-xs alert-hapus" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"><i class="fas fa-trash"></i></a>
                                        <?php include('../../detail/kelas-siswa.php'); ?>
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