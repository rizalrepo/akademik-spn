<?php
require '../../../app/config.php';
$page = 'konseling';
include_once '../../layout/topbar.php';

$log = $con->query("SELECT * FROM user WHERE id_user = '$_SESSION[id_user]' ")->fetch_array();
$user = $log['id_gadik'];
?>

<div class="page-content">
    <div class="row">

        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18"><i class="fas fa-comments me-2"></i>Tambah Data Konseling</h4>

                <div class="page-title-right">
                    <a href="index" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left me-2"></i>Kembali</a>
                </div>
            </div>
            <div class="card card-body border border-danger mb-5">
                <form class="form-horizontal needs-validation" novalidate method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Tahun Asuhan</label>
                        <div class="col-sm-10">
                            <select name="id_asuhan" class="form-select select2" style="width: 100%;" required>
                                <option value="">-- Pilih --</option>
                                <?php $data = $con->query("SELECT * FROM asuhan ORDER BY id_asuhan DESC"); ?>
                                <?php foreach ($data as $row) : ?>
                                    <option value="<?= $row['id_asuhan'] ?>">Tahun <?= $row['tahun'] . ' ' . $row['gelombang'] ?></option>
                                <?php endforeach ?>
                            </select>
                            <div class="invalid-feedback">Kolom harus di pilih !</div>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Nama Siswa</label>
                        <div class="col-sm-10">
                            <select name="id_siswa" class="form-select select2" style="width: 100%;" required>
                                <option value="">-- Pilih --</option>
                                <?php $data = $con->query("SELECT * FROM siswa ORDER BY id_siswa DESC"); ?>
                                <?php foreach ($data as $row) : ?>
                                    <option value="<?= $row['id_siswa'] ?>">NOSIS <?= $row['nrp'] . ' | ' . $row['nm_siswa'] ?></option>
                                <?php endforeach ?>
                            </select>
                            <div class="invalid-feedback">Kolom harus di pilih !</div>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Topik Konseling</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="topik" required>
                            <div class="invalid-feedback">Kolom harus di isi !</div>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Hasil Konseling</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="hasil" required></textarea>
                            <div class="invalid-feedback">Kolom harus di isi !</div>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Tanggal Konseling</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="tgl_konseling" required>
                            <div class="invalid-feedback">Kolom harus di isi !</div>
                        </div>
                    </div>
                    <div class="form-group row mt-4 text-end">
                        <div class="col-sm-12">
                            <button type="reset" class="btn btn-sm btn-danger float-right mr-2"><i class="fa fa-times-circle"></i> Batal</button>
                            <button type="submit" name="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Simpan</button>
                        </div>
                    </div>
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
<?php
if (isset($_POST['submit'])) {
    $id_asuhan = $_POST['id_asuhan'];
    $id_siswa = $_POST['id_siswa'];
    $topik = $_POST['topik'];
    $hasil = $_POST['hasil'];
    $tgl_konseling = $_POST['tgl_konseling'];

    $tambah = $con->query("INSERT INTO konseling VALUES (
        default, 
        '$id_asuhan', 
        '$id_siswa',
        '$topik',
        '$hasil',
        '$user',
        '$tgl_konseling'
    )");

    if ($tambah) {
        $_SESSION['pesan'] = "Data Berhasil di Simpan";
        echo "<meta http-equiv='refresh' content='0; url=index'>";
    } else {
        echo "Data anda gagal disimpan. Ulangi sekali lagi";
        echo "<meta http-equiv='refresh' content='0; url=tambah'>";
    }
}

?>