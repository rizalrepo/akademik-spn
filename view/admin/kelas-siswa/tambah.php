<?php
require '../../../app/config.php';
$page = 'kelas_siswa';
include_once '../../layout/topbar.php';
$dt = $_GET['ta'];
$title = $con->query("SELECT * FROM asuhan WHERE id_asuhan = '$dt'")->fetch_array();

$query = mysqli_query($con, "SELECT max(kode) as kode FROM kelas_siswa");
$data = mysqli_fetch_array($query);
$kode = $data['kode'];

$urutan = (int) substr($kode, 5, 5);
$urutan++;
$huruf = "RK";
$kode = $huruf . sprintf("%05s", $urutan);
?>

<div class="page-content">
    <div class="row">

        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18"><i class="bi bi-building-check me-2"></i>Tambah Data Kelas Siswa Tahun <?= $title['tahun'] . ' ' . $title['gelombang'] ?></h4>

                <div class="page-title-right">
                    <a href="data?ta=<?= $dt ?>" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left me-2"></i>Kembali</a>
                </div>
            </div>
            <div class="card card-body border border-danger mb-5">
                <form class="form-horizontal needs-validation" novalidate method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Tahun Asuhan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control bg-light" value="Tahun <?= $title['tahun'] . ' ' . $title['gelombang'] ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Ruang Kelas</label>
                        <div class="col-sm-10">
                            <select name="id_kelas" class="form-select select2" style="width: 100%;" required>
                                <option value="">-- Pilih --</option>
                                <?php $data = $con->query("SELECT * FROM kelas ORDER BY id_kelas ASC"); ?>
                                <?php foreach ($data as $row) : ?>
                                    <option value="<?= $row['id_kelas'] ?>"><?= $row['nm_kelas'] ?></option>
                                <?php endforeach ?>
                            </select>
                            <div class="invalid-feedback">Kolom harus di pilih !</div>
                        </div>
                    </div>
                    <hr>
                    <span id="btn-tambah" data-bs-toggle="modal" data-bs-target="#modal-tambah" class="btn btn-sm btn-info mb-2"><i class="bi bi-person-lines-fill me-2"></i>Tambah Siswa</span>
                    <input type="hidden" id="dataid" value="<?= $kode; ?>">
                    <div id="data-siswa">

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
                        <input type="hidden" name="kode" value="<?= $kode ?>">
                        <input type="hidden" value="<?= $dt ?>" name="asuhanVal">
                        <div class="form-group row mb-3">
                            <label class="col-sm-2 col-form-label">Nama Siswa</label>
                            <div class="col-sm-10">
                                <select name="id_siswa" id="id_siswa" class="form-select" style="width: 100%;" required>
                                    <option value="">-- Pilih --</option>
                                    <?php $data = $con->query("SELECT * FROM siswa ORDER BY id_siswa DESC"); ?>
                                    <?php foreach ($data as $row) : ?>
                                        <option value="<?= $row['id_siswa'] ?>">NOSIS. <?= $row['nrp'] ?> | <?= $row['nm_siswa'] ?></option>
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
                        text: 'Data Siswa sudah Ada !',
                        icon: 'error'
                    });
                } else if (hasil.hasil == 'duplikat_ta') {
                    Swal.fire({
                        title: 'Gagal !',
                        html: 'Data Siswa sudah Ada di <br><b>Tahun Asuhan ' + hasil.asuhan + '</b> !',
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

    $cek = mysqli_num_rows(mysqli_query($con, "SELECT * FROM kelas_siswa WHERE id_kelas = '$id_kelas' AND id_asuhan = '$dt'"));
    if ($cek > 0) {
        echo "
        <script type='text/javascript'>
            Swal.fire({
                title: 'Gagal Menyimpan !',
                text:  'Data Kelas sudah ada !',
                icon: 'error'
            });     
        </script>";
    } else {

        $tambah = $con->query("INSERT INTO kelas_siswa VALUES (
            default, 
            '$kode', 
            '$id_kelas',
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
}

?>