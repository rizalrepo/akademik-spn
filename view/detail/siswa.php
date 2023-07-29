<?php
require '../../../app/configtables.php';
$con = mysqli_connect($con['host'], $con['user'], $con['pass'], $con['db']);
if (mysqli_connect_errno()) {
    echo mysqli_connect_error();
}
?>
<div id="id<?= $id = $row[0]; ?>" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="custom-width-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="custom-width-modalLabel"><i class="bi bi-person-lines-fill me-2"></i>Detail Data Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $q = $con->query("SELECT * FROM siswa WHERE id_siswa = '$id' ");
            $d = $q->fetch_array();
            $tgl = new DateTime($d['tgl_lahir']);
            $today = new DateTime('today');
            $y = $today->diff($tgl)->y;
            ?>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="card-body" style="text-align: left;">
                            <dl class="row">
                                <dt class="col-sm-3">Nama Lengkap</dt>
                                <dd class="col-sm-9">: <?= $d['nm_siswa'] ?></dd>
                                <dt class="col-sm-3">NOSIS</dt>
                                <dd class="col-sm-9">: <?= $d['nrp'] ?></dd>
                                <dt class="col-sm-3">Asal Sekolah</dt>
                                <dd class="col-sm-9">: <?= $d['sekolah'] ?></dd>
                                <dt class="col-sm-3">TTL</dt>
                                <dd class="col-sm-9">: <?= $d['tmpt_lahir'] . ', ' . tgl($d['tgl_lahir']) ?></dd>
                                <dt class="col-sm-3">Usia</dt>
                                <dd class="col-sm-9">: <?= $y ?> Tahun</dd>
                                <dt class="col-sm-3">Jenis Kelamin</dt>
                                <dd class="col-sm-9">: <?= $d['jk'] ?></dd>
                                <dt class="col-sm-3">Agama</dt>
                                <dd class="col-sm-9">: <?= $d['agama'] ?></dd>
                                <dt class="col-sm-3">Alamat</dt>
                                <dd class="col-sm-9">: <?= $d['alamat'] ?></dd>
                                <dt class="col-sm-3">Nama Wali</dt>
                                <dd class="col-sm-9">: <?= $d['nm_wali'] ?></dd>
                                <dt class="col-sm-3">Kontak Wali</dt>
                                <dd class="col-sm-9">: <?= $d['hp_wali'] ?></dd>
                                <dt class="col-sm-3">Tanggal Daftar</dt>
                                <dd class="col-sm-9">: <?= tgl($d['tgl_daftar']) ?></dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->