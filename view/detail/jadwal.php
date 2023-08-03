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
                <h5 class="modal-title" id="custom-width-modalLabel"><i class="bi bi-list-check me-2"></i>Detail Data Jadwal Mengajar Gadik</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $q = $con->query("SELECT * FROM gadik_mapel a JOIN gadik b ON a.id_gadik = b.id_gadik JOIN pangkat c ON b.id_pangkat = c.id_pangkat JOIN jabatan d ON b.id_jabatan = d.id_jabatan JOIN mapel e ON a.id_mapel = e.id_mapel JOIN asuhan f ON a.id_asuhan = f.id_asuhan WHERE a.id_gadik_mapel = '$id' ");
            $d = $q->fetch_array();
            ?>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="card-body text-start">
                        <dl class="row">
                            <dt class="col-sm-3">Nama Tenaga Pendidik</dt>
                            <dd class="col-sm-9">: <?= $d['nm_gadik'] ?></dd>
                            <dt class="col-sm-3">NRP / NIP</dt>
                            <dd class="col-sm-9">: <?= $d['nrp_nip'] ?></dd>
                            <dt class="col-sm-3">Pangkat</dt>
                            <dd class="col-sm-9">: <?= $d['nm_pangkat'] ?></dd>
                            <dt class="col-sm-3">Jabatan</dt>
                            <dd class="col-sm-9">: <?= $d['nm_jabatan'] ?></dd>
                            <dt class="col-sm-3">Mata Pelajaran</dt>
                            <dd class="col-sm-9">: <?= $d['kd_mapel'] . ' - ' . $d['nm_mapel'] ?></dd>
                            <dt class="col-sm-3">Tahun Asuhan</dt>
                            <dd class="col-sm-9">: Tahun <?= $d['tahun'] . ' ' . $d['gelombang'] ?></dd>
                        </dl>

                        <table id="tbl" class="table table-striped table-bordered">
                            <thead class="bg-danger">
                                <tr align="center">
                                    <th>No</th>
                                    <th>Ruang Kelas</th>
                                    <th>Hari</th>
                                    <th>Jam Mulai</th>
                                    <th>Jam Selesai</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $no1 = 1;
                                $data1 = mysqli_query($con, "SELECT * FROM jadwal a LEFT JOIN kelas_siswa b ON a.id_kelas_siswa = b.id_kelas_siswa LEFT JOIN kelas c ON b.id_kelas = c.id_kelas WHERE a.id_gadik_mapel = '$id' ORDER BY id_jadwal ASC ");
                                while ($tampil1 = mysqli_fetch_array($data1)) {
                                ?>
                                    <tr>
                                        <td align="center"><?= $no1++; ?></td>
                                        <td align="center"><?= $tampil1['nm_kelas'] ?></td>
                                        <td align="center"><?= $tampil1['hari'] ?></td>
                                        <td align="center"><?= $tampil1['jam_mulai'] ?></td>
                                        <td align="center"><?= $tampil1['jam_selesai'] ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->