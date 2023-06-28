<?php
require '../../../app/config.php';
$page = 'pegawai';
include_once '../../layout/topbar.php';

$jk2 = [
    '' => '-- Pilih --',
    'Laki-laki' => 'Laki-laki',
    'Perempuan' => 'Perempuan',
];
?>

<div class="page-content">
    <div class="row">

        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18"><i class="fas fa-id-badge me-2"></i>Tambah Data Pegawai</h4>

                <div class="page-title-right">
                    <a href="index" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left me-2"></i>Kembali</a>
                </div>
            </div>
            <div class="card card-body border border-danger mb-5">
                <form class="form-horizontal needs-validation" novalidate method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Nama Lengkap</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nm_pegawai" required>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Nomor Induk KTP</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="nik" required>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                            <select class="form-select" id="sts" name="status" required>
                                <option selected value="">-- Pilih --</option>
                                <option value="PNS">PNS</option>
                                <option value="Honorer">Honorer</option>
                            </select>
                            <div class="invalid-feedback">Kolom harus di pilih !</div>
                        </div>
                    </div>
                    <div class="form-group row mb-3" id="nip" hidden>
                        <label class="col-sm-2 col-form-label">NIP</label>
                        <div class="col-sm-10">
                            <input type="number" id="nip2" class="form-control" name="nip">
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>
                    <div class="form-group row mb-3" id="gol" hidden>
                        <label class="col-sm-2 col-form-label">Golongan</label>
                        <div class="col-sm-10">
                            <select name="id_golongan" id="gol2" class="form-control select2" style="width: 100%;">
                                <option value="">-- Pilih --</option>
                                <?php $data = $con->query("SELECT * FROM golongan ORDER BY id_golongan DESC"); ?>
                                <?php foreach ($data as $row) : ?>
                                    <option value="<?= $row['id_golongan'] ?>"><?= $row['nm_golongan'] . ' - ' . $row['pangkat'] ?></option>
                                <?php endforeach ?>
                            </select>
                            <div class="invalid-feedback">Kolom harus di pilih !</div>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Jabatan</label>
                        <div class="col-sm-10">
                            <select name="id_jabatan" class="form-control select2" style="width: 100%;">
                                <option value="">-- Pilih --</option>
                                <?php $data = $con->query("SELECT * FROM jabatan ORDER BY id_jabatan DESC"); ?>
                                <?php foreach ($data as $row) : ?>
                                    <option value="<?= $row['id_jabatan'] ?>"><?= $row['nm_jabatan'] ?></option>
                                <?php endforeach ?>
                            </select>
                            <div class="invalid-feedback">Kolom harus di pilih !</div>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Tempat Lahir</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="tmpt_lahir" required>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="tgl_lahir" required>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <?= form_dropdown('jk', $jk2, '', 'class="form-control" required') ?>
                            <div class="invalid-feedback">Kolom harus di pilih !</div>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Agama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="agama" required>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <textarea name="alamat" class="form-control" required></textarea>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">No. HP</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="hp" required>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">TMT</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="tmt" required>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
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

<script type='text/javascript'>
    $(document).ready(function() {
        $("#sts").change(function() {
            if ($("#sts option:selected").val() == 'PNS') {
                $('#gol').prop('hidden', false);
                $('#nip').prop('hidden', false);
                $('#gol2').attr('required', true);
                $('#nip2').attr('required', true);
            } else {
                $('#gol').prop('hidden', true);
                $('#nip').prop('hidden', true);
                $('#gol2').removeAttr('required');
                $('#nip2').removeAttr('required');
            }
        });
    });
</script>

<?php
if (isset($_POST['submit'])) {
    $nm_pegawai = $_POST['nm_pegawai'];
    $nik = $_POST['nik'];
    $status = $_POST['status'];
    $nip = $_POST['nip'];
    $id_golongan = $_POST['id_golongan'];
    $id_jabatan = $_POST['id_jabatan'];
    $tmpt_lahir = $_POST['tmpt_lahir'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $tmpt_lahir = $_POST['tmpt_lahir'];
    $jk = $_POST['jk'];
    $agama = $_POST['agama'];
    $alamat = $_POST['alamat'];
    $hp = $_POST['hp'];
    $tmt = $_POST['tmt'];

    $tambah = $con->query("INSERT INTO pegawai VALUES (
        default, 
        '$nm_pegawai', 
        '$nik', 
        '$status', 
        '$nip', 
        '$id_golongan',
        '$id_jabatan',
        '$tmpt_lahir',
        '$tgl_lahir',
        '$jk',
        '$agama',
        '$alamat',
        '$hp',
        '$tmt'
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