<?php
include '../../app/config.php';

$no = 1;

$id_gadik_mapel = $_GET['id_gadik_mapel'];
$cekid_gadik_mapel = isset($id_gadik_mapel);
$id_asuhan = $_GET['id_asuhan'];
$cekid_asuhan = isset($id_asuhan);

if ($id_gadik_mapel == $cekid_gadik_mapel && $id_asuhan == null) {

    $sql = mysqli_query($con, "SELECT * FROM gadik_mapel a LEFT JOIN gadik b ON a.id_gadik = b.id_gadik LEFT JOIN pangkat c ON b.id_pangkat = c.id_pangkat LEFT JOIN jabatan d ON b.id_jabatan = d.id_jabatan LEFT JOIN mapel e ON a.id_mapel = e.id_mapel LEFT JOIN asuhan f ON a.id_asuhan = f.id_asuhan WHERE a.id_gadik_mapel = '$id_gadik_mapel' ORDER BY id_gadik_mapel DESC ");

    $dt = $con->query("SELECT * FROM gadik_mapel a LEFT JOIN gadik b ON a.id_gadik = b.id_gadik WHERE id_gadik_mapel = '$id_gadik_mapel'")->fetch_array();
    $label = 'LAPORAN JADWAL MENGAJAR <br> Nama Gadik : ' . $dt['nm_gadik'] . '<br> NRP / NIP : ' . $dt['nrp_nip'];
} else if ($id_gadik_mapel == null && $id_asuhan == $cekid_asuhan) {

    $sql = mysqli_query($con, "SELECT * FROM gadik_mapel a LEFT JOIN gadik b ON a.id_gadik = b.id_gadik LEFT JOIN pangkat c ON b.id_pangkat = c.id_pangkat LEFT JOIN jabatan d ON b.id_jabatan = d.id_jabatan LEFT JOIN mapel e ON a.id_mapel = e.id_mapel LEFT JOIN asuhan f ON a.id_asuhan = f.id_asuhan WHERE a.id_asuhan = '$id_asuhan' ORDER BY id_gadik_mapel ASC ");

    $dt = $con->query("SELECT * FROM asuhan WHERE id_asuhan = '$id_asuhan'")->fetch_array();
    $label = 'LAPORAN JADWAL MENGAJAR <br> Tahun Asuhan : Tahun ' . $dt['tahun'] . ' ' . $dt['gelombang'];
} else if ($id_asuhan == $cekid_asuhan && $id_gadik_mapel == $cekid_gadik_mapel) {

    $sql = mysqli_query($con, "SELECT * FROM gadik_mapel a LEFT JOIN gadik b ON a.id_gadik = b.id_gadik LEFT JOIN pangkat c ON b.id_pangkat = c.id_pangkat LEFT JOIN jabatan d ON b.id_jabatan = d.id_jabatan LEFT JOIN mapel e ON a.id_mapel = e.id_mapel LEFT JOIN asuhan f ON a.id_asuhan = f.id_asuhan WHERE a.id_asuhan = '$id_asuhan' AND a.id_gadik_mapel = '$id_gadik_mapel' ORDER BY id_gadik_mapel ASC ");

    $dt1 = $con->query("SELECT * FROM gadik_mapel a LEFT JOIN gadik b ON a.id_gadik = b.id_gadik WHERE id_gadik_mapel = '$id_gadik_mapel'")->fetch_array();
    $dt2 = $con->query("SELECT * FROM asuhan WHERE id_asuhan = '$id_asuhan'")->fetch_array();
    $label = 'LAPORAN JADWAL MENGAJAR <br> Nama Gadik : ' . $dt1['nm_gadik'] . '<br> NRP / NIP : ' . $dt1['nrp_nip'] . '<br> Tahun Asuhan : Tahun ' . $dt2['tahun'] . ' ' . $dt2['gelombang'];
} else {
    $sql = mysqli_query($con, "SELECT * FROM gadik_mapel a LEFT JOIN gadik b ON a.id_gadik = b.id_gadik LEFT JOIN pangkat c ON b.id_pangkat = c.id_pangkat LEFT JOIN jabatan d ON b.id_jabatan = d.id_jabatan LEFT JOIN mapel e ON a.id_mapel = e.id_mapel LEFT JOIN asuhan f ON a.id_asuhan = f.id_asuhan ORDER BY id_gadik_mapel DESC");
    $label = 'LAPORAN JADWAL MENGAJAR';
}

