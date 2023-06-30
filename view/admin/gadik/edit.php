<?php
require '../../../app/config.php';
$page = 'gadik';
include_once '../../layout/topbar.php';

$id = $_GET['id'];
$query = $con->query("SELECT * FROM gadik WHERE id_gadik ='$id'");
$row = $query->fetch_array();

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
                <h4 class="page-title mb-0 font-size-18"><i class="fas fa-id-badge me-2"></i>Edit Data Gadik</h4>

                <div class="page-title-right">
                    <a href="index" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left me-2"></i>Kembali</a>
                </div>
            </div>
            <div class="card card-body border border-dark-danger">
                <form class="form-horizontal needs-validation" novalidate method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Nama Lengkap</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nm_gadik" value="<?= $row['nm_gadik'] ?>" required>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">NRP / NIP</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nrp_nip" value="<?= $row['nrp_nip'] ?>" required>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Pangkat</label>
                        <div class="col-sm-10">
                            <select name="id_pangkat" class="form-select select2" style="width: 100%;" required>
                                <?php $data = $con->query("SELECT * FROM pangkat ORDER BY id_pangkat ASC"); ?>
                                <?php foreach ($data as $d) :
                                    if ($d['id_pangkat'] == $row['id_pangkat']) { ?>
                                        <option value="<?= $d['id_pangkat']; ?>" selected="<?= $d['id_pangkat']; ?>"><?= $d['nm_pangkat'] ?></option>
                                    <?php } else { ?>
                                        <option value="<?= $d['id_pangkat'] ?>"><?= $d['nm_pangkat'] ?></option>
                                <?php }
                                endforeach ?>
                            </select>
                            <div class="invalid-feedback">Kolom harus di pilih !</div>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Jabatan</label>
                        <div class="col-sm-10">
                            <select name="id_jabatan" class="form-select select2" style="width: 100%;" required>
                                <?php $data = $con->query("SELECT * FROM jabatan ORDER BY id_jabatan ASC"); ?>
                                <?php foreach ($data as $d) :
                                    if ($d['id_jabatan'] == $row['id_jabatan']) { ?>
                                        <option value="<?= $d['id_jabatan']; ?>" selected="<?= $d['id_jabatan']; ?>"><?= $d['nm_jabatan'] ?></option>
                                    <?php } else { ?>
                                        <option value="<?= $d['id_jabatan'] ?>"><?= $d['nm_jabatan'] ?></option>
                                <?php }
                                endforeach ?>
                            </select>
                            <div class="invalid-feedback">Kolom harus di pilih !</div>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Tempat Lahir</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="tmpt_lahir" value="<?= $row['tmpt_lahir'] ?>" required>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="tgl_lahir" value="<?= $row['tgl_lahir'] ?>" required>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <?= form_dropdown('jk', $jk2, $row['jk'], 'class="form-select" required') ?>
                            <div class="invalid-feedback">Kolom harus di pilih !</div>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Agama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="agama" value="<?= $row['agama'] ?>" required>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <textarea name="alamat" class="form-control" required><?= $row['alamat'] ?></textarea>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">No. HP</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="hp" value="<?= $row['hp'] ?>" required>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">TMT</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="tmt" value="<?= $row['tmt'] ?>" required>
                            <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                        </div>
                    </div>
                    <div class="form-group row mt-4 text-end">
                        <div class="col-sm-12">
                            <button type="reset" class="btn btn-sm btn-danger float-right mr-2"><i class="fa fa-times-circle"></i> Batal</button>
                            <button type="submit" name="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Update</button>
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
    $nm_gadik = $_POST['nm_gadik'];
    $nrp_nip = $_POST['nrp_nip'];
    $id_pangkat = $_POST['id_pangkat'];
    $id_jabatan = $_POST['id_jabatan'];
    $tmpt_lahir = $_POST['tmpt_lahir'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $jk = $_POST['jk'];
    $agama = $_POST['agama'];
    $alamat = $_POST['alamat'];
    $hp = $_POST['hp'];
    $tmt = $_POST['tmt'];

    $update = $con->query("UPDATE gadik SET 
        nm_gadik = '$nm_gadik',
        nrp_nip = '$nrp_nip',
        id_pangkat = '$id_pangkat',
        id_jabatan = '$id_jabatan',
        tmpt_lahir = '$tmpt_lahir',
        tgl_lahir = '$tgl_lahir',
        jk = '$jk',
        agama = '$agama',
        alamat = '$alamat',
        hp = '$hp',
        tmt = '$tmt'
        WHERE id_gadik = '$id'
    ");

    if ($update) {
        $con->query("UPDATE user SET
            nm_user = '$nm_gadik',
            username = '$nrp_nip'
            WHERE id_gadik = '$id' 
        ");
        $_SESSION['pesan'] = "Data Berhasil di Update";
        echo "<meta http-equiv='refresh' content='0; url=index'>";
    } else {
        echo "Data anda gagal diubah. Ulangi sekali lagi";
        echo "<meta http-equiv='refresh' content='0; url=edit?id=$id'>";
    }
}
?>