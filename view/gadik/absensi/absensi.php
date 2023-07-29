<?php
require '../../../app/config.php';
$page = 'jadwal';
include_once '../../layout/topbar.php';

$id = $_GET['id'];
$query = $con->query("SELECT * FROM jadwal a LEFT JOIN kelas_siswa b ON a.id_kelas_siswa = b.id_kelas_siswa LEFT JOIN kelas c ON b.id_kelas = c.id_kelas LEFT JOIN gadik_mapel d ON a.id_gadik_mapel = d.id_gadik_mapel LEFT JOIN mapel e ON d.id_mapel = e.id_mapel WHERE a.id_jadwal ='$id'");
$row = $query->fetch_array();
$dt = $_GET['ta'];
$title = $con->query("SELECT * FROM asuhan WHERE id_asuhan = '$dt'")->fetch_array();

$today = date('Y-m-d');
?>

<div class="page-content">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18"><i class="bi bi-calendar-check me-2"></i>Data Absensi Siswa Tahun <?= $title['tahun'] . ' ' . $title['gelombang'] ?></h4>

                <div class="page-title-right">
                    <a href="data?ta=<?= $dt ?>" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left me-2"></i>Kembali</a>
                </div>
            </div>
            <div class="card card-body border border-dark-danger">
                <form class="form-horizontal needs-validation" novalidate method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Kelas</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control bg-light" value="<?= $row['nm_kelas'] ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Mata Pelajaran</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control bg-light" value="<?= $row['kd_mapel'] . ' - ' . $row['nm_mapel'] ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Jadwal</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control bg-light" value="<?= $row['hari'] ?> (<?= $row['jam_mulai'] . ' - ' . $row['jam_selesai'] ?>)" readonly>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Tanggal</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control bg-light" value="<?= tgl(date('Y-m-d')) ?>" readonly>
                        </div>
                    </div>

                    <?php
                    $cek = $con->query("SELECT * FROM absensi WHERE id_jadwal = '$id' AND tgl_absensi = '$today'")->fetch_array();
                    if (!$cek && hari(date('D')) == $row['hari']) { ?>
                        <hr>
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

                                $data1 = mysqli_query($con, "SELECT * FROM kelas_siswa_detail a LEFT JOIN kelas_siswa b ON a.kode = b.kode LEFT JOIN siswa c ON a.id_siswa = c.id_siswa WHERE a.kode = '$row[kode]' ");
                                while ($tampil1 = mysqli_fetch_array($data1)) {
                                ?>
                                    <tr>
                                        <td align="center" width="5%"><?= $no1++; ?></td>
                                        <td><?= $tampil1['nm_siswa'] ?></td>
                                        <td align="center"><?= $tampil1['nrp'] ?></td>
                                        <td align="center">
                                            <div id="checkHadir">
                                                <input type="hidden" name="id_siswa[]" value="<?= $tampil1['id_siswa'] ?>">
                                                <input type="checkbox" id="checkItem" value="Hadir" name="sts[]" onclick="handleCheckboxChange(this)">
                                            </div>
                                        </td>
                                        <td align="center">
                                            <div id="checkIzin">
                                                <input type="checkbox" id="checkItem" value="Izin" name="sts[]" onclick="handleCheckboxChange(this)">
                                            </div>
                                        </td>
                                        <td align="center">
                                            <div id="checkSakit">
                                                <input type="checkbox" id="checkItem" value="Sakit" name="sts[]" onclick="handleCheckboxChange(this)">
                                            </div>
                                        </td>
                                        <td align="center">
                                            <div id="checkAlpa">
                                                <input type="checkbox" id="checkItem" value="Alpa" name="sts[]" onclick="handleCheckboxChange(this)">
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <div class="d-grid">
                            <button type="submit" name="submit" class="btn btn-primary fw-bold"><i class="fas fa-check-circle me-2"></i>Simpan Absensi</button>
                        </div>
                    <?php } ?>
                </form>
            </div>

            <div class="card card-body border border-dark-danger mt-3">
                <?php if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') { ?>
                    <div id="notif" class="alert alert-success d-flex align-items-center" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        <div>
                            <b><?= $_SESSION['pesan'] ?></b>
                        </div>
                    </div>
                <?php $_SESSION['pesan'] = '';
                } ?>
                <form class="form-horizontal needs-validation" novalidate method="POST" action="" enctype="multipart/form-data">
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
                                                            <div id="checkHadir">
                                                                <input type="hidden" name="tgl_absensi" value="<?= $tampil1['tgl_absensi'] ?>">
                                                                <?php if ($tampil1['sts'] == 'Hadir') {  ?>
                                                                    <input type="checkbox" checked id="checkItem" value="Hadir" name="sts[]" onclick="handleCheckboxChange(this)">
                                                                <?php } else { ?>
                                                                    <input type="checkbox" id="checkItem" value="Hadir" name="sts[]" onclick="handleCheckboxChange(this)">
                                                                <?php } ?>
                                                            </div>
                                                        </td>
                                                        <td align="center">
                                                            <div id="checkIzin">
                                                                <?php if ($tampil1['sts'] == 'Izin') {  ?>
                                                                    <input type="checkbox" checked id="checkItem" value="Izin" name="sts[]" onclick="handleCheckboxChange(this)">
                                                                <?php } else { ?>
                                                                    <input type="checkbox" id="checkItem" value="Izin" name="sts[]" onclick="handleCheckboxChange(this)">
                                                                <?php } ?>
                                                            </div>
                                                        </td>
                                                        <td align="center">
                                                            <?php if ($tampil1['sts'] == 'Sakit') {  ?>
                                                                <input type="checkbox" checked id="checkItem" value="Sakit" name="sts[]" onclick="handleCheckboxChange(this)">
                                                            <?php } else { ?>
                                                                <input type="checkbox" id="checkItem" value="Sakit" name="sts[]" onclick="handleCheckboxChange(this)">
                                                            <?php } ?>
                                                        </td>
                                                        <td align="center">
                                                            <div id="checkAlpa">
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
                                        <div class="d-grid">
                                            <button type="submit" name="update" class="btn btn-primary fw-bold"><i class="fas fa-check-circle me-2"></i>Update Absensi</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>
    <!-- row  -->
