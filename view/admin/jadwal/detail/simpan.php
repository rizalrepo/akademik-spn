<?php

include '../../../../app/config.php';


$id_gadik_mapel    = $_POST['id_gadik_mapel'];
$id_asuhan         = $_POST['id_asuhan'];
$id_kelas_siswa    = $_POST['id_kelas_siswa'];
$hari              = $_POST['hari'];
$jam_mulai         = $_POST['jam_mulai'];
$jam_selesai       = $_POST['jam_selesai'];

$dt = $con->query("SELECT * FROM asuhan WHERE id_asuhan = '$id_asuhan' ")->fetch_array();

$cek = mysqli_num_rows(mysqli_query($con, "SELECT * FROM jadwal WHERE id_gadik_mapel = '$id_gadik_mapel' AND id_asuhan = '$id_asuhan' AND id_kelas_siswa = $id_kelas_siswa AND hari = '$hari' "));

if ($cek > 0) {
    $data['hasil'] = 'duplikat';
} else {
    $tambah = $con->query("INSERT INTO jadwal VALUES (
        default,
        '$id_gadik_mapel', 
        '$id_asuhan',
        '$id_kelas_siswa',
        '$hari',
        '$jam_mulai',
        '$jam_selesai'
    )");

    if ($tambah) {
        $data['hasil'] = 'sukses';
    } else {
        $data['hasil'] = 'gagal';
    }
}

echo json_encode($data);
