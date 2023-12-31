<?php
require '../../../app/config.php';
$page = 'asuhan';
include_once '../../layout/topbar.php';
?>
<div class="page-content">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18"><i class="fas fa-layer-group me-2"></i>Data Asuhan</h4>

                <div class="page-title-right">
                    <a href="tambah" class="btn btn-sm btn-success"><i class="fas fa-plus-circle"></i> Tambah Data</a>
                </div>
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
                                <th>Tahun</th>
                                <th>Gelombang</th>
                                <th>Jumlah Kuota Siswa</th>
                                <th>Jumlah Siswa</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $no = 1;
                            $data = $con->query("SELECT * FROM asuhan ORDER BY id_asuhan DESC");
                            while ($row = $data->fetch_array()) {
                            ?>
                                <tr>
                                    <td align="center" width="5%"><?= $no++ ?></td>
                                    <td align="center"><?= $row['tahun'] ?></td>
                                    <td align="center"><?= $row['gelombang'] ?></td>
                                    <td align="center"><?= $row['jml_siswa'] ?> Orang</td>
                                    <td align="center">
                                        <?php
                                        if ($row['gelombang'] == 'Gelombang I') {
                                            $jml = $con->query("SELECT COUNT(*) AS jumlah FROM siswa WHERE YEAR(tgl_daftar) = '$row[tahun]' AND MONTH(tgl_daftar) BETWEEN 2 AND 6")->fetch_assoc();
                                        } else if ($row['gelombang'] == 'Gelombang II') {
                                            $jml = $con->query("SELECT COUNT(*) AS jumlah FROM siswa WHERE YEAR(tgl_daftar) = '$row[tahun]' AND MONTH(tgl_daftar) BETWEEN 7 AND 12")->fetch_assoc();
                                        }
                                        echo $jml['jumlah'];
                                        ?>
                                    </td>
                                    <td align="center" width="14%">
                                        <a href="edit?id=<?= $row[0] ?>" class="btn text-white btn-info btn-xs" title="Edit"><i class="fa fa-edit"></i> Edit</a>
                                        <a href="hapus?id=<?= $row[0] ?>" class="btn btn-danger btn-xs alert-hapus" title="Hapus"><i class="fa fa-trash"></i> Hapus</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<?php include_once '../../layout/footer.php'; ?>
<script src="<?= base_url() ?>/app/js/app.js"></script>