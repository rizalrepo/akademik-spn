<?php
require '../../../app/config.php';
$page = 'kelas_siswa';
include_once '../../layout/topbar.php';
?>

<div class="page-content">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18"><i class="bi bi-building-check me-2"></i>Data Kelas Siswa</h4>
            </div>
            <div class="card card-body border border-danger">
                <form action="data" method="GET">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tahun Asuhan</label>
                        <div class="col-sm-10">
                            <select name="ta" class="form-select select2" style="width: 100%;" onchange="if(this.value != 0) { this.form.submit(); }" required>
                                <option value="">-- Pilih --</option>
                                <?php $data = $con->query("SELECT * FROM asuhan ORDER BY id_asuhan DESC"); ?>
                                <?php foreach ($data as $row) : ?>
                                    <option value="<?= $row['id_asuhan'] ?>">Tahun <?= $row['tahun'] ?> <?= $row['gelombang'] ?></option>
                                <?php endforeach ?>
                            </select>
                            <div class="invalid-feedback">Kolom harus di pilih !</div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- row  -->
</div>

<?php include_once '../../layout/footer.php'; ?>
<script src="<?= base_url() ?>/app/js/app.js"></script>