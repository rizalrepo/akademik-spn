<?php
require '../../../app/config.php';
$page = 'gadik_mapel';
include_once '../../layout/topbar.php';
$dt = $_GET['ta'];
$title = $con->query("SELECT * FROM asuhan WHERE id_asuhan = '$dt'")->fetch_array();
?>

<div class="page-content">
    <div class="row">

        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18"><i class="fas fa-address-book me-2"></i>Tambah Data Gadik Mapel Tahun <?= $title['tahun'] . ' ' . $title['gelombang'] ?></h4>

                <div class="page-title-right">
                    <a href="data?ta=<?= $dt ?>" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left me-2"></i>Kembali</a>
                </div>
            </div>
            <div class="card card-body border border-danger mb-5">
                <form class="form-horizontal needs-validation" novalidate method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Nama Gadik</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input type="text" class="form-control" hidden name="id_gadik" id="id_gadik" required>
                                <input type="text" class="form-control bg-light" id="nm_gadik" required readonly>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#modal_gadik" class="btn text-white btn-info btn-flat"><i class="fa fa-search"></i></button>
                                <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">NRP / NIP</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control bg-light" id="nrp_nip" readonly>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Pangkat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control bg-light" id="nm_pangkat" readonly>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Jabatan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control bg-light" id="nm_jabatan" readonly>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Tahun Asuhan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control bg-light" id="nm_jabatan" value="Tahun <?= $title['tahun'] . ' ' . $title['gelombang'] ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Mata Pelajaran</label>
                        <div class="col-sm-10">
                            <select name="id_mapel" class="form-select select2" style="width: 100%;" required>
                                <option value="">-- Pilih --</option>
                                <?php $data = $con->query("SELECT * FROM mapel ORDER BY id_mapel ASC"); ?>
                                <?php foreach ($data as $row) : ?>
                                    <option value="<?= $row['id_mapel'] ?>"><?= $row['kd_mapel'] . ' - ' . $row['nm_mapel'] ?></option>
                                <?php endforeach ?>
                            </select>
                            <div class="invalid-feedback">Kolom harus di pilih !</div>
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

<div class="modal fade" id="modal_gadik" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-id-badge me-1"></i>Pilih Gadik</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-hover table-striped dataTable">
                        <thead class="bg-primary">
                            <tr align="center">
                                <th>No</th>
                                <th>Nama Lengkap</th>
                                <th>NRP / NIP</th>
                                <th>Pangkat</th>
                                <th>Jabatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $no = 1;
                            $data = $con->query("SELECT * FROM gadik a JOIN pangkat b ON a.id_pangkat = b.id_pangkat JOIN jabatan c ON a.id_jabatan = c.id_jabatan ORDER BY a.id_gadik ASC");
                            while ($row = $data->fetch_array()) {
                            ?>
                                <tr>
                                    <td align="center" width="5%"><?= $no++ ?></td>
                                    <td><?= $row['nm_gadik'] ?></td>
                                    <td align="center"><?= $row['nrp_nip'] ?></td>
                                    <td align="center"><?= $row['nm_pangkat'] ?></td>
                                    <td align="center"><?= $row['nm_jabatan'] ?></td>
                                    <td align="center" width="18%">
                                        <button class="btn btn-xs btn-success" id="select" data-nm_gadik="<?= $row['nm_gadik'] ?>" data-id_gadik="<?= $row['id_gadik'] ?>" data-nrp_nip="<?= $row['nrp_nip']  ?>" data-nm_pangkat="<?= $row['nm_pangkat']  ?>" data-nm_jabatan="<?= $row['nm_jabatan'] ?>">
                                            <i class="fas fa-check-circle"></i> Pilih
                                        </button>
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


<?php
include_once '../../layout/footer.php';
?>
<script src="<?= base_url() ?>/app/js/app.js"></script>
<script>
    $(document).ready(function() {
        $(document).on('click', '#select', function() {
            var nm_gadik = $(this).data('nm_gadik');
            var id_gadik = $(this).data('id_gadik');
            var nrp_nip = $(this).data('nrp_nip');
            var nm_pangkat = $(this).data('nm_pangkat');
            var nm_jabatan = $(this).data('nm_jabatan');
            $('#nm_gadik').val(nm_gadik);
            $('#id_gadik').val(id_gadik);
            $('#nrp_nip').val(nrp_nip);
            $('#nm_pangkat').val(nm_pangkat);
            $('#nm_jabatan').val(nm_jabatan);
            $('#modal_gadik').modal('hide');
        });
    })
</script>
<?php
if (isset($_POST['submit'])) {
    $id_gadik = $_POST['id_gadik'];
    $id_mapel = $_POST['id_mapel'];

    $tambah = $con->query("INSERT INTO gadik_mapel VALUES (
        default, 
        '$id_gadik', 
        '$id_mapel',
        '$dt'
    )");

    if ($tambah) {
        $_SESSION['pesan'] = "Data Berhasil di Simpan";
        echo "<meta http-equiv='refresh' content='0; url=data?ta=$dt'>";
    } else {
        echo "Data anda gagal disimpan. Ulangi sekali lagi";
        echo "<meta http-equiv='refresh' content='0; url=tambah?ta=$dt'>";
    }
}

?>