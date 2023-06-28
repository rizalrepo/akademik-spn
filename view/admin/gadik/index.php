<?php
require '../../../app/config.php';
$page = 'pegawai';
include_once '../../layout/topbar.php';
?>

<div class="page-content">
    <div class="row">

        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18"><i class="fas fa-id-badge me-2"></i>Data Pegawai</h4>

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
                                <th>Data Pegawai</th>
                                <th>Status</th>
                                <th>Jabatan</th>
                                <th>TMT</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $no = 1;
                            $data = $con->query("SELECT * FROM pegawai a LEFT JOIN golongan b ON a.id_golongan = b.id_golongan LEFT JOIN jabatan c ON a.id_jabatan = c.id_jabatan ORDER BY a.id_pegawai DESC");
                            while ($row = $data->fetch_array()) {
                            ?>
                                <tr>
                                    <td align="center" width="5%"><?= $no++ ?></td>
                                    <td>
                                        <b>Nama</b> : <?= $row['nm_pegawai'] ?>
                                        <hr class="my-1">
                                        <b>NIK</b> : <?= $row['nik'] ?>
                                        <?php if ($row['status'] == 'PNS') { ?>
                                            <hr class="my-1">
                                            <b>NIP</b> : <?= $row['nip'] ?>
                                        <?php } ?>
                                    </td>
                                    <td align="center">
                                        <?php if ($row['status'] == 'PNS') { ?>
                                            <?= $row['status'] ?> <br>
                                            <?= $row['nm_golongan'] . ' - ' . $row['pangkat'] ?>
                                        <?php } else { ?>
                                            <?= $row['status'] ?>
                                        <?php } ?>
                                    </td>
                                    <td align="center"><?= $row['nm_jabatan'] ?></td>
                                    <td align="center"><?= tgl($row['tmt']) ?></td>
                                    <td align="center" width="11%">
                                        <span data-bs-target="#id<?= $row[0]; ?>" data-bs-toggle="modal" class="btn bg-success btn-xs text-white" title="Detail"><i class="fa fa-info-circle"></i></span>
                                        <a href="edit?id=<?= $row[0] ?>" class="btn btn-info btn-xs text-white" title="Edit"><i class="fa fa-edit"></i></a>
                                        <a href="hapus?id=<?= $row[0] ?>" class="btn btn-danger btn-xs alert-hapus" title="Hapus"><i class="fa fa-trash"></i></a>
                                        <?php include('../../detail/pegawai.php'); ?>
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