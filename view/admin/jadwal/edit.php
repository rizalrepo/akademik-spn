<?php
require '../../../app/config.php';
$page = 'jadwal';
include_once '../../layout/topbar.php';

$id = $_GET['id'];
$query = $con->query("SELECT * FROM gadik_mapel a JOIN gadik b ON a.id_gadik = b.id_gadik JOIN pangkat c ON b.id_pangkat = c.id_pangkat JOIN jabatan d ON b.id_jabatan = d.id_jabatan JOIN mapel e ON a.id_mapel = e.id_mapel JOIN asuhan f ON a.id_asuhan = f.id_asuhan WHERE a.id_gadik_mapel ='$id'");
$row = $query->fetch_array();
$dt = $_GET['ta'];
$title = $con->query("SELECT * FROM asuhan WHERE id_asuhan = '$dt'")->fetch_array();
?>

<div class="page-content">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18"><i class="fas fa-user-clock me-2"></i>Edit Data Jadwal Mengajar Gadik Tahun <?= $title['tahun'] . ' ' . $title['gelombang'] ?></h4>

                <div class="page-title-right">
                    <a href="data?ta=<?= $dt ?>" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left me-2"></i>Kembali</a>
                </div>
            </div>
            <div class="card card-body border border-dark-danger">
                <form class="form-horizontal needs-validation" novalidate method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Nama Gadik</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control bg-light" id="nrp_nip" value="<?= $row['nm_gadik'] ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">NRP / NIP</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control bg-light" id="nrp_nip" value="<?= $row['nrp_nip'] ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Pangkat & Jabatan</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control bg-light" id="nm_pangkat" value="<?= $row['nm_pangkat'] ?>" readonly>
                        </div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control bg-light" id="nm_jabatan" value="<?= $row['nm_jabatan'] ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Mata Pelajaran</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control bg-light" value="<?= $row['kd_mapel'] . ' - ' . $row['nm_mapel'] ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Tahun Asuhan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control bg-light" id="nm_jabatan" value="Tahun <?= $title['tahun'] . ' ' . $title['gelombang'] ?>" readonly>
                        </div>
                    </div>
                    <hr>
                    <span id="btn-tambah" data-bs-toggle="modal" data-bs-target="#modal-tambah" class="btn btn-sm btn-info mb-2"><i class="bi bi-list-check me-2"></i>Tambah Jadwal</span>
                    <input type="hidden" id="dataid" value="<?= $id; ?>">
                    <div id="data-jadwal">

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
                <h5 class="modal-title" id="custom-width-modalLabel"><i class="bi bi-list-check me-2"></i>Tambah Data Jadwal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal needs-validation" novalidate id="form-tambah" method="POST" enctype="multipart/form-data" action="detail/simpan.php">
                    <div class="card-body">
                        <input type="hidden" name="id_gadik_mapel" value="<?= $id ?>">
                        <input type="hidden" name="id_asuhan" value="<?= $dt ?>">
                        <div class="form-group row mb-3">
                            <label class="col-sm-2 col-form-label">Kelas Siswa</label>
                            <div class="col-sm-10">
                                <select name="id_kelas_siswa" id="id_kelas_siswa" class="form-select" style="width: 100%;" required>
                                    <option value="">-- Pilih --</option>
                                    <?php $data = $con->query("SELECT * FROM kelas_siswa a LEFT JOIN kelas b ON a.id_kelas = b.id_kelas WHERE a.id_asuhan = '$dt' ORDER BY a.id_kelas_siswa DESC"); ?>
                                    <?php foreach ($data as $row) : ?>
                                        <option value="<?= $row['id_kelas_siswa'] ?>"><?= $row['nm_kelas'] ?></option>
                                    <?php endforeach ?>
                                </select>
                                <div class="invalid-feedback">Kolom harus di pilih !</div>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-2 col-form-label">Hari</label>
                            <div class="col-sm-10">
                                <select name="hari" id="hari" class="form-select" style="width: 100%;" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jum`at">Jum`at</option>
                                    <option value="Sabtu">Sabtu</option>
                                </select>
                                <div class="invalid-feedback">Kolom harus di pilih !</div>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-2 col-form-label">Jam Mulai</label>
                            <div class="col-sm-10">
                                <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" required>
                                <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-2 col-form-label">Jam Selesai</label>
                            <div class="col-sm-10">
                                <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" required>
                                <div class="invalid-feedback">Kolom tidak boleh kosong !</div>
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
    muncul();
    var data = "detail/tampil.php";

    function muncul() {
        $.post('detail/tampil.php', {
                id: $("#dataid").val()
            },
            function(data) {
                $("#data-jadwal").html(data);
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
                    $('#id_kelas_siswa').val(null).trigger('change');
                    $('#hari').val(null).trigger('change');
                    $("#jam_mulai").val('');
                    $("#jam_selesai").val('');
                    $('.invalid-feedback').css('display', 'unset');
                    muncul();
                } else if (hasil.hasil == 'duplikat') {
                    Swal.fire({
                        title: 'Gagal !',
                        text: 'Data Jadwal sudah Ada !',
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
        $('#id_kelas_siswa').select2({
            dropdownParent: $('#modal-tambah')
        });
        $('#hari').select2({
            dropdownParent: $('#modal-tambah')
        });
    });
</script>