require_once '../../assets/libs/mpdf/autoload.php';
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'LEGAL-L']);
ob_start();
?>

<script type="text/javascript">
    window.print();
</script>

<!DOCTYPE html>
<html>

<head>
    <title>Laporan Jadwal Mengajar</title>
</head>

<style>
    th {
        color: white;
    }
</style>

<body>
    <div class="table-responsive">
        <table border="0" cellspacing="0" cellpadding="0" width="100%">
            <tr>
                <td align="center">
                    <img src="<?= base_url('assets/images/logo.png') ?>" align="left" height="100">
                </td>
                <td align="center">
                    <h4>KEPOLISIAN NEGARA REPUBLIK INDONESIA</h4>
                    <h2>DAERAH KALIMANTAN SELATAN SEKOLAH POLISI NEGARA</h2>
                    <h6>Jl. Ir. P. M. Noor, Guntung Paikat, Kec. Banjarbaru Selatan, Kota Banjar Baru, Kalimantan Selatan Kodepos 70714</h6>
                </td>
                <td align="center">
                    <img src="<?= base_url('assets/images/pelengkap.png') ?>" align="right" height="100">
                </td>
            </tr>
        </table>
    </div>
    <hr size="2px" color="black">

    <h4 align="center">
        <?= $label ?><br>
    </h4>
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                <table border="1" cellspacing="0" cellpadding="6" width="100%">
                    <thead>
                        <tr bgcolor="#DC3545" align="center">
                            <th>No</th>
                            <th>Data Jadwal Mengajar Gadik</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($data = mysqli_fetch_array($sql)) { ?>
                            <tr>
                                <td align="center" width="5%"><?= $no++; ?></td>
                                <td>
                                    <b>Nama</b> : <?= $data['nm_gadik'] ?>
                                    <hr style="margin: 3px 0;">
                                    <b>NRP / NIP</b> : <?= $data['nrp_nip'] ?>
                                    <hr style="margin: 3px 0;">
                                    <b>Pangkat</b> : <?= $data['nm_pangkat'] ?>
                                    <hr style="margin: 3px 0;">
                                    <b>Jabatan</b> : <?= $data['nm_jabatan'] ?>
                                    <hr style="margin: 3px 0;">
                                    <b>Mapel</b> : <?= $data['kd_mapel'] . ' - ' . $data['nm_mapel'] ?>
                                    <hr style="margin: 3px 0;">
                                    <b>Asuhan</b> : Tahun <?= $data['tahun'] . ' ' . $data['gelombang'] ?>
                                    <hr style="margin: 3px 0;">
                                    <b>Jadwal :</b>
                                    <table border="1" cellspacing="0" cellpadding="6" width="100%" style="margin: 6px 0;">
                                        <thead>
                                            <tr bgcolor="#68D150" align="center">
                                                <th>No</th>
                                                <th>Kelas</th>
                                                <th>Hari</th>
                                                <th>Jam</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no2 = 1;
                                            $data1 = mysqli_query($con, "SELECT * FROM jadwal a LEFT JOIN kelas_siswa b ON a.id_kelas_siswa = b.id_kelas_siswa LEFT JOIN kelas c ON b.id_kelas = c.id_kelas WHERE a.id_gadik_mapel = '$data[id_gadik_mapel]' ORDER BY id_jadwal ASC");
                                            while ($tampil1 = mysqli_fetch_array($data1)) {
                                            ?>
                                                <tr>
                                                    <td align="center" width="5%"><?= $no2++; ?></td>
                                                    <td align="center"><?= $tampil1['nm_kelas'] ?></td>
                                                    <td align="center"><?= $tampil1['hari'] ?></td>
                                                    <td align="center"><?= $tampil1['jam_mulai'] ?> - <?= $tampil1['jam_selesai'] ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
    <br>
    <br>

    <br>
    <div class="table-responsive">
        <table border="0" cellspacing="0" cellpadding="0" width="100%">
            <tr>
                <td align="center" width="80%">
                </td>
                <td align="center">
                    <h6>
                        Banjarbaru, <?= tgl(date('Y-m-d')) ?><br>
                        KA SPN POLDA KALIMANTAN SELATAN
                        <br><br><br><br><br><br><br>
                        RESTIKA P. NAINGGOLAN, S.I.K
                        <hr style="margin-top: 0; margin-bottom: 0;">
                        KOMISARIS BESAR POLISI NRP 76030830
                    </h6>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
<?php
$html = ob_get_contents();
ob_end_clean();
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output();
?>