</div>


<?php
include_once '../../layout/footer.php';
?>
<script src="<?= base_url() ?>/app/js/app.js"></script>
<script>
    function handleCheckboxChange(checkbox) {
        // Mendapatkan semua checkbox dengan nama yang sama
        const checkboxes = document.querySelectorAll('input[name="sts[]"]');

        // Cek apakah checkbox tersebut sudah dicek atau belum
        if (checkbox.checked) {
            // Jika checkbox tersebut sudah dicek, maka uncheck semua checkbox lainnya
            checkboxes.forEach((cb) => {
                if (cb !== checkbox) {
                    cb.checked = false;
                }
            });
        } else {
            // Jika checkbox tersebut belum dicek, maka tetap biarkan
            checkbox.checked = true;
        }
    }
</script>

<?php
if (isset($_POST['submit'])) {
    foreach ($_POST['sts'] as $sts) {
        foreach ($_POST['id_siswa'] as $idSiswa) {
            $tambah = $con->query("INSERT INTO absensi VALUES (
                    default,
                    '$id', 
                    '$today', 
                    '$idSiswa',
                    '$sts'
                )");
        }
    }

    $_SESSION['pesan'] = "Data Absensi Siswa Berhasil di Simpan";
    echo "<meta http-equiv='refresh' content='0; url=absensi?id=$id&ta=$dt'>";
}

if (isset($_POST['update'])) {
    foreach ($_POST['sts'] as $sts) {
        $update = $con->query("UPDATE absensi SET 
            sts = '$sts'
            WHERE tgl_absensi = '$_POST[tgl_absensi]'
        ");
    }

    $_SESSION['pesan'] = "Data Absensi Siswa Berhasil di Update";
    echo "<meta http-equiv='refresh' content='0; url=absensi?id=$id&ta=$dt'>";
}

?>