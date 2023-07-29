<?php
include '../../app/config.php';

$no = 1;

$bln = array(
    '01' => 'Januari',
    '02' => 'Februari',
    '03' => 'Maret',
    '04' => 'April',
    '05' => 'Mei',
    '06' => 'Juni',
    '07' => 'Juli',
    '08' => 'Agustus',
    '09' => 'September',
    '10' => 'Oktober',
    '11' => 'November',
    '12' => 'Desember'
);

$asuhan = $_GET['asuhan'];
$cekasuhan = isset($asuhan);
$kelas_siswa = $_GET['kelas_siswa'];
$cekkelas_siswa = isset($kelas_siswa);
$bulan = $_GET['bulan'];
$cekbulan = isset($bulan);
$tahun = $_GET['tahun'];
$cektahun = isset($tahun);

if ($asuhan == $cekasuhan && $kelas_siswa == $cekkelas_siswa && $bulan == $cekbulan && $tahun == $cektahun) {
    $sql = mysqli_query($con, "SELECT * FROM absensi a LEFT JOIN siswa b ON a.id_siswa = b.id_siswa LEFT JOIN jadwal c ON a.id_jadwal = c.id_jadwal LEFT JOIN kelas_siswa d ON c.id_kelas_siswa = d.id_kelas_siswa WHERE MONTH(a.tgl_absensi) = '$bulan' AND YEAR(a.tgl_absensi) = '$tahun' AND c.id_kelas_siswa = '$kelas_siswa' AND c.id_asuhan = '$asuhan' GROUP BY a.id_siswa ORDER BY b.nm_siswa ASC");

    $dt1 = $con->query("SELECT * FROM asuhan WHERE id_asuhan = '$asuhan'")->fetch_array();
    $dt2 = $con->query("SELECT * FROM kelas_siswa a LEFT JOIN kelas b ON a.id_kelas = b.id_kelas WHERE a.id_kelas_siswa = '$kelas_siswa'")->fetch_array();
    $label = 'LAPORAN ABSENSI SISWA <br> Tahun Asuhan : Tahun ' . $dt1['tahun'] . ' ' . $dt1['gelombang'] . '<br> Kelas : ' . $dt2['nm_kelas'] . '<br> Bulan : ' . $bln[date($bulan)] . ' ' . $tahun;
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
    <title>Laporan Absensi Siswa</title>
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
                            <th>Nama Siswa</th>
                            <th>NOSIS</th>
                            <th>Hadir</th>
                            <th>Izin</th>
                            <th>Sakit</th>
                            <th>Alpa</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($data = mysqli_fetch_array($sql)) { ?>
                            <tr>
                                <td align="center" width="5%"><?= $no++; ?></td>
                                <td><?= $data['nm_siswa'] ?></td>
                                <td align="center"><?= $data['nrp'] ?></td>
                                <td align="center">
                                    <?php $dt = $con->query("SELECT *, COUNT(*) as hadir FROM absensi a LEFT JOIN siswa b ON a.id_siswa = b.id_siswa LEFT JOIN jadwal c ON a.id_jadwal = c.id_jadwal LEFT JOIN kelas_siswa d ON c.id_kelas_siswa = d.id_kelas_siswa WHERE MONTH(a.tgl_absensi) = '$bulan' AND YEAR(a.tgl_absensi) = '$tahun' AND c.id_kelas_siswa = '$kelas_siswa' AND c.id_asuhan = '$asuhan' AND a.id_siswa = '$data[id_siswa]' AND a.sts = 'Hadir' ")->fetch_array();
                                    echo $dt['hadir'] . ' Hari' ?>
                                </td>
                                <td align="center">
                                    <?php $dt = $con->query("SELECT *, COUNT(*) as izin FROM absensi a LEFT JOIN siswa b ON a.id_siswa = b.id_siswa LEFT JOIN jadwal c ON a.id_jadwal = c.id_jadwal LEFT JOIN kelas_siswa d ON c.id_kelas_siswa = d.id_kelas_siswa WHERE MONTH(a.tgl_absensi) = '$bulan' AND YEAR(a.tgl_absensi) = '$tahun' AND c.id_kelas_siswa = '$kelas_siswa' AND c.id_asuhan = '$asuhan' AND a.id_siswa = '$data[id_siswa]' AND a.sts = 'Izin' ")->fetch_array();
                                    echo $dt['izin'] . ' Hari' ?>
                                </td>
                                <td align="center">
                                    <?php $dt = $con->query("SELECT *, COUNT(*) as sakit FROM absensi a LEFT JOIN siswa b ON a.id_siswa = b.id_siswa LEFT JOIN jadwal c ON a.id_jadwal = c.id_jadwal LEFT JOIN kelas_siswa d ON c.id_kelas_siswa = d.id_kelas_siswa WHERE MONTH(a.tgl_absensi) = '$bulan' AND YEAR(a.tgl_absensi) = '$tahun' AND c.id_kelas_siswa = '$kelas_siswa' AND c.id_asuhan = '$asuhan' AND a.id_siswa = '$data[id_siswa]' AND a.sts = 'Sakit' ")->fetch_array();
                                    echo $dt['sakit'] . ' Hari' ?>
                                </td>
                                <td align="center">
                                    <?php $dt = $con->query("SELECT *, COUNT(*) as alpa FROM absensi a LEFT JOIN siswa b ON a.id_siswa = b.id_siswa LEFT JOIN jadwal c ON a.id_jadwal = c.id_jadwal LEFT JOIN kelas_siswa d ON c.id_kelas_siswa = d.id_kelas_siswa WHERE MONTH(a.tgl_absensi) = '$bulan' AND YEAR(a.tgl_absensi) = '$tahun' AND c.id_kelas_siswa = '$kelas_siswa' AND c.id_asuhan = '$asuhan' AND a.id_siswa = '$data[id_siswa]' AND a.sts = 'Alpa' ")->fetch_array();
                                    echo $dt['alpa'] . ' Hari' ?>
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