<?php
require '../../../app/configtables.php';
$con = mysqli_connect($con['host'], $con['user'], $con['pass'], $con['db']);
if (mysqli_connect_errno()) {
    echo mysqli_connect_error();
}
?>



<div class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Large
                    modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Cras mattis consectetur purus sit amet fermentum. Cras
                    justo odio, dapibus ac facilisis in, egestas eget quam.
                    Morbi leo risus, porta ac consectetur ac, vestibulum at
                    eros.</p>
                <p>Praesent commodo cursus magna, vel scelerisque nisl
                    consectetur et. Vivamus sagittis lacus vel augue laoreet
                    rutrum faucibus dolor auctor.</p>
                <p class="mb-0">Aenean lacinia bibendum nulla sed
                    consectetur. Praesent commodo cursus magna, vel
                    scelerisque nisl consectetur et. Donec sed odio dui.
                    Donec ullamcorper nulla non metus auctor fringilla.
                </p>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div id="id<?= $id = $row[0]; ?>" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="custom-width-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="custom-width-modalLabel"><i class="fas fa-id-badge me-2"></i>Detail Data Pegawai</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $q = $con->query("SELECT * FROM pegawai a LEFT JOIN golongan b ON a.id_golongan = b.id_golongan LEFT JOIN jabatan c ON a.id_jabatan = c.id_jabatan WHERE a.id_pegawai = '$id' ");
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
                                <dd class="col-sm-9">: <?= $d['nm_pegawai'] ?></dd>
                                <dt class="col-sm-3">Nomor Induk KTP</dt>
                                <dd class="col-sm-9">: <?= $d['nik'] ?></dd>
                                <dt class="col-sm-3">Status</dt>
                                <dd class="col-sm-9">: <?= $d['status'] ?></dd>
                                <?php if ($d['status'] == 'PNS') { ?>
                                    <dt class="col-sm-3">NIP</dt>
                                    <dd class="col-sm-9">: <?= $d['nip'] ?></dd>
                                    <dt class="col-sm-3">Golongan/Pangkat</dt>
                                    <dd class="col-sm-9">: <?= $d['nm_golongan'] . ' - ' . $d['pangkat'] ?></dd>
                                <?php } ?>
                                <dt class="col-sm-3">Jabatan</dt>
                                <dd class="col-sm-9">: <?= $d['nm_jabatan'] ?></dd>
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
                                <dt class="col-sm-3">No. HP</dt>
                                <dd class="col-sm-9">: <?= $d['hp'] ?></dd>
                                <dt class="col-sm-3">TMT</dt>
                                <dd class="col-sm-9">: <?= tgl($d['tmt']) ?></dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->