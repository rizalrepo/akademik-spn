<?php
require '../../../app/configtables.php';
$con = mysqli_connect($con['host'], $con['user'], $con['pass'], $con['db']);
if (mysqli_connect_errno()) {
    echo mysqli_connect_error();
}

$maxAlpa = $con->query("SELECT jumlah FROM alpa WHERE id = 1")->fetch_assoc();
?>
<div id="id<?= $id = $row[0]; ?>" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="custom-width-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="custom-width-modalLabel"><i class="bi bi-building-check me-2"></i>Detail Data Kelas Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $q = $con->query("SELECT * FROM kelas_siswa a LEFT JOIN kelas b ON a.id_kelas = b.id_kelas LEFT JOIN asuhan c ON a.id_asuhan = c.id_asuhan WHERE id_kelas_siswa = '$id' ");
            $d = $q->fetch_array();
            ?>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="card-body text-start">
                        <dl class="row">
                            <dt class="col-sm-3">Ruang Kelas</dt>
                            <dd class="col-sm-9">: <?= $d['nm_kelas'] ?></dd>
                            <dt class="col-sm-3">Tahun Asuhan</dt>
                            <dd class="col-sm-9">: <?= $d['tahun'] . ' ' . $d['gelombang'] ?></dd>
                            <dt class="col-sm-3">Jumlah Siswa</dt>
                            <dd class="col-sm-9">:
                                <?php
                                $jml = $con->query("SELECT COUNT(*) AS total FROM kelas_siswa_detail WHERE kode = '$d[kode]'")->fetch_array();
                                if ($jml['total']) {
                                    echo $jml['total'] . ' Orang';
                                } else {
                                    echo 'Belum ada Siswa';
                                }
                                ?>
                            </dd>
                        </dl>

                        <table id="tbl" class="table table-striped table-bordered">
                            <thead class="bg-danger">
                                <tr align="center">
                                    <th>No</th>
                                    <th>Nama Siswa</th>
                                    <th>NOSIS</th>
                                    <th>Ket</th>
                                    <th>Wali</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $no1 = 1;
                                $data1 = mysqli_query($con, "SELECT * FROM kelas_siswa_detail a LEFT JOIN kelas_siswa b ON a.kode = b.kode LEFT JOIN siswa c ON a.id_siswa = c.id_siswa WHERE a.kode = '$d[kode]' ");
                                while ($tampil1 = mysqli_fetch_array($data1)) {
                                ?>
                                    <tr>
                                        <td align="center"><?= $no1++; ?></td>
                                        <td><?= $tampil1['nm_siswa'] ?></td>
                                        <td align="center"><?= $tampil1['nrp'] ?></td>
                                        <td align="center">
                                            <?php
                                            $alpa = $con->query("SELECT COUNT(*) AS total FROM absensi a LEFT JOIN jadwal b ON a.id_jadwal = b.id_jadwal WHERE a.id_siswa = $tampil1[id_siswa] AND sts = 'Alpa' AND b.id_asuhan = '$d[id_asuhan]'")->fetch_array();
                                            if ($alpa['total'] > $maxAlpa['jumlah']) {
                                                echo 'Tidak Lulus';
                                            } else {
                                                echo '-';
                                            }
                                            ?>
                                        </td>
                                        <td><?= $tampil1['nm_wali'] ?></td>
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