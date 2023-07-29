<div class="modal fade" id="lapGadik" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-file-alt me-2"></i>Laporan Data Gadik</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="GET" target="_blank" action="<?= base_url('view/laporan/gadik') ?>">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label class="col-form-label fw-semibold">Berdasarkan Pangkat</label>
                                <select name="pangkat" class="form-select" id="selectPangkat" style="width: 100%;">
                                    <option value="">-- Pilih --</option>
                                    <?php $data = $con->query("SELECT * FROM pangkat ORDER BY id_pangkat ASC"); ?>
                                    <?php foreach ($data as $row) : ?>
                                        <option value="<?= $row['id_pangkat'] ?>"><?= $row['nm_pangkat'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label class="col-form-label fw-semibold">Berdasarkan Jabatan</label>
                                <select name="jabatan" class="form-select" id="selectJabatan" style="width: 100%;">
                                    <option value="">-- Pilih --</option>
                                    <?php $data = $con->query("SELECT * FROM jabatan ORDER BY id_jabatan ASC"); ?>
                                    <?php foreach ($data as $row) : ?>
                                        <option value="<?= $row['id_jabatan'] ?>"><?= $row['nm_jabatan'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-danger"><i class="fa fa-print me-1"></i> Cetak</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="lapPengasuh" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-file-alt me-2"></i>Laporan Data Pengasuh</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="GET" target="_blank" action="<?= base_url('view/laporan/pengasuh') ?>">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label class="col-form-label fw-semibold">Berdasarkan Tahun Asuhan</label>
                                <select name="asuhan" class="form-select" id="selectAsuhan" style="width: 100%;">
                                    <option value="">-- Pilih --</option>
                                    <?php $data = $con->query("SELECT * FROM asuhan ORDER BY id_asuhan DESC"); ?>
                                    <?php foreach ($data as $row) : ?>
                                        <option value="<?= $row['id_asuhan'] ?>">Tahun <?= $row['tahun'] . ' ' . $row['gelombang'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-danger"><i class="fa fa-print me-1"></i> Cetak</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="lapGadikMapel" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-file-alt me-2"></i>Laporan Data Gadik Mapel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="GET" target="_blank" action="<?= base_url('view/laporan/gadik-mapel') ?>">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label class="col-form-label fw-semibold">Berdasarkan Mata Pelajaran</label>
                                <select name="mapel" class="form-select" id="selectMapel" style="width: 100%;">
                                    <option value="">-- Pilih --</option>
                                    <?php $data = $con->query("SELECT * FROM mapel ORDER BY id_mapel ASC"); ?>
                                    <?php foreach ($data as $row) : ?>
                                        <option value="<?= $row['id_mapel'] ?>"><?= $row['kd_mapel'] . ' - ' . $row['nm_mapel'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label class="col-form-label fw-semibold">Berdasarkan Tahun Asuhan</label>
                                <select name="asuhan" class="form-select" id="selectAsuhanMapel" style="width: 100%;">
                                    <option value="">-- Pilih --</option>
                                    <?php $data = $con->query("SELECT * FROM asuhan ORDER BY id_asuhan DESC"); ?>
                                    <?php foreach ($data as $row) : ?>
                                        <option value="<?= $row['id_asuhan'] ?>">Tahun <?= $row['tahun'] . ' ' . $row['gelombang'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-danger"><i class="fa fa-print me-1"></i> Cetak</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="lapJadwal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-file-alt me-2"></i>Laporan Data Jadwal Mengajar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="GET" target="_blank" action="<?= base_url('view/laporan/jadwal') ?>">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label class="col-form-label fw-semibold">Gadik Mapel</label>
                                <select name="id_gadik_mapel" class="form-select" id="selectGadikJadwal" style="width: 100%;">
                                    <option value="">-- Pilih --</option>
                                    <?php $data = $con->query("SELECT * FROM gadik_mapel a LEFT JOIN gadik b ON a.id_gadik = b.id_gadik GROUP BY a.id_gadik ORDER BY a.id_gadik_mapel ASC"); ?>
                                    <?php foreach ($data as $row) : ?>
                                        <option value="<?= $row['id_gadik_mapel'] ?>">NRP/NIP <?= $row['nrp_nip'] . ' | ' . $row['nm_gadik'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label class="col-form-label fw-semibold">Berdasarkan Tahun Asuhan</label>
                                <select name="id_asuhan" class="form-select" id="selectAsuhanJadwal" style="width: 100%;">
                                    <option value="">-- Pilih --</option>
                                    <?php $data = $con->query("SELECT * FROM asuhan ORDER BY id_asuhan DESC"); ?>
                                    <?php foreach ($data as $row) : ?>
                                        <option value="<?= $row['id_asuhan'] ?>">Tahun <?= $row['tahun'] . ' ' . $row['gelombang'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-danger"><i class="fa fa-print me-1"></i> Cetak</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="lapSiswa" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-file-alt me-2"></i>Laporan Data Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="GET" target="_blank" action="<?= base_url('view/laporan/siswa') ?>">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label class="col-form-label fw-semibold">Berdasarkan Tahun Masuk</label>
                                <select name="tahun" class="form-select" id="selectTahun" style="width: 100%;">
                                    <option value="">-- Pilih --</option>
                                    <?php $data = $con->query("SELECT YEAR(tgl_daftar) as tahun FROM siswa GROUP BY tahun ORDER BY tahun DESC"); ?>
                                    <?php foreach ($data as $row) : ?>
                                        <option value="<?= $row['tahun'] ?>"><?= $row['tahun'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-danger"><i class="fa fa-print me-1"></i> Cetak</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="lapKelas" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-file-alt me-2"></i>Laporan Data Jadwal Mengajar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="GET" target="_blank" action="<?= base_url('view/laporan/kelas-siswa') ?>">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label class="col-form-label fw-semibold">Berdasarkan Kelas</label>
                                <select name="id_kelas_siswa" class="form-select" id="selectKelas" style="width: 100%;">
                                    <option value="">-- Pilih --</option>
                                    <?php $data = $con->query("SELECT * FROM kelas_siswa a LEFT JOIN kelas b ON a.id_kelas = b.id_kelas GROUP BY a.id_kelas ORDER BY a.id_kelas_siswa ASC"); ?>
                                    <?php foreach ($data as $row) : ?>
                                        <option value="<?= $row['id_kelas_siswa'] ?>"> <?= $row['nm_kelas'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label class="col-form-label fw-semibold">Berdasarkan Tahun Asuhan</label>
                                <select name="id_asuhan" class="form-select" id="selectAsuhanKelas" style="width: 100%;">
                                    <option value="">-- Pilih --</option>
                                    <?php $data = $con->query("SELECT * FROM asuhan ORDER BY id_asuhan DESC"); ?>
                                    <?php foreach ($data as $row) : ?>
                                        <option value="<?= $row['id_asuhan'] ?>">Tahun <?= $row['tahun'] . ' ' . $row['gelombang'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-danger"><i class="fa fa-print me-1"></i> Cetak</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script src="<?= base_url() ?>/assets/libs/jquery/jquery.min.js"></script>

<script>
    $(function() {
        $('#selectPangkat').select2({
            dropdownParent: $('#lapGadik')
        });
        $('#selectJabatan').select2({
            dropdownParent: $('#lapGadik')
        });
        $('#selectAsuhan').select2({
            dropdownParent: $('#lapPengasuh')
        });
        $('#selectAsuhanMapel').select2({
            dropdownParent: $('#lapGadikMapel')
        });
        $('#selectMapel').select2({
            dropdownParent: $('#lapGadikMapel')
        });
        $('#selectGadikJadwal').select2({
            dropdownParent: $('#lapJadwal')
        });
        $('#selectAsuhanJadwal').select2({
            dropdownParent: $('#lapJadwal')
        });
        $('#selectTahun').select2({
            dropdownParent: $('#lapSiswa')
        });
        $('#selectKelas').select2({
            dropdownParent: $('#lapKelas')
        });
        $('#selectAsuhanKelas').select2({
            dropdownParent: $('#lapKelas')
        });

        // $('#selectPersonil').select2({
        //     dropdownParent: $('#lapAbsensiPersonil')
        // });

        // $('#selectJenis').select2({
        //     dropdownParent: $('#lapKegiatan')
        // });

        // $(".bln-izin").change(function() {
        //     if ($(".bln-izin option:selected").val() != '') {
        //         $('.thn-izin').prop('required', true);
        //     } else {
        //         $('.thn-izin').removeAttr('required');
        //     }
        // });
        // $(".bln-cuti").change(function() {
        //     if ($(".bln-cuti option:selected").val() != '') {
        //         $('.thn-cuti').prop('required', true);
        //     } else {
        //         $('.thn-cuti').removeAttr('required');
        //     }
        // });
        // $(".bln-tugas").change(function() {
        //     if ($(".bln-tugas option:selected").val() != '') {
        //         $('.thn-tugas').prop('required', true);
        //     } else {
        //         $('.thn-tugas').removeAttr('required');
        //     }
        // });
        // $(".bln-mutasi").change(function() {
        //     if ($(".bln-mutasi option:selected").val() != '') {
        //         $('.thn-mutasi').prop('required', true);
        //     } else {
        //         $('.thn-mutasi').removeAttr('required');
        //     }
        // });
        // $(".bln-kegiatan").change(function() {
        //     if ($(".bln-kegiatan option:selected").val() != '') {
        //         $('.thn-kegiatan').prop('required', true);
        //     } else {
        //         $('.thn-kegiatan').removeAttr('required');
        //     }
        // });
    });
</script>