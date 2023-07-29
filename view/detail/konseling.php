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
                <h5 class="modal-title" id="custom-width-modalLabel"><i class="fas fa-comments me-2"></i>Detail Data Konseling</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $q = $con->query("SELECT * FROM konseling a LEFT JOIN siswa b ON a.id_siswa = b.id_siswa LEFT JOIN asuhan c ON a.id_asuhan = c.id_asuhan LEFT JOIN gadik d ON a.id_gadik = d.id_gadik WHERE a.id_konseling = '$id' ");
            $d = $q->fetch_array();
            ?>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="card-body" style="text-align: left;">
                            <dl class="row">
                                <dt class="col-sm-3">Tahun Asuhan</dt>
                                <dd class="col-sm-9">: Tahun <?= $d['tahun'] . ' ' . $d['gelombang'] ?></dd>
                                <dt class="col-sm-3">Siswa</dt>
                                <dd class="col-sm-9">: NOSIS <?= $d['nrp'] ?> | <?= $d['nm_siswa'] ?></dd>
                                <dt class="col-sm-3">Topik</dt>
                                <dd class="col-sm-9">: <?= $d['topik'] ?></dd>
                                <dt class="col-sm-3">Hasil</dt>
                                <dd class="col-sm-9">: <?= $d['hasil'] ?></dd>
                                <dt class="col-sm-3">Gadik</dt>
                                <dd class="col-sm-9">: NRP/NIP <?= $d['nrp_nip'] ?> | <?= $d['nm_gadik'] ?></dd>
                                <dt class="col-sm-3">Tanggal</dt>
                                <dd class="col-sm-9">: <?= tgl($d['tgl_konseling']) ?></dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->