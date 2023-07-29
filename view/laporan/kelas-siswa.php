<?php
include '../../app/config.php';

$no = 1;

$id_kelas_siswa = $_GET['id_kelas_siswa'];
$cekid_kelas_siswa = isset($id_kelas_siswa);
$id_asuhan = $_GET['id_asuhan'];
$cekid_asuhan = isset($id_asuhan);

if ($id_kelas_siswa == $cekid_kelas_siswa && $id_asuhan == null) {

    $sql = mysqli_query($con, "SELECT * FROM kelas_siswa a LEFT JOIN kelas b ON a.id_kelas = b.id_kelas LEFT JOIN asuhan c ON a.id_asuhan = c.id_asuhan WHERE a.id_kelas_siswa = '$id_kelas_siswa' ORDER BY id_kelas_siswa DESC ");

    $dt = $con->query("SELECT * FROM kelas_siswa a LEFT JOIN kelas b ON a.id_kelas = b.id_kelas WHERE id_kelas_siswa = '$id_kelas_siswa'")->fetch_array();
    $label = 'LAPORAN KELAS SISWA <br> Kelas : ' . $dt['nm_kelas'];
} else if ($id_kelas_siswa == null && $id_asuhan == $cekid_asuhan) {

    $sql = mysqli_query($con, "SELECT * FROM kelas_siswa a LEFT JOIN kelas b ON a.id_kelas = b.id_kelas LEFT JOIN asuhan c ON a.id_asuhan = c.id_asuhan WHERE a.id_asuhan = '$id_asuhan' ORDER BY id_kelas_siswa ASC ");

    $dt = $con->query("SELECT * FROM asuhan WHERE id_asuhan = '$id_asuhan'")->fetch_array();
    $label = 'LAPORAN KELAS SISWA <br> Tahun Asuhan : Tahun ' . $dt['tahun'] . ' ' . $dt['gelombang'];
} else if ($id_asuhan == $cekid_asuhan && $id_kelas_siswa == $cekid_kelas_siswa) {

    $sql = mysqli_query($con, "SELECT * FROM kelas_siswa a LEFT JOIN kelas b ON a.id_kelas = b.id_kelas LEFT JOIN asuhan c ON a.id_asuhan = c.id_asuhan WHERE a.id_asuhan = '$id_asuhan' AND a.id_kelas_siswa = '$id_kelas_siswa' ORDER BY id_kelas_siswa ASC ");

    $dt1 = $con->query("SELECT * FROM kelas_siswa a LEFT JOIN kelas b ON a.id_kelas = b.id_kelas WHERE id_kelas_siswa = '$id_kelas_siswa'")->fetch_array();
    $dt2 = $con->query("SELECT * FROM asuhan WHERE id_asuhan = '$id_asuhan'")->fetch_array();
    $label = 'LAPORAN KELAS SISWA <br> Kelas : ' . $dt1['nm_kelas'] . '<br> Tahun Asuhan : Tahun ' . $dt2['tahun'] . ' ' . $dt2['gelombang'];
} else {
    $sql = mysqli_query($con, "SELECT * FROM kelas_siswa a LEFT JOIN kelas b ON a.id_kelas = b.id_kelas LEFT JOIN asuhan c ON a.id_asuhan = c.id_asuhan ORDER BY id_kelas_siswa DESC");
    $label = 'LAPORAN KELAS SISWA';
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
    <title>Laporan Kelas Siswa</title>
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
                            <th>Data Kelas Siswa</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($data = mysqli_fetch_array($sql)) { ?>
                            <tr>
                                <td align="center" width="5%"><?= $no++; ?></td>
                                <td>
                                    <b>Kelas</b> : <?= $data['nm_kelas'] ?>
                                    <hr style="margin: 3px 0;">
                                    <b>Asuhan</b> : Tahun <?= $data['tahun'] . ' ' . $data['gelombang'] ?>
                                    <hr style="margin: 3px 0;">
                                    <b>Jumlah Siswa</b> :
                                    <?php
                                    $jml = $con->query("SELECT COUNT(*) AS total FROM kelas_siswa_detail WHERE kode = '$data[kode]'")->fetch_array();
                                    if ($jml['total']) {
                                        echo $jml['total'] . ' Orang';
                                    } else {
                                        echo 'Belum ada Siswa';
                                    }
                                    ?>
                                    <hr style="margin: 3px 0;">

                                    <b>Daftar Siswa :</b>

                                    <table border="1" cellspacing="0" cellpadding="6" width="100%" style="margin: 6px 0;">
                                        <thead>
                                            <tr bgcolor="#68D150" align="center">
                                                <th>No</th>
                                                <th>Nama Siswa</th>
                                                <th>NOSIS</th>
                                                <th>Wali</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            $no1 = 1;
                                            $data1 = mysqli_query($con, "SELECT * FROM kelas_siswa_detail a LEFT JOIN kelas_siswa b ON a.kode = b.kode LEFT JOIN siswa c ON a.id_siswa = c.id_siswa WHERE a.kode = '$data[kode]' ");
                                            while ($tampil1 = mysqli_fetch_array($data1)) {
                                            ?>
                                                <tr>
                                                    <td align="center" width="5%"><?= $no1++; ?></td>
                                                    <td><?= $tampil1['nm_siswa'] ?></td>
                                                    <td align="center"><?= $tampil1['nrp'] ?></td>
                                                    <td><?= $tampil1['nm_wali'] ?></td>
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