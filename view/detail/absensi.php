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
                <h5 class="modal-title" id="custom-width-modalLabel"><i class="bi bi-calendar-check me-2"></i>Detail Data Absensi Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $q = $con->query("SELECT * FROM jadwal a LEFT JOIN kelas_siswa b ON a.id_kelas_siswa = b.id_kelas_siswa LEFT JOIN kelas c ON b.id_kelas = c.id_kelas LEFT JOIN gadik_mapel d ON a.id_gadik_mapel = d.id_gadik_mapel LEFT JOIN mapel e ON d.id_mapel = e.id_mapel LEFT JOIN asuhan f ON a.id_asuhan = f.id_asuhan LEFT JOIN gadik h ON d.id_gadik = h.id_gadik WHERE a.id_jadwal = '$id' ");
            $d = $q->fetch_array();
            ?>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="card-body text-start">
                        <dl class="row">
                            <dt class="col-sm-3">Tahun Asuhan</dt>
                            <dd class="col-sm-9">: Tahun <?= $d['tahun'] . ' ' . $d['gelombang'] ?></dd>
                            <dt class="col-sm-3">Kelas</dt>
                            <dd class="col-sm-9">: <?= $d['nm_kelas'] ?></dd>
                            <dt class="col-sm-3">Mata Pelajaran</dt>
                            <dd class="col-sm-9">: <?= $d['kd_mapel'] . ' - ' . $d['nm_mapel'] ?></dd>
                            <dt class="col-sm-3">Tenaga Pendidik</dt>
                            <dd class="col-sm-9">: NRP/NIP <?= $d['nrp_nip'] . ' | ' . $d['nm_gadik'] ?></dd>
                        </dl>

                        <?php
                        $cekAbsen = $con->query("SELECT * FROM absensi WHERE id_jadwal = '$id' GROUP BY tgl_absensi ORDER BY tgl_absensi DESC ");

                        foreach ($cekAbsen as $ca) { ?>
                            <div class="accordion" id="accordionPanelsStayOpenExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#abensi<?= $ca['tgl_absensi'] ?>" aria-expanded="false" aria-controls="abensi<?= $ca['tgl_absensi'] ?>">
                                            <i class="bi bi-calendar-check me-2"></i><?= tgl($ca['tgl_absensi']) ?>
                                        </button>
                                    </h2>
                                    <div id="abensi<?= $ca['tgl_absensi'] ?>" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne">
                                        <div class="accordion-body">
                                            <div class="table-responsive">
                                                <table id="tbl" class="table table-striped table-bordered">
                                                    <thead class="bg-danger">
                                                        <tr align="center">
                                                            <th>No</th>
                                                            <th>Siswa</th>
                                                            <th>NOSIS</th>
                                                            <th>Hadir</th>
                                                            <th>Izin</th>
                                                            <th>Sakit</th>
                                                            <th>Alpa</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>

                                                        <?php
                                                        $no1 = 1;

                                                        $data1 = mysqli_query($con, "SELECT * FROM absensi a LEFT JOIN siswa b ON a.id_siswa = b.id_siswa WHERE id_jadwal = '$id' AND tgl_absensi = '$ca[tgl_absensi]' ");
                                                        while ($tampil1 = mysqli_fetch_array($data1)) {
                                                        ?>
                                                            <tr>
                                                                <td align="center" width="5%"><?= $no1++; ?></td>
                                                                <td><?= $tampil1['nm_siswa'] ?></td>
                                                                <td align="center"><?= $tampil1['nrp'] ?></td>
                                                                <td align="center">
                                                                    <div id="checkHadir" style="pointer-events: none;">
                                                                        <?php if ($tampil1['sts'] == 'Hadir') {  ?>
                                                                            <input type="checkbox" checked id="checkItem" value="Hadir" name="sts[]" onclick="handleCheckboxChange(this)">
                                                                        <?php } else { ?>
                                                                            <input type="checkbox" id="checkItem" value="Hadir" name="sts[]" onclick="handleCheckboxChange(this)">
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                                <td align="center">
                                                                    <div id="checkIzin" style="pointer-events: none;">
                                                                        <?php if ($tampil1['sts'] == 'Izin') {  ?>
                                                                            <input type="checkbox" checked id="checkItem" value="Izin" name="sts[]" onclick="handleCheckboxChange(this)">
                                                                        <?php } else { ?>
                                                                            <input type="checkbox" id="checkItem" value="Izin" name="sts[]" onclick="handleCheckboxChange(this)">
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                                <td align="center">
                                                                    <div id="checkSakit" style="pointer-events: none;">
                                                                        <?php if ($tampil1['sts'] == 'Sakit') {  ?>
                                                                            <input type="checkbox" checked id="checkItem" value="Sakit" name="sts[]" onclick="handleCheckboxChange(this)">
                                                                        <?php } else { ?>
                                                                            <input type="checkbox" id="checkItem" value="Sakit" name="sts[]" onclick="handleCheckboxChange(this)">
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                                <td align="center">
                                                                    <div id="checkAlpa" style="pointer-events: none;">
                                                                        <?php if ($tampil1['sts'] == 'Alpa') {  ?>
                                                                            <input type="checkbox" checked id="checkItem" value="Alpa" name="sts[]" onclick="handleCheckboxChange(this)">
                                                                        <?php } else { ?>
                                                                            <input type="checkbox" id="checkItem" value="Alpa" name="sts[]" onclick="handleCheckboxChange(this)">
                                                                        <?php } ?>
                                                                    </div>
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
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->