<?php
include '../../app/config.php';

$no = 1;

$mapel = $_GET['mapel'];
$cekmapel = isset($mapel);
$asuhan = $_GET['asuhan'];
$cekasuhan = isset($asuhan);

if ($mapel == $cekmapel && $asuhan == null) {

    $sql = mysqli_query($con, "SELECT * FROM gadik_mapel a JOIN gadik b ON a.id_gadik = b.id_gadik JOIN pangkat c ON b.id_pangkat = c.id_pangkat JOIN jabatan d ON b.id_jabatan = d.id_jabatan JOIN asuhan f ON a.id_asuhan = f.id_asuhan WHERE a.id_mapel = '$mapel' GROUP BY a.id_gadik ORDER BY id_gadik_mapel DESC ");

    $dt = $con->query("SELECT * FROM mapel WHERE id_mapel = '$mapel'")->fetch_array();
    $label = 'LAPORAN GADIK MAPEL <br> Mata Pelajaran : ' . $dt['kd_mapel'] . ' - ' . $dt['nm_mapel'];
} else if ($mapel == null && $asuhan == $cekasuhan) {

    $sql = mysqli_query($con, "SELECT * FROM gadik_mapel a JOIN gadik b ON a.id_gadik = b.id_gadik JOIN pangkat c ON b.id_pangkat = c.id_pangkat JOIN jabatan d ON b.id_jabatan = d.id_jabatan JOIN asuhan f ON a.id_asuhan = f.id_asuhan WHERE a.id_asuhan = '$asuhan' GROUP BY a.id_gadik ORDER BY id_gadik_mapel ASC ");

    $dt = $con->query("SELECT * FROM asuhan WHERE id_asuhan = '$asuhan'")->fetch_array();
    $label = 'LAPORAN GADIK MAPEL <br> Tahun Asuhan : Tahun ' . $dt['tahun'] . ' ' . $dt['gelombang'];
} else if ($asuhan == $cekasuhan && $mapel == $cekmapel) {

    $sql = mysqli_query($con, "SELECT * FROM gadik_mapel a JOIN gadik b ON a.id_gadik = b.id_gadik JOIN pangkat c ON b.id_pangkat = c.id_pangkat JOIN jabatan d ON b.id_jabatan = d.id_jabatan JOIN asuhan f ON a.id_asuhan = f.id_asuhan WHERE a.id_asuhan = '$asuhan' AND a.id_mapel = '$mapel' GROUP BY a.id_gadik ORDER BY id_gadik_mapel ASC ");

    $dt1 = $con->query("SELECT * FROM mapel WHERE id_mapel = '$mapel'")->fetch_array();
    $dt2 = $con->query("SELECT * FROM asuhan WHERE id_asuhan = '$asuhan'")->fetch_array();
    $label = 'LAPORAN GADIK MAPEL <br> Mata Pelajaran : ' . $dt1['kd_mapel'] . ' - ' . $dt1['nm_mapel'] . '<br> Tahun Asuhan : Tahun ' . $dt2['tahun'] . ' ' . $dt2['gelombang'];
} else {
    $sql = mysqli_query($con, "SELECT * FROM gadik_mapel a JOIN gadik b ON a.id_gadik = b.id_gadik JOIN pangkat c ON b.id_pangkat = c.id_pangkat JOIN jabatan d ON b.id_jabatan = d.id_jabatan JOIN asuhan f ON a.id_asuhan = f.id_asuhan GROUP BY a.id_gadik ORDER BY id_gadik_mapel DESC");
    $label = 'LAPORAN GADIK MAPEL';
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
    <title>Laporan Gadik Mapel</title>
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
                            <th>Data Gadik</th>
                            <th>Mata Pelajaran</th>
                            <th>Tahun Asuhan</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($data = mysqli_fetch_array($sql)) { ?>
                            <tr>
                                <td align="center" width="5%"><?= $no++; ?></td>
                                <td>
                                    <b>Nama</b> : <?= $data['nm_gadik'] ?>
                                    <hr style="margin-top: 3px; margin-bottom: 3px;">
                                    <b>NRP / NIP</b> : <?= $data['nrp_nip'] ?>
                                    <hr style="margin-top: 3px; margin-bottom: 3px;">
                                    <b>Pangkat</b> : <?= $data['nm_pangkat'] ?>
                                    <hr style="margin-top: 3px; margin-bottom: 3px;">
                                    <b>Jabatan</b> : <?= $data['nm_jabatan'] ?>
                                </td>
                                <td align="center">
                                    <?php $q = $con->query("SELECT * FROM gadik_mapel a JOIN mapel b ON a.id_mapel = b.id_mapel WHERE a.id_gadik = '$data[id_gadik]' ORDER BY a.id_gadik_mapel ASC ");
                                    $no1 = 1;
                                    while ($d = $q->fetch_array()) { ?>
                                        <?= $no1++ . '. ' . $d['kd_mapel'] ?> - <?= $d['nm_mapel'] ?>
                                    <?php } ?>
                                </td>
                                <td align="center">Tahun <?= $data['tahun'] . ' ' . $data['gelombang'] ?></td>
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