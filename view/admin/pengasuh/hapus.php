<?php
require '../../../app/config.php';
include_once '../../layout/topbar.php';
include_once '../../layout/footer.php';

$id = $_GET['id'];
$dt = $_GET['ta'];

$query = $con->query(" DELETE FROM pengasuh WHERE id_pengasuh = '$id' ");
if ($query) {
    $_SESSION['pesan'] = "Data Berhasil di Hapus";
    echo "<meta http-equiv='refresh' content='0; url=data?ta=$dt'>";
} else {
    echo "Data anda gagal dihapus. Ulangi sekali lagi";
    echo "<meta http-equiv='refresh' content='0; url=data?ta=$dt'>";
}
