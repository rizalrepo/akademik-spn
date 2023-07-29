<?php
include '../../app/config.php';

$no = 1;

$asuhan = $_GET['asuhan'];
$cekasuhan = isset($asuhan);

if ($asuhan == $cekasuhan) {
    $sql = mysqli_query($con, "SELECT * FROM konseling a LEFT JOIN siswa b ON a.id_siswa = b.id_siswa LEFT JOIN asuhan c ON a.id_asuhan = c.id_asuhan LEFT JOIN gadik d ON a.id_gadik = d.id_gadik WHERE a.id_asuhan = '$asuhan' ORDER BY id_konseling ASC");

    $dt = $con->query("SELECT * FROM asuhan WHERE id_asuhan = '$asuhan'")->fetch_array();
    $label = 'LAPORAN KONSELING <br> Tahun Asuhan : Tahun ' . $dt['tahun'] . ' ' . $dt['gelombang'];
} else {
    $sql = mysqli_query($con, "SELECT * FROM konseling a LEFT JOIN siswa b ON a.id_siswa = b.id_siswa LEFT JOIN asuhan c ON a.id_asuhan = c.id_asuhan LEFT JOIN gadik d ON a.id_gadik = d.id_gadik ORDER BY id_konseling DESC");
    $label = 'LAPORAN KONSELING';
}

require_once '../../assets/libs/mpdf/autoload.php';
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [380, 215]]);
ob_start();
?>

<script type="text/javascript">
    window.print();
</script>

<!DOCTYPE html>
<html>

<head>
    <title>Laporan Konseling</title>
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
                            <th>Tanggal</th>
                            <th>Data Siswa</th>
                            <th>Tahun Asuhan</th>
                            <th>Topik/Masalah</th>
                            <th>Hasil</th>
                            <th>Data Gadik</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($data = mysqli_fetch_array($sql)) { ?>
                            <tr>
                                <td align="center" width="5%"><?= $no++; ?></td>
                                <td align="center"><?= tgl($data['tgl_konseling']) ?></td>
                                <td>
                                    <b>Nama</b> : <?= $data['nm_siswa'] ?>
                                    <hr style="margin: 3px 0;">
                                    <b>NOSIS</b> : <?= $data['nrp'] ?>
                                </td>
                                <td align="center">Tahun <?= $data['tahun'] . ' ' . $data['gelombang'] ?></td>
                                <td><?= $data['topik'] ?></td>
                                <td><?= $data['hasil'] ?></td>
                                <td>
                                    <b>Nama</b> : <?= $data['nm_gadik'] ?>
                                    <hr style="margin: 3px 0;">
                                    <b>NRP/NIP</b> : <?= $data['nrp_nip'] ?>
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