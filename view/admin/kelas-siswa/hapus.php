<?php
require '../../../app/config.php';
include_once '../../layout/topbar.php';
include_once '../../layout/footer.php';

$id = $_GET['id'];
$dt = $_GET['ta'];

$data = $con->query(" SELECT * FROM kelas_siswa WHERE id_kelas_siswa = '$id' ")->fetch_array();
$query = $con->query(" DELETE FROM kelas_siswa WHERE id_kelas_siswa = '$id' ");
if ($query) {
    $con->query("DELETE FROM kelas_siswa_detail WHERE kode = '$data[kode]' ");
    $_SESSION['pesan'] = "Data Berhasil di Hapus";
    echo "<meta http-equiv='refresh' content='0; url=data?ta=$dt'>";
} else {
    echo "Data anda gagal dihapus. Ulangi sekali lagi";
    echo "<meta http-equiv='refresh' content='0; url=data?ta=$dt'>";
}
