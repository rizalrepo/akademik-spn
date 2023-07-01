<?php

include '../../../../app/config.php';


$kode    = $_POST['kode'];
$siswa   = $_POST['id_siswa'];

$dt = $con->query("SELECT * FROM asuhan WHERE id_asuhan = '$_POST[asuhanVal]' ")->fetch_array();
$cek_ta = mysqli_num_rows(mysqli_query($con, "SELECT * FROM kelas_siswa_detail a LEFT JOIN kelas_siswa b ON a.kode = b.kode WHERE a.id_siswa = '$siswa' AND b.id_asuhan = '$_POST[asuhanVal]' "));
$cek = mysqli_num_rows(mysqli_query($con, "SELECT * FROM kelas_siswa_detail WHERE id_siswa = '$siswa' AND kode = '$kode' "));

if ($cek > 0) {
    $data['hasil'] = 'duplikat';
} else if ($cek_ta > 0) {
    $data['hasil'] = 'duplikat_ta';
    $data['asuhan'] = $dt['tahun'] . ' ' . $dt['gelombang'];
} else {
    $tambah = $con->query("INSERT INTO kelas_siswa_detail VALUES (
        default,
        '$kode', 
        '$siswa'
    )");

    if ($tambah) {
        $data['hasil'] = 'sukses';
    } else {
        $data['hasil'] = 'gagal';
    }
}

echo json_encode($data);
