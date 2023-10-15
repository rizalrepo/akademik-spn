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
                <h4 class="page-title mb-0 font-size-18"><i class="fas fa-comments me-2"></i>Data Konseling</h4>
                <div class="page-title-right">
                    <a href="tambah" class="btn btn-sm btn-success"><i class="fas fa-plus-circle"></i> Tambah Data</a>
                </div>
            </div>
            <div class="card card-body border border-danger">

                <a href="#historyKonseling" class="btn btn-primary mb-3" data-bs-toggle="modal"><i class="fas fa-comments me-2"></i> History Konseling Siswa</a>

                <?php if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') { ?>
                    <div id="notif" class="alert alert-success d-flex align-items-center" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        <div>
                            <b><?= $_SESSION['pesan'] ?></b>
                        </div>
                    </div>
                <?php $_SESSION['pesan'] = '';
                } ?>


                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-hover table-striped dataTable">
                        <thead class="bg-danger">
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Data Siswa</th>
                                <th>Tahun Asuhan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $no = 1;
                            $data = $con->query("SELECT * FROM konseling a LEFT JOIN siswa b ON a.id_siswa = b.id_siswa LEFT JOIN asuhan c ON a.id_asuhan = c.id_asuhan WHERE a.id_gadik = '$user' ORDER BY a.id_konseling DESC");
                            while ($row = $data->fetch_array()) {
                            ?>
                                <tr>
                                    <td align="center" width="5%"><?= $no++ ?></td>
                                    <td align="center"><?= tgl($row['tgl_konseling']) ?></td>
                                    <td>
                                        <b>Nama</b> : <?= $row['nm_siswa'] ?>
                                        <hr class="my-1">
                                        <b>NOSIS</b> : <?= $row['nrp'] ?>
                                    </td>
                                    <td align="center">Tahun <?= $row['tahun'] . ' ' . $row['gelombang'] ?></td>
                                    <td align="center" width="11%">
                                        <span data-bs-target="#id<?= $row[0]; ?>" data-bs-toggle="modal" class="btn bg-success btn-xs text-white">
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Detail"><i class="fa fa-info-circle"></i></span>
                                        </span>
                                        <a href="edit?id=<?= $row[0] ?>" class="btn btn-info btn-xs text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
                                        <a href="hapus?id=<?= $row[0] ?>" class="btn btn-danger btn-xs alert-hapus" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"><i class="fas fa-trash"></i></a>
                                        <?php include('../../detail/konseling.php'); ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- row  -->
</div>

<div id="historyKonseling" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="custom-width-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="custom-width-modalLabel"><i class="fas fa-comments me-2"></i>History Data Konseling Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <form action="data" method="GET">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Cari Siswa</label>
                            <div class="col-sm-10">
                                <select name="siswa" class="form-select" id="selectSiswa" style="width: 100%;" required>
                                    <option value="">-- Pilih --</option>
                                    <?php $data = $con->query("SELECT * FROM siswa ORDER BY id_siswa DESC"); ?>
                                    <?php foreach ($data as $dt) : ?>
                                        <option value="<?= $dt['id_siswa'] ?>">NOSIS. <?= $dt['nrp'] ?> | <?= $dt['nm_siswa'] ?></option>
                                    <?php endforeach ?>
                                </select>
                                <div class="invalid-feedback">Kolom harus di pilih !</div>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <div id="historyResult" class="mt-3">

                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<?php include_once '../../layout/footer.php'; ?>
<script src="<?= base_url() ?>/app/js/app.js"></script>

<script>
    $('#selectSiswa').select2({
        dropdownParent: $('#historyKonseling')
    });

    $(document).ready(function() {
        // Fungsi untuk menangani permintaan AJAX
        function getHistoryData(id_siswa) {
            $.ajax({
                type: 'GET',
                url: 'history.php', // Gantilah dengan URL skrip sisi server yang sesungguhnya
                data: {
                    id_siswa: id_siswa
                },
                success: function(response) {
                    // Menyisipkan respons ke dalam elemen dengan ID "historyResult"
                    $('#historyResult').html(response);
                },
                error: function() {
                    alert('Terjadi kesalahan saat mengambil data.');
                }
            });
        }

        // Penanganan peristiwa saat seleksi dropdown berubah
        $('#selectSiswa').on('change', function() {
            var selectedValue = $(this).val();
            if (selectedValue !== '') {
                // Panggil fungsi untuk mengambil data berdasarkan ID siswa yang dipilih
                getHistoryData(selectedValue);
            }
        });
    });
</script>