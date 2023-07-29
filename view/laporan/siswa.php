<?php
include '../../app/config.php';

$no = 1;

$tahun = $_GET['tahun'];
$cektahun = isset($tahun);

if ($tahun == $cektahun) {
    $sql = mysqli_query($con, "SELECT * FROM siswa WHERE YEAR(tgl_daftar) = '$tahun' ORDER BY tgl_daftar ASC");

    $label = 'LAPORAN DATA SISWA <br> Tahun Masuk : ' . $tahun;
} else {
    $sql = mysqli_query($con, "SELECT * FROM siswa ORDER BY tgl_daftar DESC");
    $label = 'LAPORAN DATA SISWA';
}

require_once '../../assets/libs/mpdf/autoload.php';
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [380, 215]]);
ob_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Laporan Siswa</title>
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
                        <tr bgcolor="#AE302E" align="center">
                            <th>No</th>
                            <th>Data Siswa</th>
                            <th>Asal Sekolah</th>
                            <th>TTL</th>
                            <th>Usia</th>
                            <th>Jenis Kelamin</th>
                            <th>Agama</th>
                            <th>Alamat</th>
                            <th>Data Wali</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($data = mysqli_fetch_array($sql)) {
                            $today = new DateTime('today');
                            $tgl = new DateTime($data['tgl_lahir']);
                            $y = $today->diff($tgl)->y;
                        ?>
                            <tr>
                                <td align="center" width="5%"><?= $no++; ?></td>
                                <td>
                                    <b>Nama</b> : <?= $data['nm_siswa'] ?>
                                    <hr style="margin: 3px 0;">
                                    <b>NOSIS</b> : <?= $data['nrp'] ?>
                                </td>
                                <td align="center"><?= $data['sekolah'] ?></td>
                                <td align="center" width="20%"><?= $data['tmpt_lahir'] . ', ' . tgl($data['tgl_lahir']) ?></td>
                                <td align=" center"><?= $y . ' Tahun' ?></td>
                                <td align="center"><?= $data['jk'] ?></td>
                                <td align="center"><?= $data['agama'] ?></td>
                                <td><?= $data['alamat'] ?></td>
                                <td align="center">
                                    <?= $data['nm_wali'] ?> <br>
                                    <?= $data['hp_wali'] ?>
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