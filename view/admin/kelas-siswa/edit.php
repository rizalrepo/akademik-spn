<?php
require '../../../app/config.php';
$page = 'kelas_siswa';
include_once '../../layout/topbar.php';

$id = $_GET['id'];
$dt = $_GET['ta'];
$query = $con->query("SELECT * FROM kelas_siswa WHERE id_kelas_siswa ='$id'");
$row = $query->fetch_array();
?>

<div class="page-content">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18"><i class="bi bi-building-check me-2"></i>Edit Data Kelas Siswa</h4>

                <div class="page-title-right">
                    <a href="data?ta=<?= $dt ?>" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left me-2"></i>Kembali</a>
                </div>
            </div>
            <div class="card card-body border border-dark-danger">
                <form class="form-horizontal needs-validation" novalidate method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Ruang Kelas</label>
                        <div class="col-sm-10">
                            <select name="id_kelas" class="form-select select2" style="width: 100%;" required>
                                <?php $data = $con->query("SELECT * FROM kelas ORDER BY id_kelas ASC"); ?>
                                <?php foreach ($data as $d) :
                                    if ($d['id_kelas'] == $row['id_kelas']) { ?>
                                        <option value="<?= $d['id_kelas']; ?>" selected="<?= $d['id_kelas']; ?>"><?= $d['nm_kelas'] ?></option>
                                    <?php } else { ?>
                                        <option value="<?= $d['id_kelas'] ?>"><?= $d['nm_kelas'] ?></option>
                                <?php }
                                endforeach ?>
                            </select>
                            <div class="invalid-feedback">Kolom harus di pilih !</div>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Tahun Asuhan</label>
                        <div class="col-sm-10">
                            <select name="id_asuhan" class="form-select select2" style="width: 100%;" required>
                                <?php $data = $con->query("SELECT * FROM asuhan ORDER BY id_asuhan DESC"); ?>
                                <?php foreach ($data as $d) :
                                    if ($d['id_asuhan'] == $row['id_asuhan']) { ?>
                                        <option value="<?= $d['id_asuhan']; ?>" selected="<?= $d['id_asuhan']; ?>">Tahun <?= $d['tahun'] ?> <?= $d['gelombang'] ?></option>
                                    <?php } else { ?>
                                        <option value="<?= $d['id_asuhan'] ?>">Tahun <?= $d['tahun'] ?> <?= $d['gelombang'] ?></option>
                                <?php }
                                endforeach ?>
                            </select>
                            <div class="invalid-feedback">Kolom harus di pilih !</div>
                        </div>
                    </div>
                    <hr>
                    <span id="btn-tambah" data-bs-toggle="modal" data-bs-target="#modal-tambah" class="btn btn-sm btn-info mb-2"><i class="bi bi-person-lines-fill me-2"></i>Tambah Siswa</span>
                    <input type="hidden" id="dataid" value="<?= $row['kode']; ?>">
                    <div id="data-siswa">

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

<div class="modal fade" id="modal-tambah" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="custom-width-modalLabel"><i class="bi bi-person-lines-fill me-2"></i>Tambah Data Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal needs-validation" novalidate id="form-tambah" method="POST" enctype="multipart/form-data" action="detail/simpan.php">
                    <div class="card-body">
                        <input type="hidden" name="kode" value="<?= $row['kode'] ?>">
                        <input type="text" id="asuhanVal" name="asuhanVal" hidden>
                        <div class="form-group row mb-3">
                            <label class="col-sm-2 col-form-label">Nama Siswa</label>
                            <div class="col-sm-10">
                                <select name="id_siswa" id="id_siswa" class="form-select" style="width: 100%;" required>
                                    <option value="">-- Pilih --</option>
                                    <?php $data = $con->query("SELECT * FROM siswa ORDER BY id_siswa DESC"); ?>
                                    <?php foreach ($data as $row) : ?>
                                        <option value="<?= $row['id_siswa'] ?>">NRP. <?= $row['nrp'] ?> | <?= $row['nm_siswa'] ?></option>
                                    <?php endforeach ?>
                                </select>
                                <div class="invalid-feedback">Kolom harus di pilih !</div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="reset" class="btn btn-sm btn-danger float-right mr-2"><i class="fas fa-times-circle me-1"></i>Batal</button>
                            <button type="submit" name="submit" class="btn btn-sm btn-primary"><i class="fas fa-save me-1"></i>Simpan</button>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>

<?php
include_once '../../layout/footer.php';
?>
<script src="<?= base_url() ?>/app/js/app.js"></script>
<script>
    $(document).on('change', '#id_asuhan', function() {
        $('#asuhanVal').val($(this).val());
    });

    if ($('#id_asuhan').val() == '') {
        $('#btn-tambah').hide();
    } else {
        $('#btn-tambah').show();
    }

    $("#id_asuhan").change(function() {
        $('#btn-tambah').show();
    });

    muncul();
    var data = "detail/tampil.php";

    function muncul() {
        $.post('detail/tampil.php', {
                id: $("#dataid").val()
            },
            function(data) {
                $("#data-siswa").html(data);
            }
        );
    }

    $("#form-tambah").submit(function(e) {
        e.preventDefault();

        var dataform = $("#form-tambah").serialize();
        $.ajax({
            url: "detail/simpan.php",
            type: "POST",
            data: dataform,
            success: function(result) {
                var hasil = JSON.parse(result);
                if (hasil.hasil == "sukses") {
                    $('#modal-tambah').modal('hide');
                    $('#id_siswa').val(null).trigger('change');
                    $('.invalid-feedback').css('display', 'set');
                    muncul();
                } else if (hasil.hasil == 'duplikat') {
                    Swal.fire({
                        title: 'Gagal !',
                        text: 'Data siswa sudah Ada !',
                        icon: 'error'
                    });
                } else if (hasil.hasil == 'duplikat_ta') {
                    Swal.fire({
                        title: 'Gagal !',
                        html: 'Data siswa sudah Ada di <br><b>Tahun Asuhan ' + hasil.asuhan + '</b> !',
                        icon: 'error'
                    });
                }
            }
        });
    });

    $(document).on('click', '#hapus', function(e) {
        e.preventDefault();
        $.post('detail/hapus.php', {
                id: $(this).attr('data-id')
            },
            function(html) {
                muncul();
            }
        );
    });

    $(document).ready(function() {
        $('#id_siswa').select2({
            dropdownParent: $('#modal-tambah')
        });
    });
</script>
<?php
if (isset($_POST['submit'])) {
    $id_kelas = $_POST['id_kelas'];
    $id_asuhan = $_POST['id_asuhan'];

    $update = $con->query("UPDATE kelas_siswa SET 
        id_kelas = '$id_kelas',
        id_asuhan = '$id_asuhan'
        WHERE id_kelas_siswa = '$id'
    ");

    if ($update) {
        $_SESSION['pesan'] = "Data Berhasil di Update";
        echo "<meta http-equiv='refresh' content='0; url=data?ta=$id_asuhan'>";
    } else {
        echo "Data anda gagal diubah. Ulangi sekali lagi";
        echo "<meta http-equiv='refresh' content='0; url=edit?id=$id'>";
    }
}
?>